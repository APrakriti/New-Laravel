<?php
namespace App\Classes;

use Illuminate\Contracts\Mail\Mailer;
use Mail;

class Helper
{
	public static function sendEmail($receiver, $subject, $content, $cc='')
	{
		$senderEmail    = env('NO_REPLY_EMAIL');
        $senderName     = env('FROM_NAME');
        $sitePath       = URL('');
        $siteName       = env('SITE_NAME');
        
        $data = array(
                    'logopath' => public_path('images/logo.png'),
                    'content' => $content,
                    'footer' => ' Copyright '.date('Y'),
                    'sitepath' => $sitePath,
                    'sitename' => $siteName,
                    );

        Mail::send('emails.email', $data, function ($message) use ($senderEmail, $senderName, $receiver, $subject,$cc) {
			$message->from($senderEmail, $senderName);
            $message->to($receiver);
            if($cc)
                $message->cc($cc);
            $message->subject($subject);
        });
	}
}