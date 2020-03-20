<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\LineNotify;

class LineNotifyController extends Controller
{
    public function pushNotify()
    {
        
        $send = app(LineNotify::class)->notify('test message from controller ทดสอบ');
        return ['send_status' => $send];
    }
}