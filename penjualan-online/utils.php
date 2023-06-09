<?php

require 'vendor/autoload.php';

use MongoDB\BSON\ObjectId;

function generateObjectId()
{
    return new ObjectId();
}

function objectIdToString($objectId)
{
    return (string) $objectId;
}

function stringToObjectID($id)
{
    try {
        return new ObjectID($id);
    } catch (Exception $e) {
        return null;
    }
}

function now()
{
    return round(microtime(true) * 1000);
}

function epochToHumanDate($epochTime)
{
    $timezone = new DateTimeZone('Asia/Jakarta');
    $datetime = DateTime::createFromFormat('U.u', $epochTime / 1000);
    $datetime->setTimezone($timezone);
    return $datetime->format('Y-m-d H:i:s');
}
