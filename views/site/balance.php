<?php

/* @var $this yii\web\View */
/* @var $error error text */
/* @var $account app\models\Account */

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use yii\jui\AutoComplete;
    use app\models\Account;

    $this->title = 'Balance';
    $session = Yii::$app->session;
    $list = Account::find()->select(['name as value'])->where('id != '.$model->sender->id)->asArray()->all();
?>

<div class="site-about">
    <h4>Current balance: <?= $model->sender->balance; ?></h4>
    <?php $form = ActiveForm::begin([
        'id' => 'balance-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <?= $form->field($model, 'amount')->textInput() ?>
        <?= $form->field($model, 'receiver')->widget(
            AutoComplete::className(), [
                'clientOptions' => [
                    'source' => $list,
                ],
                'options'=>[
                    'class'=>'form-control'
                ]
            ]);
        ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'balance-button']) ?>
            </div>
        </div>
        <?php if ($session->hasFlash('flashMsg')): ?>
            <div class="alert alert-success col-lg-offset-1 col-lg-11">
                <?= $session->getFlash('flashMsg'); ?>
            </div>
        <?php endif; ?>
    <?php ActiveForm::end(); ?>
</div>
