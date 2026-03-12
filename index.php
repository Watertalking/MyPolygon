<?php

function greetUser($name = 'гость'): string
{
    return "Привет, $name!";
}

function validateEmail($email): string
{
    if (strlen($email) < 5) {
        return false;
    }
    $pattern = '/^[^@]+@[^@]+\.[^@]+$/';
    return preg_match($pattern, $email) === 1;
}

function formatUserData($name, $email): array
{
    $formatName = mb_convert_case($name, MB_CASE_TITLE, 'UTF-8');
    $formatEmail = strtolower($email);
    return [
      'formatted_name' => $formatName,
      'formatted_email' => $formatEmail
    ];
}

