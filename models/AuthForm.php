<?php

namespace app\models;

use yii\base\Model;

class AuthForm extends Model
{
    public $name;

    public function rules()
    {
        return [
            [['name'], 'required']
        ];
    }
}
