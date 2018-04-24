<?php

namespace App\Notifications;

use App\Message;
use App\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessage extends Notification
{
    use Queueable;
    /**
     * @var Message
     */
    private $message;
    /**
     * @var Ticket
     */
    private $ticket;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message, Ticket $ticket)
    {

        $this->message = $message;
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Ticket n°' . $this->ticket->id . ' - Nouveau Message')
            ->line('Vous avez reçu un nouveau message sur le ticket N° ' . $this->ticket->id)
            ->line('Message : ' . $this->message->content)
            ->action('Consulter la conversation', route('ticket.show', $this->ticket));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
