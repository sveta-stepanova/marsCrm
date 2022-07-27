<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail as MailFacade;

class Mail {
    
    public static function SendResetMail($email, $pass) {
	MailFacade::send('emails.reset', ['Email' => $email, 'Password' => $pass], function($message) use ($email) {
	    $message->to($email)->subject('Восстановление регистрационных данных');
	});
    }
    
    public static function SendResetRegistration($email, $pass) {
	MailFacade::send('emails.registration', ['Email' => $email, 'Password' => $pass], function($message) use ($email) {
	    $message->to($email)->subject('Регистрация на сайте PERFECT FIT');
	});
    }
    
    public static function SendOrderManagerMail($email, $subject, $breeder, $order) {
	MailFacade::send('emails.orderManager', ['breeder' => $breeder, 'order' => $order], function($message) use ($email, $subject) {
	    $message->to($email)->subject($subject);
	});
    }
    
     public static function SendOrderMail($email, $subject, $breeder, $order) {
	MailFacade::send('emails.order', ['breeder' => $breeder, 'order' => $order], function($message) use ($email, $subject) {
	    $message->to($email)->subject($subject);
	});
    }
    
    public static function ResponseNvalidManagerMail($email, $subject, $breeder, $order) {
	MailFacade::send('emails.order', ['breeder' => $breeder, 'order' => $order], function($message) use ($email, $subject) {
	    $message->to($email)->subject($subject);
	});
    }
    
    public static function responseNvalidManagerSend($email, $subject, $response, $breeder, $orderId, $formState) {
	MailFacade::send('emails.responseNvalidManager', ['response' => $response,'breeder' => $breeder, 
                            'orderId' => $orderId, 'formState' => $formState], function($message) use ($email, $subject) {
	    $message->to($email)->subject($subject);
	});
    }
    
    public static function responseNvalidSend($email, $subject, $response, $breeder, $orderId, $formState) {
	MailFacade::send('emails.responseNvalid', ['response' => $response, 'breeder' => $breeder, 
                            'orderId' => $orderId, 'formState' => $formState], function($message) use ($email, $subject) {
	    $message->to($email)->subject($subject);
	});
    }
    
    public static function formNvalidManagerSend($email, $subject, $breeder, $orderId, $formState) {
	MailFacade::send('emails.formNvalidManager', ['breeder' => $breeder, 
                            'orderId' => $orderId, 'formState' => $formState], function($message) use ($email, $subject) {
	    $message->to($email)->subject($subject);
	});
    }
    
    public static function formNvalidSend($email, $subject, $breeder, $orderId, $formState) {
	MailFacade::send('emails.formNvalid', ['breeder' => $breeder, 
                            'orderId' => $orderId, 'formState' => $formState], function($message) use ($email, $subject) {
	    $message->to($email)->subject($subject);
	});
    }
    
    
    
}

