<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use App\Http\Resources\Api\ReviewResource;
use App\Http\Requests\Api\ReviewStoreRequest;
use App\Mail\Admin\ReviewSubmittedMail;
use App\Support\AdminNotificationRecipients;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ReviewController extends ApiController
{
    public function __construct()
    {
        $this->model = Review::class;
        $this->resource = ReviewResource::class;
    }

    public function store(ReviewStoreRequest $request)
    {
        $item = $this->model::create($request->validated());

        $resolvedRecipients = AdminNotificationRecipients::resolve('review');
        $recipients = $resolvedRecipients['recipients'];
        if (! empty($recipients)) {
            Log::info('admin_notification.review.preparing', [
                'review_id' => $item->id,
                'to' => $recipients,
                'recipient_source' => $resolvedRecipients['source'],
                'mailer' => config('mail.default'),
                'smtp_host' => config('mail.mailers.smtp.host'),
                'smtp_port' => config('mail.mailers.smtp.port'),
                'smtp_scheme' => config('mail.mailers.smtp.scheme'),
                'mail_from' => config('mail.from.address'),
            ]);
            try {
                Mail::to($recipients)->send(new ReviewSubmittedMail($item));
                Log::info('admin_notification.review.sent', [
                    'review_id' => $item->id,
                    'to' => $recipients,
                ]);
            } catch (\Throwable $e) {
                Log::error('admin_notification.review.failed', [
                    'review_id' => $item->id,
                    'to' => $recipients,
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                ]);
                report($e);
            }
        } else {
            Log::warning('admin_notification.review.skipped_no_recipients', [
                'review_id' => $item->id,
                'recipient_source' => $resolvedRecipients['source'],
                'config_cached' => app()->configurationIsCached(),
                'notifications_config_present' => config()->has('notifications.admin_emails'),
            ]);
        }

        return new $this->resource($item);
    }
}
