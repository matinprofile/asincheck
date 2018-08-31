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
			$asin = Yii::$app->request->post('CheckForm')['asin'];
			$useragent = Yii::$app->request->post('CheckForm')['useragent'];
			
			$uri = 'http://app.amzrank.net/de/api/get_asin?apikey=3bKaWgUxUiryCcGWCaUapARg&rankings=true&asin=' . $asin;
			$ch = curl_init($uri);
			curl_setopt_array($ch, array(
				CURLOPT_HTTPHEADER  => array('Authorization: ' . rand()),
				CURLOPT_RETURNTRANSFER  =>true,
				CURLOPT_VERBOSE     => 1
			));
			$out = curl_exec($ch);
			curl_close($ch);
     
			$uri = 'https://www.amazon.com/dp/' . $asin;
			$ch2 = curl_init($uri);
			curl_setopt_array($ch2, array(
				CURLOPT_HTTPHEADER  => array('Authorization: ' . rand()),
				CURLOPT_RETURNTRANSFER  =>true,
				CURLOPT_VERBOSE     => 1,
				CURLOPT_SSL_VERIFYPEER => 0,
				CURLOPT_FAILONERROR => 1,
				CURLOPT_COOKIESESSION => 1,
				CURLOPT_FOLLOWLOCATION => 1,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_USERAGENT =>  $useragent, //'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3',
				CURLOPT_CONNECTTIMEOUT => 120,
				CURLOPT_TIMEOUT => 120
			));
				
			$html = curl_exec($ch2);  // Executing cURL session					
			curl_close($ch2);    // Closing cURL session
/*		 
			$uri = 'https://www.amazon.com/dp/' . $asin;
			
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $uri);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_POST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
			$html = curl_exec($ch);
			*/
			$myfile = fopen("outhtml.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $html);
			fclose($myfile);	
			return $this->render('check-form', [
				'model' => $model, 'asin' => $out, 'html' => $html,
			]);
            //return $this->refresh();
        }
		
		
        return $this->render('check-form', [
			'model' => $model, 'asin' => $out, 'html' => $html,
        ]);
    }
	
	private function parse($html, $selector){
		//$html = strtolower($hmtl);
		//$selector = strtolower($selector);
		$start_pos = strpos($html,$selector);
		$end_pos = strpos($html,"</", $start_pos);
		return ">>" . substr($html, $start_pos, $start_pos - $end_pos);
	}

	public function actionHtmlParse(){
		$myfile = fopen("outhtml.txt", "r") or die("Unable to open file!");
		$html = fread($myfile,filesize("outhtml.txt"));
		fclose($myfile);	
		//$html = $this->parse($html,"acrCustomerReviewText");
		return $this->render('html', [
			'html' => $html, 
		]);
	}

		public function actionSave(){
			$myfile = fopen("outhtml.txt", "w") or die("Unable to open file!");
			fwrite($myfile,"test");
			fclose($myfile);	
			return "saveed";
		}
}
