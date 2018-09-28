<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">				
			<!-- MENU ITEM -->
			<ul>
				<li><a href="uploads/guide/end_user_documentation.htm" target="guide" >User Guide</a></li>
				<li><a href="uploads/guide/programmer_documentation.htm" target="guide" >Developer Guide</a></li>
			</ul>
			<!-- /MENU ITEM -->
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9" >			
			<iframe name="guide" src="uploads/guide/end_user_documentation.htm" style="width:100%;height:600px;" ></iframe>
		</div>

</div>
