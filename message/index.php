<?php

require_once('../lib/pdo/MySQL.php');
require_once('../lib/settings.php');
require_once('../lib/login.php');
require_once('../lib/sql.php');

function post() {
    if (!isset($_POST['message'])) {
        http_response_code(400);
        print('Missing message');
        return;
    }
    sql()->execute('INSERT INTO reminder_messages (message) VALUES (?)', $_POST['message']);
    http_response_code(201);
}

function get() {
    if (!isset($_GET['identifier'])) {
        getAll();
        return;
    }
    $results = sql()->query('SELECT * FROM reminder_messages WHERE id > (SELECT message_level FROM reminder_clients WHERE client_identifier = ?)', $_GET['identifier']);
    print(json_encode($results));
}

function getAll() {
    $results = sql()->query('SELECT * FROM reminder_messages LIMIT 30');
    print(json_encode($results));
}

function main() {
    checkLogin(sql());

    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method) {
        case 'POST':
            post();
            break;
        case 'GET':
            get();
            break;
        default:
            http_response_code(500);
            print('Unknown request method');
            break;
    }

    sql()->close();
}

main();

