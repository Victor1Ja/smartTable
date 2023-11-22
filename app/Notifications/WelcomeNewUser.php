<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNewUser extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to Smart Table')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Welcome to our <strong>delicious blog</strong>! We hope you brought your appetite for great content.')
            ->line('Why did the tomato turn red? Because it saw the salad dressing!')
            ->action('Explore Our Restaurants', route('restaurants.index'))
            ->line('Thank you for joining us on this flavor-packed journey!')
            ->salutation('Cheers,<br/><br/>The Culinary Connoisseurs at Smart Table');
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
