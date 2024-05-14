<?php

namespace App\Notifications\Web\Inquiry;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserInquiryNotification extends Notification
{
    use Queueable;

    private $type;
    private $request;
    private $contactus;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $request, $contactus)
    {
        $this->type = $type;
        $this->request = $request;
        $this->contactus = $contactus;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject(config('app.name') . ': ' . $this->type)
                    ->greeting('Hello ' . $notifiable->renderName() . ',')
                    ->line('New inquiry from user ')
                    ->line('Name : '. $this->request->firstname. ' '. $this->request->lastname)
                    ->line('Email : '. $this->request->email)
                    ->line('Contact Number : '. $this->request->contact_number)
                    ->line('Affiliation : '. $this->request->affliation)
                    ->line('Nationality : '. $this->request->nationality)
                    ->line('Message :')
                    ->line($this->request->message);
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
            'title' => $this->type,
            'message' => $this->request->message,
            'subject_id' => $this->contactus->id,
            'subject_type' => get_class($this->contactus),
        ];
    }
}
