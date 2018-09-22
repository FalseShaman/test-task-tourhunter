<?php

/* @var $this yii\web\View */
/* @var $accountList app\models\Account */

    use yii\helpers\Html;

    $this->title = 'Account list';
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">
        <?php foreach ($accountList as $account): ?>
            <div class="col-md-6">
                <p><?= $account->name; ?></p>
            </div>
            <div class="col-md-6">
                <p><?= $account->balance; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
