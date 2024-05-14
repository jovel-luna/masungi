<?php

namespace App\Notifications\Web\Inquiry;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Carbon\Carbon;

class SchoolInquiryNotification extends Notification
{
    use Queueable;

    private $type;
    private $request;
    private $trail;
    private $schoolinq;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $request, $trail, $shoolinq)
    {
        $this->type = $type;
        $this->request = $request;
        $this->trail = $trail;
        $this->schoolinq = $shoolinq;
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
                    ->line('New school inquiry from user ')
                    ->line('School : '. $this->request->school)
                    ->line('Lead Contact : '. $this->request->leadcontact)
                    ->line('Position : '. $this->request->position)
                    ->line('Email : '. $this->request->email)
                    ->line('Contact # : '. $this->request->contact_number)
                    ->line('Year Level : '. $this->request->yearlevel)
                    ->line('Preferred Date: '. Carbon::parse($this->request->preferreddate)->format('M d, Y'))
                    ->line('Preferred Time: '. Carbon::parse($this->request->preferredtime)->format('H:i A'))
                    ->line('Preferred Trail : '. $this->trail->name)
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
            'message' => $this->type,
            'subject_id' => $this->schoolinq->id, 
            'subject_type' => get_class($this->schoolinq),
        ];
    }
}
