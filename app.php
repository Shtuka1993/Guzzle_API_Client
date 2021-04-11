<?php
    require 'enviroument.php';
    require 'vendor/autoload.php';
    include('AppClient.php');

    $client = new AppClient();

    $data = $client->getRequest();

    var_dump($data);
    foreach($data as $item) {
        echo "<img src='".$item->url."'>";
    }