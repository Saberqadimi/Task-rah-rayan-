<?php

namespace Modules\SmsSupport\Http\Controllers\Api\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Exception;
use Illuminate\Support\Facades\Notification;
use Modules\SmsSupport\Notifications\Api\V1\DetailSingleSmsNotification;
use Illuminate\Support\Facades\Http;
use Modules\SmsSupport\Entities\Message;

class SmsController extends Controller
{
    protected $sender_number;
    public function __construct()
    {
        $this->sender_number = env('SMS20_SENDER_NUMBER');
    }

    public function index()
    {
        $sms_history = Message::latest()->paginate(20);
        return response()->json([
            'data' => $sms_history,
            'status' => 200
        ]);
    }
    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);
        $receiver_number = $validator['receiver_number'];
        if (!$validator) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => 'error'
            ], 422);
        } else {
            Notification::send($receiver_number, new DetailSingleSmsNotification($this->sender_number, $receiver_number));
        }
    }



    public function validateRequest($request)
    {
        return $request->validate([
            'receiver_number' => 'required|max:11',

        ]);
    }
}
