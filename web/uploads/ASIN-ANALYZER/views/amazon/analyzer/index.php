<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */

$this->title = 'APA Application';

?>
<div class="site-index">
    <div class="jumbotron">
        <h3>ASIN Analyzer</h3>		
        <?php $form = ActiveForm::begin(['id' => 'analyzer-form', 'action' => 'index.php?r=amazon/analyzer/analyze']); ?>
            <?= $form->field($model, 'asin')->textInput()->hint('Please input your ASIN (Exactly 10 chars, a-z,A-z,0-9)') ?>
            <?= $form->field($model, 'domain')->dropdownList(['de' => '.de', 'com' => '.com']); ?>
			<div class="form-group">
				<?= Html::submitButton('Analyze', ['class' => 'btn btn-primary', 'name' => 'analyze-button']) ?>
			</div>
        <?php ActiveForm::end(); ?>		
    </div>
</div>
