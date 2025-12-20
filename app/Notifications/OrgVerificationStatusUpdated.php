<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\OrgVerification;

class OrgVerificationStatusUpdated extends Notification
{
    use Queueable;

    /**
     * @var OrgVerification
     */
    protected $verification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(OrgVerification $verification)
    {
        $this->verification = $verification;
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
        $status = $this->verification->status;
        $organizationName = $this->verification->organization_name;

        if ($status === 'approved') {
            return (new MailMessage)
                ->subject('Organization Verification Approved')
                ->line('Congratulations! Your organization, ' . $organizationName . ', has been approved.')
                ->action('View Dashboard', url('/dashboard'))
                ->line('Thank you for using our application!');
        } else {
            return (new MailMessage)
                ->subject('Organization Verification Rejected')
                ->line('We are sorry to inform you that your verification for ' . $organizationName . ' has been rejected.')
                ->line('Reason: ' . $this->verification->admin_notes)
                ->line('Please review the feedback and resubmit your application if necessary.');
        }
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
            'verification_id' => $this->verification->id,
            'status' => $this->verification->status,
        ];
    }
}
