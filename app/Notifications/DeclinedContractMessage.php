<?php

namespace App\Notifications;

use App\Event;
use App\Http\Controllers\Contract\Recipient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class DeclinedContractMessage extends Notification
{
    use Queueable;

    protected $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        $recipient = (object) (new Recipient($this->event))->get();

        $comments = ($this->event->td_notes) ? ' Comments: ' . $this->event->td_notes : '';

        $content = 'Quote declined: ' . $recipient->first_name . ' ' . $recipient->last_name . ' ' . $recipient->phone . '.' . $comments . ' ' . config('company.leapurl') . '/view_client.php?client=' . $this->event->id;

        return (new NexmoMessage)->content($content);
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
