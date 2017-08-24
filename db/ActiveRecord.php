<?php

namespace gud3\helpers\db;

use Yii;

/**
 * Class ActiveRecord
 * @package common\overrides\db
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    use AdditionalData;
    use ErrorTrait;
    /**
     * @inheritdoc
     */
    public static function find()
    {
        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }
}
