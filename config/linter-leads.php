<?php

// config for Pardalsalcap/LinterLeads
return [
    'status' => [
        'new',
        'read',
        'follow_up',
        'fail',
        'success',
    ],
    'mappings' => [
        'contact' => [
            'email' => 'email',
            'phone' => 'phone',
            'name' => 'name',
            'message' => 'message',
        ],
        'newsletter' => [
            'email' => 'email',
        ],
    ],
    'lead_manager_email' => 'dani.casasnovas@gmail.com',
    'lead_manager_name' => 'Dani Casasnovas',
    'spam_score_threshold' => 5,
];
