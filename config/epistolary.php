<?php

return [

    'attachments' => [
        'storage' => storage_path('emails/attachments'),
        'public' => public_path('emails/attachments'),
    ],

    'stats' => [
        'on' => false,
        'provider' => \Pilaster\Epistolary\Services\MailgunStats::class,
    ],

];
