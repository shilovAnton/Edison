<?php

session_start();

require_once('Psychic.php');
require_once('Number.php');

//Задаём кол-во экстрасенсов
$number_of_psychics = 3;

//Создаём объекты экстрасенсов
for ($i = 1; $i <= $number_of_psychics; $i++) {
    $psychic[] = new Psychic;
}

$number = new Number;

// генерим числа каждого экстрасенса
if (isset($_GET['riddle']) || $_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($psychic as $value) {
        $value->answer_psychic();
    }
}

//Если методом Post проверяем, и записываем число проверяемого
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $number->error === null) {
    $number->recording_number($_POST['number']);
}

// устанавливаем level (уровень достоверности экстрасенса)
foreach ($psychic as $value) {
    $value->get_level();
}


require_once('page.php');