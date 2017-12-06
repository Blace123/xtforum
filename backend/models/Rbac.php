<?php
namespace backend\models;

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\base\Model;

class Rbac extends Model
{
    public $power;
    public $role;
    public $user;


}