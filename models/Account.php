<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Account extends ActiveRecord
{
    public function send($receiver, $amount)
    {
        $connection = Yii::$app->db;
        $sql1 = 'UPDATE account SET balance = balance + ' . $amount . ' WHERE name = "' . $receiver . '"';
        $sql2 = 'UPDATE account SET balance = balance - ' . $amount . ' WHERE id = ' . $this->id;

        $transaction = $connection->beginTransaction();
        try {
            $connection->createCommand($sql1)->execute();
            $connection->createCommand($sql2)->execute();
            $transaction->commit();
        } catch (\Exception $e) {
            return array('status' => false, 'message' => $e->getMessage());
        }

        $this->balance = $this->balance - $amount;
        return array('status' => true, 'message' => '');
    }
}