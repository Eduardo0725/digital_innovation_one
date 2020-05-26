<?php

$data = new DateTime('', new DateTimeZone('America/Sao_Paulo'));
echo 'Data Atual: ' . $data->format('d/m/Y H:i:s');

echo PHP_EOL;

$intervalo = new DateInterval('P5DT10H50M');

$data->sub($intervalo);

$data = $data->format('d/m/Y H:i:s');

echo 'Data de 5 dias, 10 Horas e 50 Minutos Atrás: ' . $data;