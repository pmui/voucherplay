<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrxSuccessNotification extends Notification
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
        return (new MailMessage)
            ->subject('Transaksi berhasil #'.$this->order->id)
            ->greeting('Selamat Transaksi Anda berhasil!')
            ->line('Terimakasih telah berbelanja di toko kami. Berikut adalah rincian tranasaki Anda:')
            ->line('ID      : '.$this->order->id)
            ->line('Game      : '.$this->order->game->title)
            ->line('Item      : '.$this->order->product_code)
            ->lineif($this->order->voucher_code,'Kode Voucher      : '.$this->order->voucher_code)
            ->line('No. Reference      : '.$this->order->reference)
            ->line('')
            ->line('Ini adalah email otomtis, harap tidak membalas email ini.');

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

    public function toMailUsing($notifiable)
    {
        return (new MailMessage)
            ->view('vendor.mail.html.message', ['url' => 'https://digitalprima.co.id', 'logo' => 'https://i0.wp.com/pmui.co.id/wp-content/uploads/2022/09/Logo-1.png'])
            ->subject('Subjek email baru');
    }
}
