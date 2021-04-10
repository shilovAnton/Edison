<?php
class Psychic {
    private static $counter = 0;

    private $id;

    public function __construct() {
        $this->id = ++self::$counter;
    }

    public function get_guess() {
        return $_SESSION['psychics'][$this->id][]['guess'] = random_int(10, 99);
    }

    public function report_answer($answer) {
        $_SESSION['psychics'][$this->id][$this->get_last_record_id()]['answer'] = $answer;
    }

    public function get_level() {
        foreach ($_SESSION['psychics'][$this->id] as $results) {
            $level = 0;
            if (isset($results['guess']) && isset($results['answer'])) {
                if ($results['guess'] === $results['answer']) {
                    $level++;
                } else {
                    $level--;
                }
            }
        }

        return $level;
    }

    private function get_last_record_id() {
        return array_key_last($_SESSION['psychics'][$this->id]);
    }
}

?>

<pre><?= var_dump($_SESSION); ?></pre>

