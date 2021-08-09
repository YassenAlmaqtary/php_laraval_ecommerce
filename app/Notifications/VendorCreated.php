<?php

namespace App\Notifications;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorCreated extends Notification 
{

    public $vendor; 
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
   

    public function __construct(Vendor $vendor)
    {
        $this->vendor;
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
        $subject = sprintf('%s:" " لقد تم انشاء حسابكم في موقع  %s!','بواستطة', 'admin');
        $greeting = sprintf('مرحبا %s!', $notifiable->name);
        return (new MailMessage)
                   ->subject($subject)
                   ->greeting($greeting)
                   ->line('الرجاء التوجة للاقرب مكتب وتفعيل الاشتراك')
                    ->action('Notification Action', url('/'))
                    ->line('شكرا لتسجيلكم معنا ونتمنى لكم تجربة ممتعة');
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
