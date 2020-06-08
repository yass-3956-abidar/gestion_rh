<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Controller
{
    public function sendEmailForEmployer(Request $request)
    {

        $data = array('name' => "Virat Gandhi");

        Mail::send(['text' => 'sendemail'], $data, function ($message) {
            $message->to('abidar.yassin.uca@gmail.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail');
            $message->from('yassinabidar201@gmail.com', 'Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
}
