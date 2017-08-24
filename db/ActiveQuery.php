<?php

namespace gud3\helpers\db;

/**
 * Class ActiveQuery
 * @package gud3\helpers\db
 */
class ActiveQuery extends \yii\db\ActiveQuery
{
    /**
     * remove condition by name row in where conditions
     * @param $param string
     */
    public function removeCondition($param)
    {
        $this->unsetParam($this->where, $param);
    }

    /**
     * @param array $values
     * @param $param
     * @return bool
     */
    private function unsetParam(array &$values, $param)
    {
        foreach ($values as $k => &$v) {
            if (is_array($v)) {
                if ($this->unsetParam($v, $param)) {
                    unset($values[$k]);
                }
            } else {
                if ($v === $param) {
                    return true;
                }
            }
        }

        return false;
    }
}
