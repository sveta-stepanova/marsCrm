<?php

namespace App\Exceptions;

class AppException extends \Exception {

	public static function couldNotDefineRole() {
		return new self('User was authorized, but role could not be defined');
	}

	public static function signatureCheckNoEmail() {
		return new self('Signature check: email not provided');
	}

	public static function signatureCheckInvalidSignature() {
		return new self('Signature check: invalid signature');
	}

}
