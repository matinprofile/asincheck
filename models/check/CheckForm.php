<?php

namespace app\models\check;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CheckForm extends Model
{
    public $asin;
    public $useragent;

	public function getASIN(){
		return $asin;
	}
	
	public function getUserAgent(){
		return $useragent;
	}
}
