<?php
$response = [
    ['message' => 'order successfully booked'],
    ['error' => 'barcode already exists']
];
$result = $response[array_rand($response)];
echo json_encode($result);
