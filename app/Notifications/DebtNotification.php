<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DebtNotification extends Notification
{
    use Queueable;

    public $rememberDebt;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rememberDebt)
    {
        $this->rememberDebt = $rememberDebt;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
    public function toDatabase()
    {
        return [
            'debt_id' => $this->rememberDebt->id,
            'debt_title' => $this->rememberDebt->title,
        ];
    }
}
