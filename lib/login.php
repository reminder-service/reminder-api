<?php

function checkLogin($sqlConnection) {
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        header('WWW-Authenticate: Basic realm="Reminder API"');
        header('HTTP/1.0 401 Unauthorized');
        print('Invalid login');
        exit;
    }

    $result = $sqlConnection->query('SELECT * FROM reminder_user WHERE username = ? AND password = ?', $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

    if (empty($result)) {
        http_response_code(401);
        print('Invalid login');
        exit();
    }

    return;
}