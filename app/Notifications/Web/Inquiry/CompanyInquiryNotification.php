<?php

namespace App\Notifications\Web\Inquiry;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Carbon\Carbon;

class CompanyInquiryNotification extends Notification
{
    use Queueable;

    private $type;
    private $request;
    private $companyinq;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $request, $companyinq)
    {
        $this->type = $type;
        $this->request = $request;
        $this->companyinq = $companyinq;
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
                    ->line('New company inquiry from user ')
                    ->line('Email : '. $this->request->email)
                    ->line('Company Name : '. $this->request->name)
                    ->line('Lead Contact Name : '. $this->request->leadcontact)
                    ->line('Position : '. $this->request->position)
                    ->line('Contact # : '. $this->request->contact_number)
                    ->line('Purpose : '. $this->request->purpose)
                    ->line('Preferred Date: '. Carbon::parse($this->request->preferreddate)->format('M d, Y'))
                    ->line('Number of participants: '. $this->request->participants)
                    ->line('Concern :')
                    ->line($this->request->concerns);
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
            'message' => $this->request->purpose,
            'subject_id' => $this->companyinq->id, 
            'subject_type' => get_class($this->companyinq),
        ];
    }
}
