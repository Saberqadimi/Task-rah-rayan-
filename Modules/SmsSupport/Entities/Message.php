<?php

namespace Modules\SmsSupport\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['mobile_number' , 'sms_number' , 'status'];


}
