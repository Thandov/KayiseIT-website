<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Certificate generator (Python) paths
    |--------------------------------------------------------------------------
    | Default: training-certificates/ inside this app (works locally and on any
    | server path). Override CERTIFICATE_PYTHON_PATH in .env only if files live
    | elsewhere (e.g. legacy folder outside the repo).
    */
    'python_base_path' => rtrim((string) env('CERTIFICATE_PYTHON_PATH', base_path('training-certificates')), '/\\'),
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
    'learner_csvs' => array_values(array_filter(array_map('trim', explode(',', (string) env(
        'CERTIFICATE_LEARNER_CSVS',
        'barberton_learners.csv,kabokweni_learners.csv'
    ))))),

    /*
    |--------------------------------------------------------------------------
    | Output and temp storage (Laravel)
    |--------------------------------------------------------------------------
    | Generated PDFs are stored under storage/app/certificates/ (see disks below).
    | Temp one-row CSVs are created under certificates/temp/ and removed after use.
    |
    | CERTIFICATE_DISK_ROOT: optional absolute path (writable) to store PDFs when
    | storage/app is full or not writable (same disk as the app is fine).
    */
    'storage_disk' => env('CERTIFICATE_STORAGE_DISK', 'certificates_local'),
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
    | Certificate logo path (relative to public/)
    |--------------------------------------------------------------------------
    */
    'logo_path' => env('CERTIFICATE_LOGO_PATH', 'images/kayise-logo.png'),
];
