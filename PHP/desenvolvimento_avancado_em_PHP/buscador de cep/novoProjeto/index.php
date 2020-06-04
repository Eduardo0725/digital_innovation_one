<?php

include_once "vendor/autoload.php";

use Eduardo0725\DigitalCep\Search;

$busca = new Search();

print_r($busca->getAddressFromZipcode('08223000'));
