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

<div class="h-100 p-3 mb-6 bg-light.bg-gradient text-dark">

    <?php
    foreach ($psychic as $value) : ?>
        <div class="row">
            <div class="col-sm-6" >
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h4 class="card-title">Экстрасенс <?= $value->id; ?></h4>
                    </div>
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">Уровень достоверности :</h6>
                        <h2 class="card-title"><?= $value->level; ?></h2>
                        <h6 class="card-subtitle mb-2 text-muted">История догадок :</h6>
                        <p class="card-body">
                            <?php
                            foreach ($value->get_history_answer() as $v) : ?>
                                <?= $v; ?>;
                            <?php
                            endforeach; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
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
    if ((!isset($_GET['riddle'])) and ($number->error === null)) : ?>
        <div class="d-grid gap-1 col-3 mx-auto">
            <p>Загадайте двузначное число</p>
            <a class="btn btn-primary btn-lg" href=index.php?riddle=true" role="button" formmethod="get">Загадал</a>
        </div>
    <?php
    else: ?>

        <?php
        foreach ($psychic as $value) : ?>
            <p>Догадка экстрасенса <?= $value->id; ?> : <?= $value->answer; ?></p>
            <hr>
        <?php
        endforeach; ?>

            <form action="index.php" method="post" class="d-grid gap-12 col-5 mx-auto">
                <div class="col-md-3">
                    <label for="validationServer05" class="form-label">Введите ваше двузначное число:</label>
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
                <div class="d-grid gap-12 col-5 mx-auto">
                    <button class="btn btn-primary btn-sm" type="submit">Отправить</button>
                </div>
            </form>


    <?php
    endif; ?>
</div>

</body>
</html>