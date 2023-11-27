<?php

// config for Pardalsalcap/LinterLeads
return [
    'status' => [
        'new',
        'read',
        'follow_up',
        'fail',
        'success'
    ],
    'mappings'=>[
        'contact' => [
            'email' => 'email',
            'phone' => 'phone',
            'name' => 'name',
            'message' => 'message',
        ],
        'newsletter_form' => [
            'email' => 'email',
        ],
    ]
];
