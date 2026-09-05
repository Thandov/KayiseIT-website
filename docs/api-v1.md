# Kayise IT API v1

Base URL: `https://www.kayiseit.com/api/v1`

All list endpoints return a Laravel pagination envelope: `{ "data": [...], "links": {...}, "meta": {...} }`.  
Detail endpoints return `{ "data": { ... } }`. Field names are `snake_case`. Dates are ISO-8601 where timestamps are returned; program recruitment dates are `Y-m-d`.

Public routes are rate-limited (`api-public`, 60 requests/minute per IP). CORS currently allows all origins for `api/*`; tighten `config/cors.php` when client origins are known.

## Status codes

| Code | Meaning |
|------|---------|
| 200 | Success |
| 401 | Missing/invalid Sanctum bearer token |
| 403 | Authenticated but lacking permission |
| 404 | Resource not found or not public |
| 429 | Rate limit exceeded |

## Public endpoints

### `GET /health`

```json
{ "status": "ok", "service": "kayiseit-api", "version": "v1" }
```

### `GET /services`

Paginated service catalog. Query: `per_page` (1–50, default 15).

### `GET /services/{slug}`

Single service by public slug (hyphen or underscore form). Includes `subservices` when present.

### `GET /blogs`

Paginated posts (newest first). Query: `per_page`.

### `GET /blogs/{id}`

Full post including `content`, `meta_title`, `meta_description`.

### `GET /programs`

Active internship/TVET/short programs only. Query:

- `per_page`
- `status` — `enquiry` | `running` | `recruiting` (optional)

Does **not** expose application form schemas, applicants, or private documents.

### `GET /programs/{id}`

Active program detail (requirements and accreditation on show).

### `GET /case-studies`

Published case studies, featured/order sort. Query: `per_page`.

### `GET /case-studies/{slug}`

Published detail including gallery, problem/solution/results, quote.

## Private endpoints

All require header: `Authorization: Bearer {sanctum_token}`.

Create a token:

```php
$user->createToken('api-client')->plainTextToken;
```

### `GET /user`

Safe profile subset only (`id`, `name`, `surname`, `email`, `phone`, `email_verified_at`). Never returns ID numbers, document paths, or passwords.

### `GET /staff` · `GET /staff/{id}`

Requires dashboard access (staff or admin). Safe organogram-style fields only — **no** ID numbers, personal email, DOB, address, or document paths. Query: `per_page`.

### `GET /clients` · `GET /clients/{id}`

Requires `clients.*` access (`canAccessClients` / `clients.read`). Query: `per_page`, `status=lead|client`.

### `GET /announcements` · `GET /announcements/{id}`

Requires dashboard access. Query: `per_page`, `active=1` (currently active and unexpired only).

### `GET /invoices` · `GET /invoices/{id}`

Requires dashboard access. Detail includes line `items`. Query: `per_page`.

### `GET /quotations` · `GET /quotations/{id}`

Requires dashboard access. Detail includes line `items`. Query: `per_page`.

## Example

```bash
curl -sS https://www.kayiseit.com/api/v1/programs?status=running
curl -sS -H "Authorization: Bearer TOKEN" -H "Accept: application/json" \
  https://www.kayiseit.com/api/v1/staff
curl -sS -H "Authorization: Bearer TOKEN" -H "Accept: application/json" \
  https://www.kayiseit.com/api/v1/clients?status=lead
```
