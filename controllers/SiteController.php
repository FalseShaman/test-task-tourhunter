<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\models\Account;
use app\models\AuthForm;
use app\models\BalanceForm;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $accountList = Account::find()->all();
        return $this->render('list', ['accountList' => $accountList]);
    }

    public function actionLogin()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        if ($session->get('account_id', false)) {
            return $this->redirect(Url::to(['site/balance']));
        }

        $form = new AuthForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $loginAccount = Account::findOne(['name' => $form->name]);
            if (!$loginAccount) {
                $account = new Account();
                $account->name = $form->name;
                $account->save();
                $loginAccount = Account::findOne(['name' => $form->name]);
            }
            $session->set('account_id', $loginAccount->id);
            return $this->redirect(Url::to(['site/balance']));
        }
        return $this->render('login', ['model' => $form]);
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $session->remove('account_id');
        }
        return $this->redirect(Url::to(['site/index']));
    }

    public function actionBalance()
    {
        $session = Yii::$app->session;
        if (!$session->get('account_id', false)) {
            return $this->redirect(Url::to(['site/login']));
        }

        $account = Account::findOne($session->get('account_id'));
        $form = new BalanceForm(array(), $account);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $send = $account->send($form->receiver, $form->amount);
            if (!$send['status']) {
                $form->addError('amount', $send['message']);
            }
            if (!$form->hasErrors()) {
                $form->receiver = null;
                $form->amount = null;
                Yii::$app->session->setFlash('flashMsg', 'Success!');
            }
        }
        return $this->render('balance', ['model' => $form]);
    }
}
