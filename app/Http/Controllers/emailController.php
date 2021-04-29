<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AutoMail;

class emailController extends Controller
{
    public function sendEmail() {

        $to_email = "tuan.daoanh@vti.com.vn";

        Mail::to($to_email)->send(new AutoMail);

        if(Mail::failures()) {
            
            return "<p> Success! Your E-mail has been sent.</p>";
        }

        else {
            return "<p> Failed! Your E-mail has not sent.</p>"; 
        }
    }
}
