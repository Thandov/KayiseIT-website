# Certification Feature (v2) — Implementation Plan & Operations

This document describes the online certification flow that uses the existing Python certificate generator and how it is integrated into the Laravel app.

---

## Frontend walkthrough (how to use)

1. **Open the site** (e.g. `http://localhost/KayiseIT-website/public` or your live URL).
2. **Go to the Certificate page**  
   - **Option A:** In the top navigation bar, click **Certificate** (between Opportunities and Gallery).  
   - **Option B:** If you are logged in as a student, open **Student Portal** and click the **Request Certificate** card.  
   - **Option C:** Go directly to: `/lms/certification` (e.g. `https://yoursite.com/lms/certification`).
3. **Fill the form**
   - **Name** (required)  
   - **Surname** (required)  
   - **ID Number** (required) — must match a learner in the CSV records.  
   - **Email** (optional) — for contact or future email delivery.
4. **Submit**  
   Click **Generate certificate**.
5. **Result**
   - **If your ID is in the records:** You are redirected to a download page and the PDF is downloaded (or the browser opens it).
   - **If your ID is not found:** You stay on the form and see: *“This ID number was not found in our records. If you believe this is an error, please contact support.”*
   - **If generation fails (e.g. server error):** You see: *“Certificate generation failed. Please try again or contact support.”*

You do **not** need to log in to request a certificate; the page is public. Only your ID number must be in the configured learner CSVs.

---

## 1. Architecture Overview

- **Python generator (unchanged):** `/Applications/MAMP/htdocs/Python Programs/Training_certifactes/certificate_template.py`
  - Reads CSV(s) with columns: **Name, Surname, ID number, Certificate number**
  - Writes PDFs under `--output-dir` in subfolders per CSV (e.g. `certificates/barberton_learners/`).
- **Laravel:**
  - **Eligibility:** Look up submitted **ID number** in configured learner CSVs (e.g. `barberton_learners.csv`, `kabokweni_learners.csv`). ID is the primary key for “eligible to receive certificate.”
  - **Generation:** For a single eligible learner, Laravel creates a **temporary one-row CSV**, runs the Python script with that CSV and a dedicated **output directory** under Laravel storage, then serves the generated PDF via a **tokenised download** link.

---

## 2. Step-by-Step Plan (What Was Implemented)

| Step | Component | Purpose |
|------|----------|--------|
| 1 | **Config** `config/certificates.php` | Paths for Python base, script, learner CSVs, storage subdirs, timeout, token expiry. |
| 2 | **Env** | `CERTIFICATE_PYTHON_PATH`, `CERTIFICATE_LEARNER_CSVS`, optional `CERTIFICATE_PROCESS_TIMEOUT`, `CERTIFICATE_DOWNLOAD_EXPIRY_HOURS`. |
| 3 | **Service** `App\Services\CertificateEligibilityService` | Reads learner CSVs from config path, finds learner by (normalised) ID; returns name, surname, certificate_number. Caches result briefly. |
| 4 | **Migration** `certificate_downloads` | Stores: id_number, name, surname, email, storage_path, download_token, expires_at. |
| 5 | **Job** `App\Jobs\GenerateCertificateJob` | Builds one-row temp CSV, runs Python script via `Symfony\Component\Process\Process` with quoted paths, then creates a `CertificateDownload` record with a unique token. |
| 6 | **Controller** `CertificationController` | `showForm()` → form; `submit()` → validate, eligibility lookup, dispatch job **synchronously** (`dispatchSync`), redirect to download with token; `download()` → validate token, serve PDF. |
| 7 | **Routes** | `GET lms/certification` (form), `POST lms/certification` (submit), `GET lms/certification/download?token=...` (throttled). |
| 8 | **Views** | `resources/views/certification/form.blade.php` (Name, Surname, ID Number, Email). |

**CSV path / learner data:**  
Learner CSVs live in the **Python project folder** (e.g. `Training_certifactes`). Config points to that folder via `CERTIFICATE_PYTHON_PATH` and lists CSV filenames in `CERTIFICATE_LEARNER_CSVS`. No copy/sync into Laravel storage is required; Laravel reads the CSVs from that path for eligibility only. Add or change CSVs in config when you add new cohorts.

---

## 3. Flow Walkthrough

### Happy path

1. User opens **kayiseit.com/lms/certification** (or equivalent).
2. Submits **Name, Surname, ID Number** (required), **Email** (optional).
3. Laravel normalises ID (trim, strip spaces), looks it up in `CertificateEligibilityService` (learner CSVs).
4. **ID found** → Controller builds learner payload, generates a token, runs `GenerateCertificateJob::dispatchSync(...)`.
5. Job: creates temp one-row CSV under `storage/app/certificates/temp/`, runs e.g.  
   `python3 "/path/to/certificate_template.py" "/path/to/temp.csv" --output-dir "/path/to/storage/app/certificates/output"`.
6. Script creates `output/<stem>/Certificate_<Name_Surname>.pdf`. Job records path and token in `certificate_downloads`.
7. Controller redirects to `lms/certification/download?token=...`.
8. User gets PDF download; only holders of the link (token) can download.

### Failure path: ID not found

1. User submits an ID that does not appear in any configured learner CSV.
2. `CertificateEligibilityService::findLearnerById()` returns `null`.
3. Controller returns back with validation error: *“This ID number was not found in our records. If you believe this is an error, please contact support.”*

### Failure path: Script missing / process error

1. Python script path wrong or not readable, or process times out / fails.
2. Job logs the error and does **not** create a `CertificateDownload` record.
3. After `dispatchSync`, controller finds no record for the token → redirects to form with: *“Certificate generation failed. Please try again or contact support.”*

### Failure path: Invalid or expired token

1. User opens `lms/certification/download` without `token` or with wrong/expired token.
2. Controller redirects to form with *“Invalid or expired download link.”*

---

## 4. Failure Modes & Mitigations

| Risk | Mitigation |
|------|------------|
| **Paths with spaces** (e.g. `Python Programs`) | All paths passed to the shell are wrapped in `escapeshellarg()` so the script and CSV/output paths are quoted. |
| **Python / script not found** | Job checks `is_readable($scriptPath)` and logs; controller shows generic failure message. Set `CERTIFICATE_PYTHON_PATH` and ensure `python3` is on `PATH` (or set `CERTIFICATE_PYTHON_BINARY`). |
| **CSV missing or unreadable** | Eligibility service logs a warning and skips that CSV; if no CSV has the ID, user sees “ID not found”. Ensure CSVs exist and Laravel (web server user) can read them. |
| **Output/temp dir not writable** | Job creates dirs with `mkdir(..., 0755, true)`; on failure it logs and returns null → user sees “Certificate generation failed”. Fix storage permissions (`storage/app/certificates/`). |
| **Request timeout** | Generation runs synchronously (`dispatchSync`). If the script is slow, increase `CERTIFICATE_PROCESS_TIMEOUT` and PHP `max_execution_time` / web server timeout. For high load, consider moving to async queue + email link. |
| **ID format** | IDs are normalised (trim, remove spaces). No strict format enforced; eligibility is “ID present in CSV”. Add format validation in the controller if you need it (e.g. SA ID format). |
| **Abuse / rate limit** | Download route uses `throttle:10,1` (10 requests per minute per user). Add stricter throttling or auth if needed. |

---

## 5. Configuration (.env)

Add or adjust (paths are examples for local MAMP):

```env
# Full path to the Training_certifactes folder (no trailing slash)
CERTIFICATE_PYTHON_PATH="/Applications/MAMP/htdocs/Python Programs/Training_certifactes"

# Comma-separated CSV filenames (relative to path above)
CERTIFICATE_LEARNER_CSVS="barberton_learners.csv,kabokweni_learners.csv"

# Optional
CERTIFICATE_PYTHON_BINARY="python3"
CERTIFICATE_PROCESS_TIMEOUT=60
CERTIFICATE_DOWNLOAD_EXPIRY_HOURS=24
```

---

## 6. Queue (Optional)

The feature uses **synchronous** execution (`dispatchSync`) so the user is redirected to the download immediately. No queue worker is required.

If you later want to avoid timeouts and send the link by email:

- Set `QUEUE_CONNECTION=database` (and run `php artisan queue:table` + migrate if the `jobs` table does not exist).
- In the controller, replace `dispatchSync` with `dispatch()`.
- In the job, after creating the `CertificateDownload` record, send an email with `route('certification.download', ['token' => $this->downloadToken])`.
- Redirect the user to a “Your certificate is being generated; you will receive an email with the download link” page.

---

## 7. Security Summary

- **Eligibility:** Only IDs present in the configured learner CSVs can trigger generation.
- **Download:** Only someone with the one-time (per generation) token can download; token can be expired via `expires_at`.
- **Paths:** Script and file paths are not exposed to the client; only the token is in the URL.

---

## 8. Files Touched / Added

- `config/certificates.php` — new
- `app/Services/CertificateEligibilityService.php` — new
- `app/Jobs/GenerateCertificateJob.php` — new
- `app/Http/Controllers/CertificationController.php` — new
- `app/Models/CertificateDownload.php` — new
- `database/migrations/2026_02_23_192223_create_certificate_downloads_table.php` — new
- `resources/views/certification/form.blade.php` — new
- `routes/web.php` — certification routes added
- `resources/views/student/dashboard.blade.php` — “Request Certificate” quick action added
