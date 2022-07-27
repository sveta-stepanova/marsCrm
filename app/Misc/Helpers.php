<?php

function clearPhone($phone) {
	if (strlen($phone) == 10 && is_numeric($phone)) {
		return $phone;
	}
	$phone = preg_replace('#[^0-9a-zа-я]#iu', '', $phone);
	$phone = preg_split('#[^0-9]#', $phone);
	$phone = array_filter($phone);
	if (!$phone) {
		return null;
	}
	$phone = $phone[array_keys($phone)[0]];
	if (strlen($phone) == 10) {
		return $phone;
	}
	if (strlen($phone) == 11 && ($phone[0] == '8' || $phone[0] == '7')) {
		return substr($phone, 1);
	}
	if (strlen($phone) == 12 && substr($phone, 0, 2) == '98') {
		return substr($phone, 2);
	}
	return null;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
