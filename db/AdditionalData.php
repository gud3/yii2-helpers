<?php

namespace common\modules\item\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class AdditionalData
 * @package common\modules\item\models
 */
trait AdditionalData
{
    public $additionalData;

    /**
     * setter additional_data
     * @param $key
     * @param $value
     */
    public function setAdditional($key, $value = null)
    {
        $this->__isset('additional_data');
        
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->additionalData[$k] = strval($v);
            }
        } else {
            $this->additionalData[$key] = strval($value);
        }

        $data = $this->additionalData;
        if ($this->additional_data) {
            if ($this->isJSON($this->additional_data)) {
                $data = ArrayHelper::merge(Json::decode($this->additional_data), $data);
            }
        }

        $this->additional_data = Json::encode($data);
    }

    /**
     * getter additional_data
     * @param $key
     * @return mixed
     */
    public function getAdditional($key)
    {
        $this->__isset('additional_data');

        if (!empty($this->additionalData)) {
            if (array_key_exists($key, $this->additionalData)) {
                return $this->additionalData[$key];
            }
        } else {
            if ($this->additional_data) {
                $this->additionalData = Json::decode($this->additional_data);
                return $this->getAdditional($key);
            }
        }

        return null;
    }

    /**
     * function delete item in object
     * @param $key
     * @return null
     */
    public function deleteAdditional($key)
    {
        $this->__isset('additional_data');

        if (!empty($this->additionalData)) {
            unset($this->additionalData[$key]);
        } else {
            if ($this->additional_data) {
                $this->additionalData = Json::decode($this->additional_data);
                $this->deleteAdditional($key);
            }
        }
    }

    /**
     * @param $insert
     *
     * @return mixed
     */
    public function beforeSave($insert)
    {
        if ($this->additionalData) {
            $this->additional_data = Json::encode($this->additionalData);
        }

        return parent::beforeSave($insert);
    }

    /**
     * @param $string
     * @return bool
     */
    private function isJSON($string)
    {
        if (is_string($string)) {
            if (is_array(json_decode($string, true))) {
                if (json_last_error() == JSON_ERROR_NONE) {
                    return true;
                }
            }
        }

        return false;
    }
}
