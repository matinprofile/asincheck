<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\check\CheckForm;

class CheckController extends Controller
{


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

	
    /**
     * Displays Form page.
     *
     * @return Response|string
     */
    public function actionForm()
    {
        $model = new CheckForm();
		$asin = "B00005N5PF";
        if ($model->load(Yii::$app->request->post()) /*&& $model->contact(Yii::$app->params['adminEmail'])*/) {
			/*
            Yii::$app->session->setFlash('contactFormSubmitted');
			*/
			$uri = 'http://app.amzrank.net/de/api/get_asin?apikey=3bKaWgUxUiryCcGWCaUapARg&rankings=true&asin=' . Yii::$app->request->post('CheckForm')['asin'];
			$ch = curl_init($uri);
			curl_setopt_array($ch, array(
				CURLOPT_HTTPHEADER  => array('Authorization: 123456'),
				CURLOPT_RETURNTRANSFER  =>true,
				CURLOPT_VERBOSE     => 1
			));
			$out = curl_exec($ch);
			curl_close($ch);
			return $this->render('check-form', [
				'model' => $model, 'asin' => $out,
			]);
			
            //return $this->refresh();
        }
        return $this->render('check-form', [
            'model' => $model, 'asin' => $asin,
        ]);
    }
	
}
