<?php

namespace App\Notifications;

use App\Appointment;
use App\Channels\FcmChannel;
use App\Http\Resources\AppointmentResource;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentSucessBookingNotification extends Notification
{
    use Queueable;
    protected $title;
    protected $message;
    protected $type;
    protected $type_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment, $type, $title_en, $title_cn, $message_en, $message_cn)
    {

        $this->title_en = $title_en;
        $this->title_cn = $title_cn;
        $this->message_en = $message_en;
        $this->message_cn = $message_cn;
        $this->type = $type;
        $this->type_id = $appointment->id;
        $this->required_reply = false;
        $this->action_button_text = 'Appointment Detail';
        $this->data = new AppointmentResource($appointment);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FcmChannel::class, 'database'];
    }



    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
            "title_en" => $this->title_en,
            "title_cn" => $this->title_cn,
            "message_en" => $this->message_en,
            "message_cn" => $this->message_cn,
            "type" => $this->type,
            "type_id" => $this->type_id,
            "required_reply" => $this->required_reply,
            "action_button_text" => $this->action_button_text,
            "data" => $this->data
        ];
    }

    public function toFcm($notifiable)
    {
        return (object) $this->toArray($notifiable);
    }
}
