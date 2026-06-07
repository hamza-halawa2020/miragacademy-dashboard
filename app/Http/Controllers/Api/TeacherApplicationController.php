<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TeacherApplicationStoreRequest;
use App\Mail\Admin\TeacherApplicationSubmittedMail;
use App\Models\Staff;
use App\Support\AdminNotificationRecipients;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TeacherApplicationController extends ApiController
{
    public function store(TeacherApplicationStoreRequest $request)
    {
        $payload = $request->validated();

        $item = Staff::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'],
            'country' => $payload['country'],
            'job_title' => $payload['job_title'],
            'description' => $payload['message'],
            'status' => 0,
            'created_by' => null,
        ]);

        $resolvedRecipients = AdminNotificationRecipients::resolve('teacher_application');
        $recipients = $resolvedRecipients['recipients'];
        if (! empty($recipients)) {
            Log::info('admin_notification.teacher_application.preparing', [
                'staff_id' => $item->id,
                'to' => $recipients,
                'recipient_source' => $resolvedRecipients['source'],
                'mailer' => config('mail.default'),
                'smtp_host' => config('mail.mailers.smtp.host'),
                'smtp_port' => config('mail.mailers.smtp.port'),
                'smtp_scheme' => config('mail.mailers.smtp.scheme'),
                'mail_from' => config('mail.from.address'),
            ]);
            try {
                Mail::to($recipients)->send(new TeacherApplicationSubmittedMail($item));
                Log::info('admin_notification.teacher_application.sent', [
                    'staff_id' => $item->id,
                    'to' => $recipients,
                ]);
            } catch (\Throwable $e) {
                Log::error('admin_notification.teacher_application.failed', [
                    'staff_id' => $item->id,
                    'to' => $recipients,
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                ]);
                report($e);
            }
        } else {
            Log::warning('admin_notification.teacher_application.skipped_no_recipients', [
                'staff_id' => $item->id,
                'recipient_source' => $resolvedRecipients['source'],
                'config_cached' => app()->configurationIsCached(),
                'notifications_config_present' => config()->has('notifications.admin_emails'),
            ]);
        }

        return response()->json(['message' => 'Teacher application submitted successfully.','id' => $item->id,'status' => $item->status], 201);
    }
}
