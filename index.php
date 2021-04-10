<?php

session_start();

require_once('Psychic.php');
require_once('Number.php');

//Задаём кол-во экстрасенсов
$number_of_psychics = 2;

//Создаём объекты экстрасенсов
$psychic = [];

for ($i = 1; $i <= $number_of_psychics; $i++) {
    $psychic[] = new Psychic;
}

$number = new Number;

//Если получили методом GET, генерим числа каждого экстрасенса
//if (isset($_GET['riddle']) || $_SERVER['REQUEST_METHOD'] === 'POST') {
foreach ($psychic as $value) {
    $value->answer_psychic();
    $value->get_level();
//}
}
foreach ($psychic as $value) {
    $value->get_level();
}


//Если методом Post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $number->error === null) {
        $number->recording_number($_POST['number']);
}


var_dump($psychic[1]);

var_dump(count($_SESSION['psychics'][1]) === count($_SESSION['number']));
var_dump(count($_SESSION['psychics'][1]));
var_dump(count($_SESSION['number']));
var_dump($psychic[1]->answer == end($_SESSION['number']));

require_once('page.php');