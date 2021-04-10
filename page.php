<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Тест экстрасенсов</title>
</head>
<body>

<?php
foreach ($psychic as $value) : ?>
    <p>Уровень достоверности экстрасенса <?= $value->id; ?> : <?= $value->level; ?></p>
    <p>История догадок экстрасенса <?= $value->id; ?> :</p>
    <?php
    if ($value->get_history_answer()) : ?>
        <?php
        foreach ($value->get_history_answer() as $v) : ?>
            <?= $v; ?>;
        <?php
        endforeach; ?>
    <?php
    endif; ?>
    <hr>
<?php
endforeach; ?>


<p>История загаданных чисел :</p>
<?php
if ($number->get_history_number()) : ?>
    <?php
    foreach ($number->get_history_number() as $value) : ?>
        <?= $value; ?>;
    <?php
    endforeach; ?>
<?php
endif; ?>
<hr>

<?php
if ((!isset($_GET['riddle'])) and ($number->error === NULL)) : ?>
    <p>Загадайте двузначное число</p>
    <p>
        <a href="index.php?riddle=true">
            <button value="riddle" formmethod="get">Загадал</button>
        </a>
    </p>

<?php
else: ?>

    <?php
    foreach ($psychic as $value) : ?>
        <p>Догадка экстрасенса <?= $value->id; ?> : <?= $value->answer; ?></p>
        <hr>
    <?php
    endforeach; ?>

    <form action="index.php" method="post">
        <label>Введите ваше двузначное число:</label>
        <label>
            <input type="text" name="number" placeholder="Ваше число">
        </label>
        <button type="submit">Отправить</button>
        <?php
        if (!empty($number->error)) : ?>
            <p style="color: red"><?= $number->error; ?></p>
            <?php
            $number->error = null;
            ?>
        <?php
        endif; ?>
    </form>

<?php
endif; ?>

</body>
</html>