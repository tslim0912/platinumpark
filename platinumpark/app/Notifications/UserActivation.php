<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserActivation extends Notification {

    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $full_name = $this->user->fullname;

        return (new MailMessage)
                        ->subject('Congratulation')
                        ->greeting('Hello, <span style="font-weight:normal">' . $full_name . "</span>")
                        ->line("Your account has been activated. <br/> Please kindly click the link below.")
                        ->action('Login Now', config("app.frontend_url") . '/login/')
                        ->salutation("Regards, <br/>" . env("MAIL_REGARDS"))
                        ->success();
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
                //
        ];
    }

}
