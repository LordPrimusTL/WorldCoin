<?php

namespace App\Worker
{

    use App\btc_link;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Mail;

    class EmailWorks
    {
        public function SendRegMail($data)
        {
            var_dump(1);
            Mail::send('Email.register', $data, function($message)
            {
                var_dump(1);
                $message->to('michealakinwonmi@gmail.com')
                    ->subject('Hi there!  Laravel sent me!');
                var_dump(1);
            });

            try{
                Mail::send('Email.register', $data, function($message) {
                    $message->to('michealakinwonmi@gmail.com')
                        ->subject('Activate Your Ponzi Account');
                });

                return true;
            }
            catch(\Exception $e)
            {
                Log::error('Error Occured While Sending Mail: ' . $data);
                return false;
            }
        }

        public static function BTCRegMail($data)
        {
            $link = btc_link::where(['Used' => false])->first();
            try{
                Mail::send('Email.register',['data' => $data, 'link' => $link], function($message) use($data){
                    $message->to($data['email'])
                        ->subject('Activate Your MySite Account');
                });


                return true;
            }
            catch(\Exception $e)
            {
                Log::error('Error Occured While Sending Mail:');
                return false;
            }
        }
    }
}
