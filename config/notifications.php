<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Notification Recipients
    |--------------------------------------------------------------------------
    |
    | Comma-separated list of email addresses that should receive admin
    | notifications (e.g. contact messages, new reviews, etc.).
    |
    */
    'admin_emails' => array_values(array_filter(array_map(
        static fn (string $email): string => trim($email),
        explode(',', (string) env('ADMIN_NOTIFICATION_EMAILS', env('ADMIN_NOTIFICATION_EMAIL')))
    ))),

    'review_emails' => array_values(array_filter(array_map(
        static fn (string $email): string => trim($email),
        explode(',', (string) env('REVIEW_NOTIFICATION_EMAILS', ''))
    ))),

    'contact_emails' => array_values(array_filter(array_map(
        static fn (string $email): string => trim($email),
        explode(',', (string) env('CONTACT_NOTIFICATION_EMAILS', ''))
    ))),

    'teacher_application_emails' => array_values(array_filter(array_map(
        static fn (string $email): string => trim($email),
        explode(',', (string) env('TEACHER_APPLICATION_NOTIFICATION_EMAILS', ''))
    ))),
];
