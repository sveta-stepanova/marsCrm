<?php

namespace App\Services;

class Auth {

	const PBKDF2_ITER_COUNT = 1000; // default for Rfc2898DeriveBytes
	const PBKDF2_SUBKEY_LENGTH = 256 / 8; // 256 bits
	const SALT_SIZE = 128 / 8; // 128 bits

	private function generateRandomSalt(): string {
		return random_bytes(self::SALT_SIZE);
	}

	public function getPasswordSalt(string $hashedPassword): string {
		$hashedPasswordByteString = base64_decode($hashedPassword);
		$expectedHashLength = 1 + self::SALT_SIZE + self::PBKDF2_SUBKEY_LENGTH;
		$actualHashLength = strlen($hashedPasswordByteString);
		$header = substr($hashedPasswordByteString, 0, 1);
		if ($header != "\0") {
			throw new RuntimeException("Incorrect header [ $header ]");
		}
		if ($actualHashLength != $expectedHashLength) {
			throw new RuntimeException(
			"Salted hash is wrong length [ expected = {$expectedHashLength}, actual = {$actualHashLength} ]"
			);
		}
		return substr($hashedPasswordByteString, 1, self::SALT_SIZE);
	}

	/**
	 * Creates a PBKDF2 (AKA Rfc2898) hash from a plaintext password.
	 * @param string $password A plaintext password
	 * @param string|null $salt Optionally specify the hash. This should only be used to verify existin passwords.
	 * @return string The base64 encoded password hash
	 */
	public function hashPassword(string $password, string $salt = null): string {
		$salt = $salt ?? $this->generateRandomSalt();
		$subkey = hash_pbkdf2(
				'sha1', // The SHA1 exploit google discovered is irrevelevant to HMAC_SHA1
				$password, $salt, self::PBKDF2_ITER_COUNT, self::PBKDF2_SUBKEY_LENGTH, true
		);
		return base64_encode("\0" . $salt . $subkey);
	}

	/**
	 * verifies a plaintext password matches its hash.
	 * @param string $hashedPassword must be of the format of HashWithPassword (salt + Hash(salt+input)
	 * @param string $password the plain text version of the password
	 * @return bool true if the password matches false if it does not.
	 */
	public function verifyHashedPassword(string $hashedPassword, string $password): bool {
		try {
			$salt = $this->getPasswordSalt($hashedPassword);
		} catch (RuntimeException $ex) {
			trigger_error($ex->getMessage());
			return false;
		}
		$actualHashedPassword = $this->hashPassword($password, $salt);
		return hash_equals($actualHashedPassword, $hashedPassword);
	}

	public function hashtest($pass, $hashed_pass) {
		$decode_val = base64_decode($hashed_pass);
		$salt = substr($decode_val, 1, 16);
		$key = substr($decode_val, 17, 49);
		$result = $this->pbkdf2("sha1", utf8_encode($pass), $salt, 1000, 32, true);
		return ($key == $result);
	}

	public function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false, $f = false) {
		$algorithm = strtolower($algorithm);
		if (!in_array($algorithm, hash_algos(), true))
			die('PBKDF2 ERROR: Invalid hash algorithm.');
		if ($count <= 0 || $key_length <= 0)
			die('PBKDF2 ERROR: Invalid parameters.');

		$hash_length = strlen(hash($algorithm, "", true));
		$block_count = ceil($key_length / $hash_length);

		$output = "";

		for ($i = 1; $i <= $block_count; $i++) {
			$last = $salt . pack("N", $i);
			$last = $xorsum = hash_hmac($algorithm, $last, $password, true);

			for ($j = 1; $j < $count; $j++) {
				$xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
			}
			$output .= $xorsum;
		}

		if ($f)
			return $output;

		if ($raw_output)
			return substr($output, 0, $key_length);
		else
			return bin2hex(substr($output, 0, $key_length));
	}

}
