<?php

namespace App\Notifications;

use App\Models\LegalPerson;
use App\Models\NaturalPerson;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Tzsk\Sms\Builder;
use Tzsk\Sms\Channels\SmsChannel;

class RandomNotification extends Notification
{
    use Queueable;

    private string $message;
    private string $gateway;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $message, string $gateway)
    {
        $this->message = $message;
    }

    /**
     * Get the notification channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    /**
     * Get the repicients and body of the notification.
     *
     * @param LegalPerson|NaturalPerson|User $notifiable
     * @return Builder
     */
    public function toSms(User|NaturalPerson|LegalPerson $notifiable)
    {
        return (new Builder)->via($this->gateway)
        ->send($this->message)
            ->to($notifiable->phone);
    }
}
