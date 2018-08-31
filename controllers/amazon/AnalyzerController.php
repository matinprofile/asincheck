<?php

namespace app\controllers\amazon;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\amazon\Product;

class AnalyzerController extends Controller
{
	function actionIndex(){
		return "This is Amazon Product Analyzer &lt;APA>.";
	}
	
	function actionAnalyze(){
		$product = new Product();
		if($product->load(Yii::$app->request->post())){
			$product->informations();
		}
		
        return $this->render('analyze-result', [
			'product' => $product,
        ]);
	}
}
