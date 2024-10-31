<?php

require 'Db.php';

$db = new DB;

function addOrder(
    $event_id,
    $event_date,
    $ticket_adult_price,
    $ticket_adult_quantity,
    $ticket_kid_price,
    $ticket_kid_quantity,
    $user_id
) {
    global $db;
    $pars = [
        'event_id' => $event_id,
        'event_date' => $event_date,
        'ticket_adult_price' => $ticket_adult_price,
        'ticket_adult_quantity' => $ticket_adult_quantity,
        'ticket_kid_price' => $ticket_kid_price,
        'ticket_kid_quantity' => $ticket_kid_quantity,
    ];
    $barcode_exists = true;
    while ($barcode_exists) {
        $barcode = getNewBarcode();
        $barcode_exists = $db->barcodeExistsInDb($barcode);
        if (!$barcode_exists) {
            $pars['barcode'] = $barcode;
            $result = fetchPost('http://localhost/book.php', $pars);
            if ($result['message'])
                $barcode_exists = false;
            else $barcode_exists = true;
        }
    }
    $result = fetchPost('http://localhost/aprove.php', ['barcode' => $barcode]);
    if ($result['message']) {
        $pars['user_id'] = $user_id;
        $pars['equal_price'] = $ticket_adult_price * $ticket_adult_quantity + $ticket_kid_price * $ticket_kid_quantity;
        $pars['created'] = date("Y-m-d H:i:s");
        if ($db->insertOrder($pars))
            return true;
    }
    return false;
}

function getNewBarcode()
{
    $chars = '01234567890123456789012345678901234567890123456789012345678901234567890123456789';
    return substr(str_shuffle($chars), 0, 16);
}

function fetchPost($url, $params)
{
    $result = file_get_contents($url, false, stream_context_create(array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($params)
        )
    )));
    if ($result) return json_decode($result, true);
}
addOrder(25, '2024-11-29', 800, 2, 300, 2, 20);
