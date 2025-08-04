<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data = array('email' => $notifiable->email);
        $queryString =  http_build_query($data);
        $url = route('reset', ['token' => $this->token]) . "?" . $queryString;
        $blade = 'web.mail.account_verification';
        $name = $notifiable->fullname;

        return (new MailMessage)
            ->subject('Reset Password Notification')
            // ->line('You are receiving this email because we received a password reset request for your account.')
            // ->action('Reset Password', $url)
            // ->line('This password reset link will expire in 60 minutes.')
            // ->line(' If you did not request a password reset, no further action is required.')
            ->markdown($blade, ['url' => $url, 'title' => 'Reset Password Notification', 'name' => $name])
            ->from(config('mail.from.web_address'), config('mail.from.web_name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
