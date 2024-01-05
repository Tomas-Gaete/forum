<?php
$database_host = '127.0.0.1'; // The local end of your SSH tunnel
$database_port = '3306';      // The local port of your SSH tunnel
$database_name = 'moodle';
$database_user = 'moodle';
$database_password = 'moodle';

// SSH tunnel parameters
$ssh_host = 'localhost';
$ssh_port = '22';             // SSH port
$ssh_user = 'devel';
$ssh_password = '';

$ssh_connection = ssh2_connect($ssh_host, $ssh_port);
if (ssh2_auth_password($ssh_connection, $ssh_user, $ssh_password)) {
    // Establish the SSH tunnel
    ssh2_tunnel($ssh_connection, $database_host, $database_port);
}

$conn = new mysqli($database_host, $database_user, $database_password, $database_name, $database_port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
