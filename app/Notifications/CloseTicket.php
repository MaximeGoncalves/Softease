<?php

namespace App\Notifications;

use App\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CloseTicket extends Notification
{
    use Queueable;
    /**
     * @var Ticket
     */
    private $ticket;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {

        $this->ticket = $ticket;
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
        return (new MailMessage)
            ->subject('Cloture ticket n° '. $this->ticket->id)
            ->line('Madame, Monsieur, sauf erreur de notre part, nous vous confirmons la clôture de votre ticket n°'. $this->ticket->id . '.')
            ->line('<u>Objet :</u> '. $this->ticket->topic)
            ->line('<u>Description :</u> '. $this->ticket->description)
            ->line('<br>');

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
