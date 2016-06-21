<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $receiver;
    protected $subject;
    protected $content;
    protected $cc;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($receiver, $subject, $content, $cc=null)
    {
        $this->receiver = $receiver;
        $this->subject = $subject;
        $this->content = $content;
        $this->cc = $cc;
    }

    /**
     * Execute the job.
     *
     * @param  Mailer  $mailer
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $senderEmail    = env('NO_REPLY_EMAIL');
        $senderName     = env('FROM_NAME');
        $sitePath       = URL('');
        $siteName       = env('SITE_NAME');
        $content        = $this->content;
        $subject        = $this->subject;
        $receiver       = $this->receiver;
        $cc             = $this->cc;

        $data = array(
                    'logopath' => public_path('img/logo.png'),
                    'content' => $content,
                    'footer' => ' Copyright '.date('Y'),
                    'sitepath' => $sitePath,
                    'sitename' => $siteName,
                    );

        $mailer->send('emails.email', $data, function ($message) use ($senderEmail, $senderName, $receiver, $subject,$cc) {

            $message->from($senderEmail, $senderName);
            $message->to($receiver);
            if($cc)
                $message->cc($cc);
            $message->subject($subject);

        });
    }
}
