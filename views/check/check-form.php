<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>

<div class="row">
	<div class="col-lg-6">

		<?php $form = ActiveForm::begin(['id' => 'check-form']); ?>


			<div class="form-group">
				<?= $form->field($model, 'asin')->textInput(['autofocus' => true]) ?>
				<?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'check-button']) ?>
			</div>

		<?php ActiveForm::end(); ?>

	</div>
	<div class="col-lg-6" >
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">				
		<!-- PRICE ITEM -->
		<div class="panel price panel-red">
			<div class="panel-heading  text-center">
			<h3>PRO PLAN</h3>
			</div>
			<div class="panel-body text-center">
				<p class="lead" style="font-size:40px"><strong>$10 / month</strong></p>
			</div>
			<ul class="list-group list-group-flush text-center">
				<li class="list-group-item"><i class="icon-ok text-danger"></i> Personal use</li>
				<li class="list-group-item"><i class="icon-ok text-danger"></i> Unlimited projects</li>
				<li class="list-group-item"><i class="icon-ok text-danger"></i> 27/7 support</li>
			</ul>
			<div class="panel-footer">
				<a class="btn btn-lg btn-block btn-danger" href="#">BUY NOW!</a>
			</div>
		</div>
		<!-- /PRICE ITEM -->
	</div>
	<div id="server-response" class="col-lg-6" >
	</div>
</div>
<div id="optimise-response" class="row">
</div>
<?php
	if($asin <> null){
		?>
		<script>
			var myList=JSON.parse('<?php echo $asin; ?>');
			
			if(myList.success){
				/*
				var prettyResponse = "<table class='table table-dark' >";
				for(obj in myList.data){
					prettyResponse += "<tr><td>" + obj + "</td><td>" +  myList.data[obj] + "</td></tr>";
				}
				prettyResponse += "</table>";
				*/
				
				var prettyResponse = "<table class='table table-dark' >";
				prettyResponse += "<tr><th>Title</th><td col='3' >" + myList.data['title'] + "</td></tr>";
				prettyResponse += "<tr><th>ASIN</th><td>" + myList.data['asin'] + "</td><th>Brand</th><td>" + myList.data['brand'] + "</td></tr>";
				prettyResponse += "<tr><th>Main Category</th><td>" + myList.data['parent_asin'] + "</td><th>Color</th><td>" + myList.data['color'] + "</td></tr>";
				prettyResponse += "<tr><th>Sales Rank</th><td>" + myList.data['salesrank'] + "</td><th>Size</th><td>" + myList.data['size'] + "</td></tr>";
				prettyResponse += "<tr><th>Price</th><td>" + myList.data['price'] + "</td><th>Keyword Found</th><td>" + myList.data['rankings'].length + "</td></tr>";
				prettyResponse += "<tr><th>Prime</th><td>" + myList.data['ean'] + "</td><th>Visibility Index</th><td>" + myList.data['brand'] + "</td></tr>";
				prettyResponse += "<tr><td colspan='3' ><table class='table table-dark' ><tr><th>Last Date</th><th>Last Position</th>";
				for(var i = 0; i < myList.data['rankings'].length; i++){
					prettyResponse += "<tr><td>" +  myList.data['rankings'][i]['last_date'] + "</td><td>" +  myList.data['rankings'][i]['last_position'] + "</td><td>" +  myList.data['rankings'][i]['keyword'] + "</td></tr>";
				}
				prettyResponse += "</td></tr></table>";
				prettyResponse += "</table>";
				
				$('#server-response').html(prettyResponse);
				
				var optimiseResponse = "";
				if(myList.data['title'].length < 100 || myList.data['title'].length > 200){
					optimiseResponse = "<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4' >";
					optimiseResponse += "<div class='alert alert-danger' >";
					optimiseResponse += "<strong>Der Titel sollte zwischen 100 und 200 Zeichen lang sein</strong></div>";
					optimiseResponse += "</div>";
				}else{
					optimiseResponse = "<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4' >";
					optimiseResponse += "<div class='alert alert-success' >";
					optimiseResponse += "<strong>Der Titel sollte zwischen 100 und 200 Zeichen lang sein</strong></div>";
					optimiseResponse += "</div>";
				}
				
				optimiseResponse += "<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4' >";
				optimiseResponse += "<div class='alert alert-info fade in' >";
				optimiseResponse += "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
				optimiseResponse += "<strong>Note!</strong> Please read the comments carefully.</div>";
				optimiseResponse += "</div>";
				
				optimiseResponse += "<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4' >";
				optimiseResponse += "<div class='alert alert-info fade in' >";
				optimiseResponse += "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
				optimiseResponse += "<strong>Note!</strong> Please read the comments carefully.</div>";
				optimiseResponse += "</div>";
				
				$('#optimise-response').html(optimiseResponse);
				
			}else
			{
					$('#server-response').html(myList.message);
			}
		</script>
<?php
	}
?>