<?php


namespace Modules\SmsSupport\Notifications\Api\V1\Channels;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Notifications\Notification;
use Modules\SmsSupport\Entities\Message;

class Sms20Channel
{

    public function send($notifiable, Notification $notification)
    {

        if (!method_exists($notification, 'toSms20Channel')) {
            throw new \Exception('toSms20Channel not found');
        }

        $data = $notification->toSms20Channel($notifiable);

        $sender_number = $data['sender_number'];
        $receiver_number = $data['receiver_number'];

        $apiUserName = config('services.sms20-ir.username');
        $apiUserPass = config('services.sms20-ir.password');
        $Message = config('services.sms20-ir.message');
        $url = "http://sms20.ir/send_via_get/send_sms.php?username=$apiUserName&password=$apiUserPass&sender_number=$sender_number&receiver_number=$receiver_number&note=$Message";
        try {
            $client = new Client();
            $request = new Request('GET', $url);
            $res = $client->sendAsync($request)->wait();
            echo $res->getBody() . "  SuccessFuly";

            Message::create([
                'mobile_number' => $receiver_number,
                'sms_number'  => $sender_number,
                'status'   => 'OK'
            ]);
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
