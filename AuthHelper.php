<?php
class AuthHelper {
    public static function validatePassword(string $inputPassword, string $hashedPassword): bool {
        return password_verify($inputPassword, $hashedPassword);
    }

    public static function setSecureCookie(string $name, string $value, int $expiry = 3600): void {
        setcookie(
            $name,
            $value,
            [
                'expires' => time() + $expiry,
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict'
            ]
        );
    }

    public static function generateHash(string $data): string {
        return hash('sha256', $data);
    }
}