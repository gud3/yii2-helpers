<?php

namespace gud3\helpers\db;

/**
 * Trait ErrorTrait
 * @package gud3\helpers\db
 */
trait ErrorTrait {
    /**
     * @return string
     */
    public function getErrorsString()
    {
        if ($this->hasErrors()) {
            return implode(PHP_EOL, $this->getFirstErrors());
        }

        return '';
    }
}