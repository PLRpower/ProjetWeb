<?php

function validate_input($data, $type)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data, ENT_NOQUOTES, 'UTF-8');

    return match ($type) {
        'email' => filter_var($data, FILTER_VALIDATE_EMAIL),
        'url' => filter_var($data, FILTER_VALIDATE_URL),
        'int' => filter_var($data, FILTER_VALIDATE_INT),
        'float' => filter_var($data, FILTER_VALIDATE_FLOAT),
        default => $data,
    };
}
