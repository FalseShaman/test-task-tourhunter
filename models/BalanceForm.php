<?php

namespace app\models;

use yii\base\Model;
use app\models\Account;

class BalanceForm extends Model
{
    public $sender;
    public $amount;
    public $receiver;

    public function __construct(array $config = [], $sender)
    {
        $this->sender = $sender;
        parent::__construct($config);
    }

    public function rules()
    {
        $maxAmount = 1000 + $this->sender->balance;
        return [
            [['amount', 'receiver'], 'required'],
            [['amount'], 'number', 'min' => 0, 'max' => $maxAmount],
            [['receiver'], 'string'],
            [['amount'], 'validateAmount'],
            [['receiver'], 'validateReceiver']
        ];
    }

    public function validateAmount()
    {
        $newBalance = $this->sender->balance - $this->amount;
        if ($newBalance < -1000) {
            $this->addError('amount', 'Insufficient funds');
        }
    }

    public function validateReceiver()
    {
        $receiver = Account::findOne(['name' => $this->receiver]);
        if (!$receiver) {
            $this->addError('receiver', 'Account not found');
        }
    }
}
