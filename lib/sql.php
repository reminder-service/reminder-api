<?php

$sqlConnection = null;
function sql() {
    global $sqlConnection;
    global $settings;

    if ($sqlConnection === null) {
        $sqlConnection = MySQL::build($settings['db_username'], $settings['db_password'], $settings['db_name']);
    }

    return $sqlConnection;
}