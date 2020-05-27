<?php

include_once "vendor/autoload.php";

use Eduardo\DigitalCep\Search;

$busca = new Search;

$resultado = $busca->getAddressFromZipcode('01001000');

print_r($resultado);

