<?php
include 'vendor/autoload.php';

use App\HTTPClient;
use GuzzleHttp\Client;

$client = new HTTPClient(new Client(['base_uri' => 'http://127.0.0.1:8000/api/v1/']));

//Login
$jwt = $client->fetchJSON('login','POST', [
    'json' => [ "email" => "admin@email.com", "password" => "password"]
]);
$jwt_token = $jwt->access_token;

//Get projects
$projects = $client->fetchJSON('projects', 'GET', [], ['Authorization' => "Bearer $jwt_token"]);

print_r($projects);



