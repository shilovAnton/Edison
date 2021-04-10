<?php


class Number

{
    public $number;

    public $error;

    //запись и валидация загаданного числа
    public function recording_number($number)
    {
            $filter_number = filter_var(
                $number,
                FILTER_VALIDATE_INT,
                ["options" => ["min_range" => 10, "max_range" => 99]]
            );
            //если прошла проверка записываем число, если нет формируем ошибку
            if ($filter_number) {
                $this->number = $number;
                return $_SESSION['number'][array_key_last($_SESSION['psychics'][1])] = $number;
            } else return $this->error = 'Введите двузначное число';
    }

    //возвращает историю ответов экстрасенса
    public function get_history_number()
    {
        return $_SESSION['number'] ? $_SESSION['number'] : false;
    }
}