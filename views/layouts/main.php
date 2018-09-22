<?php

/* @var $this \yii\web\View */
/* @var $content string */

    use app\widgets\Alert;
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use app\assets\AppAsset;

    AppAsset::register($this);
    $session = Yii::$app->session;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'List',
                'brandUrl' => ['/site/index'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => ($session->get('account_id', false)) ? ([
                        ['label' => 'Balance', 'url' => ['/site/balance']], ['label' => 'Logout', 'url' => ['/site/logout']]
                    ]) : ([
                        ['label' => 'Login', 'url' => ['/site/login']]
                    ])
            ]);
            NavBar::end();
        ?>
        <div class="container">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
