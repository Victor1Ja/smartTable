<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformAdminOfNewUser extends Notification
{
    use Queueable;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello Supercool Admin,')
            ->line('Great news! A new user has just registered:')
            ->line('Name: ' . $this->user->name)
            ->line('Email: ' . $this->user->email)
            ->line('Registration Date: ' . $this->user->created_at->format('F j, Y \a\t h:i A'))
            ->action('View User Profile', route('dashboard', $this->user))
            ->line('Thanks for your prompt attention and excellent follow-up!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
