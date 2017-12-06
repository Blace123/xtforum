<?php
namespace yii\behaviors;

use Closure;
use yii\base\AttributeBehavior;
use yii\base\Event;
use yii\db\ActiveRecord;

class PrimaryKeyBehavior extends AttributeBehavior
{
    public $primaryKeyAttribute = 'id';

    public $value;

    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->primaryKeyAttribute],
            ];
        }
    }

    protected function getValue($event)
    {
        return new Expression('UUID()');
    }

}