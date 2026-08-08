<?php

$publicPath = dirname(__DIR__).'/public';

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '',
);

// Let PHP's development server serve existing public assets directly.
if ($uri !== '/' && file_exists($publicPath.$uri)) {
    return false;
}

require_once $publicPath.'/index.php';
