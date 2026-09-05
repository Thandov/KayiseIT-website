<?php

return [
    'timeout' => (int) env('LMIS_HTTP_TIMEOUT', 10),
    'connect_timeout' => (int) env('LMIS_CONNECT_TIMEOUT', 5),
    'max_attempts' => (int) env('LMIS_MAX_ATTEMPTS', 10),
];
