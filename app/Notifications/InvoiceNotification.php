<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceNotification extends Notification
{
    use Queueable;

    public Order $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
        $message = new MailMessage();

        $message
            ->subject('Menunggu Pembayaran #'.$this->order->id)
            ->greeting('Halo')
            ->line('Harap selesaikan pembayaran Anda ')
            ->line('ID      : '.$this->order->id)
            ->line('Game      : '.$this->order->game_code)
            ->line('Item      : '.$this->order->product_code)
            ->line('Metode Pembayaran      : '.$this->order->payment->paymentMethod->name)
            ->lineIf($this->order->payment->va_number > 0, 'Nomor VA    : '.$this->order->payment->va_number)
            ->line('Total Tagihan      : Rp. '.number_format($this->order->payment->total))
            ->line('Batas Waktu Pembayaran      : '.date('l, d F Y H:i', strtotime($this->order->payment->expire)))
            ->action('Lakukan Pembayaran', route('order.show',$this->order));




        return  $message;
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
