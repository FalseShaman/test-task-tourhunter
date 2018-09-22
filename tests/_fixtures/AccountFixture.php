<?php
namespace tests\_fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = '@app/models/Account';
    public $dataFile = [
        [
            'name' => 'sender',
            'balance' => 0,
        ],
        [
            'name' => 'receiver',
            'balance' => 0,
        ]
    ];
}
?>