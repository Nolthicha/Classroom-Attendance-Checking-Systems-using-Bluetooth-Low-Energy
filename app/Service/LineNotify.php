<?php

namespace App\Service;

use KS\Line\LineNotify as LineNoti;

class LineNotify
{
    private $token = "vDjwSXY3z3earZSOEQats6SIYaq0X1wgj82M2pP4rl1";

    public function notify($message = '')
    {
       // return (new LineNoti($this->token))
        //    ->send($message);

    }
}