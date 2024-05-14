<?php

namespace App\Notifications\Web\Newsletters;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Carbon\Carbon;

class NewsletterNotification extends Notification
{
    use Queueable;

    private $type;
    private $request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $request)
    {
        $this->type = $type;
        $this->request = $request;
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
                    ->line('Subscribers email : '. $this->request->email)
                    ->line($this->request->concern);
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
            'subject_id' => $notifiable->id, 
            'subject_type' => get_class($notifiable),
        ];
    }
}
