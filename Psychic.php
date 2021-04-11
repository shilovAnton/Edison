<?php


class Psychic {

    public $id;

    public $answer;

    public $level;

    private static $counter = 0;

    public function __construct() {
        $this->id = ++self::$counter;
    }

    //создаёт догадку и помещает её в сессию, не перезаписывая при перезагрузке
    public function answer_psychic() {
        if (!isset($_SESSION['psychics'][$this->id]) && !isset($_SESSION['number'])) {
            $answer = random_int(10, 99);
            $this->answer = $answer;
            return $_SESSION['psychics'][$this->id][] = $answer;
        }
        if (isset($_SESSION['psychics'][$this->id]) && !isset($_SESSION['number'])) {
            return $this->answer = $_SESSION['psychics'][$this->id][$this->get_last_record_id()];
        }
        if (isset($_SESSION['psychics'][$this->id]) && isset($_SESSION['number'])) {
            if ($this->get_last_record_id() === $this->get_last_number_id()) {
                $answer = random_int(10, 99);
                $this->answer = $answer;
                return $_SESSION['psychics'][$this->id][] = $answer;
            } else return $this->answer = $_SESSION['psychics'][$this->id][$this->get_last_record_id()];
        }
        return false;
    }

    //возвращает id последнего числа проверяющего.
    private function get_last_number_id() {
        return array_key_last($_SESSION['number']);
    }

    //возвращает id последней сделанной экстрасенсом догадки.
    private function get_last_record_id() {
        return array_key_last($_SESSION['psychics'][$this->id]);
    }

    //возвращает историю ответов экстрасенса
    public function get_history_answer() {
            return $_SESSION['psychics'][$this->id] ? $_SESSION['psychics'][$this->id] : false;
    }

    // Расчитывает уровень экстрасенса.
    public function get_level()
    {
        if (!isset($_SESSION['level'][$this->id])) {
            return $this->level = $_SESSION['level'][$this->id] = 0;
        }
        if (isset($_SESSION['psychics'][$this->id]) && isset($_SESSION['number'])) {
            if (count($_SESSION['psychics'][$this->id]) == count($_SESSION['number'])) {
                if ($this->answer == end($_SESSION['number'])) {
                    return $this->level = ++$_SESSION['level'][$this->id];
                }
                return $this->level = --$_SESSION['level'][$this->id];
            }
        }
        return $this->level = $_SESSION['level'][$this->id];
    }

    public function get_img()
    {
        if (file_exists('img/Экстрасенс' . $this->id . '.jpg')) {
            return 'img/Экстрасенс' . $this->id . '.jpg';
        }
        return 'img/Экстрасенс' . random_int(1, 5) . '.jpg';
    }
}