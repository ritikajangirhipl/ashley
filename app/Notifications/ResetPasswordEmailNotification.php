<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordEmailNotification extends Notification
{
    use Queueable;

    protected $reset_password_url;

    /**
     * Create a new notification instance.
     */
    public function __construct($reset_password_url)
    {
        $this->reset_password_url = $reset_password_url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('global.reset_password'))
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $this->reset_password_url)
            ->line('If you did not request a password reset, no further action is required.');
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
