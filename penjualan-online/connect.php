<?php

require 'vendor/autoload.php';

use MongoDB\Client;

$config = require 'config/config.php';

// Create a new MongoDB client
$mongoClient = new Client(
    sprintf(
        'mongodb://%s:%s@%s:%d/%s?authSource=%s',
        $config['username'],
        $config['password'],
        $config['host'],
        $config['port'],
        $config['database'],
        $config['authSource']
    )
);

// Pilih database yang sesuai
$database = $mongoClient->selectDatabase($config['database']);
