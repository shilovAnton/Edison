<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Тест экстрасенсов</title>
</head>

<body>

<div class="h-100 bg-light.bg-gradient text-dark">

    <?php
    foreach ($psychic as $value) : ?>
        <div class="row justify-content-center p-2 bg-light border">
            <div class="col-0">
                <div class="card mx-auto border border-primary" style="width: 18rem;">
                    <div class="card-header">
                        <h4 class="card-title">Экстрасенс <?= $value->id; ?></h4>
                    </div>
                    <img src="img/Экстрасенс<?= $value->id; ?>.jpg" class="card-img-top" alt="Экстрасенс">
                    <div class="card-body">
                        <h6 class="card-title text-center">Уровень достоверности</h6>
                        <h2 class="card-title text-center"><?= $value->level; ?></h2>
                        <?php
                        if ($value->get_history_answer()) : ?>
                            <h6 class="card-subtitle mb-2 text-muted text-center">История догадок :</h6>
                            <p class="card-body text-muted">
                                <?php
                                foreach ($value->get_history_answer() as $v) : ?>
                                    <?= $v; ?>;
                                <?php
                                endforeach; ?>
                            </p>
                        <?php
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endforeach; ?>

    <div class="alert alert-dark">
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
    </div>
    <?php
    if ((!isset($_GET['riddle'])) and ($number->error === null)) : ?>
        <div class="d-grid gap-1 col-3 mx-auto">
            <p>Загадайте двузначное число</p>
            <a class="btn btn-primary btn-lg" href=index.php?riddle=true" role="button" formmethod="get">Загадал</a>
        </div>
    <?php
    else: ?>

        <?php
        foreach ($psychic as $value) : ?>
            <div class="alert alert-success" role="alert">
                <p>Догадка экстрасенса <?= $value->id; ?> : <?= $value->answer; ?></p>
            </div>
        <?php
        endforeach; ?>

        <form action="index.php" method="post" class="row g-3 mx-auto">

            <div class="col-auto">
                <label for="validationServer05" class="form-label">Введите ваше двузначное число:</label>
            </div>
            <div class="col-auto">
                <input type="text" name="number" class="form-control <?php
                if (!empty($number->error)): ?>is-invalid<?php
                endif; ?>" id="validationServer05"
                       aria-describedby="validationServer05Feedback" required>
                <div id="validationServer05Feedback" class="invalid-feedback">
                    <?php
                    if (!empty($number->error)) : ?>
                        <?= $number->error; ?>
                        <?php
                        $number->error = null;
                        ?>
                    <?php
                    endif; ?>
                </div>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary align-items-center" type="submit">Отправить</button>
            </div>
        </form>
    <?php
    endif; ?>
</div>

</body>
</html>