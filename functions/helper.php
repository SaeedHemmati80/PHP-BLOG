<?php

// config
const BASE_URL = 'http://localhost/php-blog';

function redirect($url)
{
    header('location: ' . trim(BASE_URL, '/ ') . '/' . trim($url, '/ '));
    exit;
}

function asset($file)
{
    return trim(BASE_URL, '/ ') . '/' . trim($file, '/ ');
}


function url($url)
{
    return trim(BASE_URL, '/ ') . '/' . trim($url, '/ ');
}

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    exit;
}

