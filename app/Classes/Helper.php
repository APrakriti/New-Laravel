<?php
namespace App\Classes;

use Illuminate\Contracts\Mail\Mailer;
use App\UserType;
use App\Setting;
use Mail;

class Helper
{

      public static function getMainMenu($items = 3)
     {
        return UserType::where('is_active', '1')->take($items)->get();
    }
     

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

     public function content($slug)
    {
        
     return $content = Content::where('slug', $slug)
                    ->where('is_active',1)->first();
    }
    public static function settings(){

    $settings = Setting::pluck('value', 'slug')->toArray();
    return Setting::pluck('value','slug');
}}