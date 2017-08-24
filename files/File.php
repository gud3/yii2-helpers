<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\web\UploadedFile;
class File extends Model
{
    public $file;
    public $name;
    public $path;

    private $form_name;

    public function __construct($form_name = 'Upload')
    {
        $this->form_name = $form_name;
    }

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10],
        ];
    }

    public function formName()
    {
        return $this->form_name;
    }

    public function upload($attributes = 'file')
    {
        if (!empty($attributes)) {
            $this->file = UploadedFile::getInstances($this, $attributes);
            return true;
        }
        
        $this->addError('file', \Yii::t('yii', 'File upload failed.'));
        return false;
    }

    public function saveFile($nameAlias = '')
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

            if(!$this->name)
                throw new Exception('No');

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

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