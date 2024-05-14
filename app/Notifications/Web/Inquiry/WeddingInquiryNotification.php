<?php

namespace App\Notifications\Web\Inquiry;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Carbon\Carbon;

class WeddingInquiryNotification extends Notification
{
    use Queueable;

    private $type;
    private $request;
    private $wedinq;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $request, $wedinq)
    {
        $this->type = $type;
        $this->request = $request;
        $this->wedinq = $wedinq;
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
                    ->line('New wedding inquiry from user ')
                    ->line('Fullname : '. $this->request->fullname)
                    ->line('Email : '. $this->request->email)
                    ->line('Contact # : '. $this->request->contact_number)
                    ->line('Number of guests: '. $this->request->guestsnumber)
                    ->line('Preferred Date: '. Carbon::parse($this->request->date)->format('M d, Y'))
                    ->line('Type of Event : '. $this->request->eventtype)
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
            'message' => $this->request->eventtype,
            'subject_id' => $this->wedinq->id, 
            'subject_type' => get_class($this->wedinq),
        ];
    }
}
