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
    <div class="row row-cols-1 row-cols-lg-3 g-20 g-lg-20 mt-3 my-3 g-0">
        <?php
        foreach ($psychic as $value) : ?>

            <div class="col">
                <div class="card mx-auto border border-primary mt-3 my-3" style="width: 18rem;">
                    <div class="card-header">
                        <h4 class="card-title">Экстрасенс <?= $value->id; ?></h4>
                    </div>
                    <img src="<?= $value->get_img(); ?>" class="card-img-top" alt="Изображение аватара экстрасенса">
                    <div class="card-body">
                        <h6 class="card-title text-center">Уровень достоверности</h6>
                        <h2 class="card-title text-center"><?= $value->get_level(); ?></h2>
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
        <?php
        endforeach; ?>
    </div>
</div>
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
                <label for="validationServer05" class="form-label my-0">Введите ваше двузначное число:</label>
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
<div class="alert alert-dark mt-3 my-0" role="alert"></div>

</body>
</html>