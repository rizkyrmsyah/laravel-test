<?php

return [
    'alg' => env('JWT_ALG'),
    'secret' => env('JWT_SECRETKEY'),
    'exp' => env('JWT_EXP', 3600),
    'nbf' => env('JWT_NBF'),
    'iss' => env('JWT_ISS', 'localhost'),
];
