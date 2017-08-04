<?php

namespace gud3\helpers\response;

use Yii;
use yii\base\Object;

/**
 * Class Json
 * @package gud3\helpers\response
 */
class Response extends Object
{
    const TYPE_JSON = 'json';

    public $type;
    public $except;

    /**
     * @param $owner
     */
    public function attach($owner)
    {
        foreach ($this->except as $except) {
            if ($except == $owner->action->id) {
                if ($this->type === static::TYPE_JSON) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                }
            }
        }
    }
}