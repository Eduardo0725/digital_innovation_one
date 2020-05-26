<?php

// echo date('d/m/Y') . PHP_EOL;
$data = new DateTime();
// var_dump($data);
// echo $data->format('d-m-Y H:i:s');

/*
-> P representação de periodo: vem antes de dia, mês, ano e semana
Y anos
M meses
D dias
W semanas
-> T representação de tempo: vem antes de hora, minuto e segundo
H horas
M minutos
S segundos
*/

$intervalo = new DateInterval('PT5M'); //Adiciona um periodo de 5 minutos
$data->add($intervalo); //Adiciona
$data->sub($intervalo); //subtrai 

var_dump($data);