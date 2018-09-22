<?php

namespace tests\models;

use app\models\Account;
use app\models\BalanceForm;

class TransferTest extends \Codeception\Test\Unit
{
    public function testFrom()
    {
        $sender = Account::findOne(['name' => 'sender']);
        $form = new BalanceForm(array(), $sender);

        $form->receiver = 'receiver';
        $form->amount = 700;
        expect_that($form->validate());

        $form->receiver = 'receiver';
        $form->amount = 1001;
        expect_not($form->validate());

        $form->receiver = 'error';
        $form->amount = 700;
        expect_not($form->validate());
    }

    public function testSend()
    {
        $sender = Account::findOne(['name' => 'sender']);
        $amount = 370;
        $result = $sender->send('receiver', $amount);

        expect_that($result['status']);
        expect_not($result['status']);
    }
}
?>