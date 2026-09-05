<?php

/*
| Some deployments keep `training-certificates/` at the app root (next to
| `public/`). Others only have it under `public/training-certificates/`.
| Empty CERTIFICATE_PYTHON_PATH in .env must not override with a blank string.
*/
$defaultTrainingCertificatesPath = is_dir(base_path('training-certificates'))
    ? base_path('training-certificates')
    : public_path('training-certificates');

return [

    /*
    |--------------------------------------------------------------------------
    | Certificate generator (Python) paths
    |--------------------------------------------------------------------------
    | Default: app-root `training-certificates/`, else `public/training-certificates/`.
    | Override CERTIFICATE_PYTHON_PATH in .env when files live elsewhere.
    */
    'python_base_path' => rtrim((string) (env('CERTIFICATE_PYTHON_PATH') ?: $defaultTrainingCertificatesPath), '/\\'),
    'python_script' => 'certificate_template.py',
    'python_binary' => env('CERTIFICATE_PYTHON_BINARY', 'python3'),

    /*
    |--------------------------------------------------------------------------
    | Learner eligibility CSVs
    |--------------------------------------------------------------------------
    | List of CSV filenames (relative to python_base_path) used to determine
    | eligibility. Columns must be: Name, Surname, ID number, Certificate number.
    | ID number is the primary key for eligibility.
    */
    'learner_csvs' => array_values(array_filter(array_map('trim', explode(',', (string) (env('CERTIFICATE_LEARNER_CSVS') ?: 'barberton_learners.csv,kabokweni_learners.csv'))))),

    /*
    |--------------------------------------------------------------------------
    | Output and temp storage (Laravel)
    |--------------------------------------------------------------------------
    | Generated PDFs are stored under storage/app/certificates/ (see disks below).
    | Temp one-row CSVs are created under certificates/temp/ and removed after use.
    */
    /*
    | If .env sets CERTIFICATE_STORAGE_DISK= (empty), env() returns '' — never use that as a disk name.
    */
    'storage_disk' => (($t = trim((string) env('CERTIFICATE_STORAGE_DISK', 'local'))) !== '') ? $t : 'local',
    'storage_subdir' => 'certificates',
    'temp_subdir' => 'certificates/temp',
    'output_subdir' => 'certificates/output',

    /*
    |--------------------------------------------------------------------------
    | Generation behaviour
    |--------------------------------------------------------------------------
    */
    'process_timeout_seconds' => (int) env('CERTIFICATE_PROCESS_TIMEOUT', 60),
    'download_token_expiry_hours' => (int) env('CERTIFICATE_DOWNLOAD_EXPIRY_HOURS', 24),

    /*
    |--------------------------------------------------------------------------
    | Training / course name (displayed on success page)
    |--------------------------------------------------------------------------
    */
    'training_name' => env('CERTIFICATE_TRAINING_NAME', 'Business Essentials for Entrepreneurs'),

    /*
    |--------------------------------------------------------------------------
    | Certificate email copy (optional)
    |--------------------------------------------------------------------------
    | Comma-separated addresses (e.g. info@kayiseit.com) that receive a BCC on
    | every certificate PDF mail — useful to confirm sends when learners report
    | missing mail. Leave empty in production if not needed.
    */
    'email_bcc_addresses' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('CERTIFICATE_EMAIL_BCC', ''))
    ))),

    /*
    |--------------------------------------------------------------------------
    | Certificate logo path (relative to public/)
    |--------------------------------------------------------------------------
    */
    'logo_path' => env('CERTIFICATE_LOGO_PATH', 'images/kayise_IT_logo_No_Background.png'),
];
