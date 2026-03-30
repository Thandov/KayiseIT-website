<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Certificate generator (Python) paths
    |--------------------------------------------------------------------------
    | Base path to the Training_certifactes folder. Use full filesystem path.
    | Paths with spaces must be valid; we quote them when calling the script.
    */
    'python_base_path' => env('CERTIFICATE_PYTHON_PATH', '/Applications/MAMP/htdocs/Python Programs/Training_certifactes'),
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
    'learner_csvs' => array_filter(explode(',', env('CERTIFICATE_LEARNER_CSVS', 'barberton_learners.csv,kabokweni_learners.csv'))),

    /*
    |--------------------------------------------------------------------------
    | Output and temp storage (Laravel)
    |--------------------------------------------------------------------------
    | Generated PDFs are stored under storage/app/certificates/ (see disks below).
    | Temp one-row CSVs are created under certificates/temp/ and removed after use.
    */
    'storage_disk' => env('CERTIFICATE_STORAGE_DISK', 'local'),
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
    'logo_path' => env('CERTIFICATE_LOGO_PATH', 'images/kayise_IT_logo_No_Background.png'),
];
