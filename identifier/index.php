<?php

require_once('../lib/pdo/MySQL.php');
require_once('../lib/settings.php');
require_once('../lib/login.php');
require_once('../lib/sql.php');

function post() {
    if (!isset($_POST['identifier'])) {
        http_response_code(400);
        print('Missing identifier');
        return;
    }

    if (!empty(sql()->query('SELECT * FROM reminder_clients WHERE client_identifier = ?', $_POST['identifier']))) {
        http_response_code(409);
        print('Identifier already exists');
        return;
    }

    sql()->execute('INSERT INTO reminder_clients VALUES (?, (SELECT MAX(id) FROM reminder_messages))', $_POST['identifier']);
    http_response_code(201);
}

function get() {
    if (!isset($_GET['identifier'])) {
        getAll();
        return;
    }

    $results = sql()->query('SELECT * FROM reminder_clients WHERE client_identifier = ?', $_GET['identifier']);
    print(json_encode($results));
}

function patch() {
    if (!isset($_GET['identifier'])) {
        http_response_code(400);
        print('Missing identifier');
        return;
    }

    sql()->execute('UPDATE reminder_clients SET message_level = (SELECT MAX(id) FROM reminder_messages) WHERE client_identifier = ?', $_GET['identifier']);
    http_response_code(201);
}

function getAll() {
    $results = sql()->query('SELECT * FROM reminder_clients');
    print(json_encode($results));
}

function main() {
    checkLogin(sql());

    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method) {
        case 'PATCH':
            patch();
            break;
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