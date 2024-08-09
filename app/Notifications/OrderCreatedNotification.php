<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
            ->subject("New order #{$this->order->number}")
            ->from(env('MAIL_FROM_ADDRESS'), 'Mustafa Store')
            ->greeting("Hi {$notifiable->name},")
            ->line("New Order #({$this->order->number}) created By {$addr->first_name} from {$addr->country}.")
            ->action('View Order', url('/dashboard'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable)
    {
        $addr = $this->order->billingAddress;
        return [
            'body' => "New Order #({$this->order->number}) created By {$addr->first_name} from {$addr->country}.",
            'order_id' => $this->order->id,
            'icon' => 'bi bi-file-earmark-fill',
            'url' => url('/dashboard')
        ];
    }


    public function toBroadcast()
    {
        $addr = $this->order->billingAddress;
        // can return array
        // return [
        //     'body' => "New Order #({$this->order->number}) created By {$addr->first_name} from {$addr->country}.",
        //     'order_id' => $this->order->id,
        //     'icon' => 'bi bi-file-earmark-fill',
        //     'url' => url('/dashboard')
        // ];

        return new BroadcastMessage([
            'body' => "New Order #({$this->order->number}) created By {$addr->first_name} from {$addr->country}.",
            'order_id' => $this->order->id,
            'icon' => 'bi bi-file-earmark-fill',
            'url' => url('/dashboard')
        ]);


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
