<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class File
 * @package common\models
 */
class File extends Model
{
    public $file;
    public $name;
    public $path;

    private $formName;

	/**
	 * File constructor.
	 *
	 * @param string $formName Name Form name for upload
	 * example: User[avatar] form name 'User'
	 */
    public function __construct($formName = 'Upload')
    {
        $this->formName = $formName;
    }

	/**
	 * @return array
	 */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10],
        ];
    }

	/**
	 * @return string
	 */
    public function formName()
    {
        return $this->formName;
    }

	/**
	 * @param string $attributes
	 * name attributes in form
	 *
	 * @return bool
	 */
    public function upload($attributes = 'file')
    {
        if (!empty($attributes)) {
            $this->file = UploadedFile::getInstances($this, $attributes);
            return true;
        }
        
        $this->addError('file', \Yii::t('yii', 'File upload failed.'));
        return false;
    }

	/**
	 * @param $nameAlias
	 *
	 * @return bool
	 */
    public function saveFile($nameAlias)
    {
        if (!$this->validate(null, false)) {
            return false;
        }

        try {
            $path = Yii::getAlias("@$nameAlias/");
            if (!is_dir($path)) mkdir($path, 0777, true);

            foreach ($this->file as $file) {
                $extension = '.' . end(explode(".", $file->name));
                $name = Yii::$app->security->generateRandomString(20) . $extension;

                if ($file->saveAs($path . $name)) {
                    if (count($this->file) > 1)
                        $this->name[] = $name;
                    else
                        $this->name = $name;
                } else {
                    throw new Exception('No save file');
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

	/**
	 * @param null $name
	 *
	 * @throws \Exception
	 */
    public function delete($name = null)
    {
		try {
			if ($name) {
				unlink($this->path . DIRECTORY_SEPARATOR . $name);
			} else {
				if (count($name) > 1) {
					foreach ($this->name as $one) {
						unlink($this->path . DIRECTORY_SEPARATOR . $one);
					}
				} else {
					unlink($this->path . DIRECTORY_SEPARATOR . $this->name);
				}
			}
		} catch (\Exception $e) {
			throw $e;
		}
    }
}