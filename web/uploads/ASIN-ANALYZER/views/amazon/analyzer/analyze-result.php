<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */

$this->title = 'APA Application';

?>

<div class="row">
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
	<?php if(!$product->page_not_found){ ?>
		<div class="site-index">
			<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' >
				<div class='alert alert-success' >
					Result for <strong><?php echo $product->asin; ?></strong> and <strong>.<?php echo $product->domain; ?></strong> domain.
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">				
			<!-- PRICE ITEM -->
			<div class="panel price panel-red">
				<div class="panel-footer">
					<a class="btn btn-lg btn-block btn-danger" href="https://href.li/?https://www.amazon.<?php echo $product->domain ?>/dp/<?php echo $product->asin; ?>/" target="_blank" >View on Amazon</a>
				</div>
				<div class="panel-heading  text-center">
				<h3><?php echo $product->product_title; ?></h3>
				</div>
				<div class="panel-body text-center">
					<?php echo  $product->product_images; ?>
					<p class="lead" style="font-size:20px"><strong><?php echo $product->asin; ?></strong></p>
				</div>
				<ul class="list-group list-group-flush text-center">
					<li class="list-group-item"><i class="icon-ok text-danger">Amount of Reviews : </i><?php echo $product->kpi__amount_of_reviews; ?></li>
					<li class="list-group-item"><i class="icon-ok text-danger">Length of Title : </i><?php echo $product->kpi__length_of_title; ?></li>
					<li class="list-group-item"><i class="icon-ok text-danger">Amount of Bullet Points : </i><?php echo $product->kpi__amount_of_bullet_points; ?></li>
					<li class="list-group-item"><i class="icon-ok text-danger">Average length of bullet points : </i><?php echo (count($product->kpi__length_of_each_bullet_point) > 0 ? round(array_sum($product->kpi__length_of_each_bullet_point)/count($product->kpi__length_of_each_bullet_point))  : "-"); ?></li>
					<li class="list-group-item"><i class="icon-ok text-danger">Length of Description : </i><?php echo $product->kpi__length_of_description; ?></li>
				</ul>
				<div class="panel-footer">
					<a class="btn btn-lg btn-block btn-danger" href="https://market-pioneers.de/#contact"  >Jetzt optimieren lassen</a>
				</div>
			</div>
			<!-- /PRICE ITEM -->
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7" >
			<table class='table table-dark' >
				<tr><th>Title</th><td colspan='3' ><?php echo $product->product_title; ?></td></tr>
				<tr><th>ASIN</th><td><?php echo $product->asin; ?></td><th>Brand</th><td><?php echo $product->brand; ?></td></tr>
				<tr><th>Main Category</th><td><?php echo (count($product->category) > 0 ? $product->category[0] : "-"); ?></td><th>Color</th><td><?php echo $product->color; ?></td></tr>
				<tr><th>Sales Rank</th><td><?php echo $product->salesrank; ?></td><th>Size</th><td><?php echo $product->size; ?></td></tr>
				<tr><th>Price</th><td><?php echo $product->price; ?></td><th>Keywords Founded</th><td><?php echo count($product->rankings); ?></td></tr>
				<tr><th>Prime</th><td><?php echo $product->prime; ?></td><th>Visibility Index</th><td><?php echo $product->visindex; ?></td></tr>
				<tr>
					<td colspan="4" >
						<table class='table table-dark' >
						<tr><th rowspan="8" >keywords</th><th></th><th></th></tr>
						<tr><th>Position</th><th>keyword</th></tr>
						<?php
							$ranking = $product->rankings;
							//echo $ranking[0]->keyword;
							$max = (count($product->rankings) >5 ? 5 : count($product->rankings));
							for($i = 0; $i < $max; $i++){
								echo  "<tr><td>" . $ranking[$i]->last_position . "</td><td>" . $ranking[$i]->keyword . "</td></tr>";
							}
							
						?>
						</table>
					</td>
				</tr>
			</table>


			<div class="row">
				<?php if($product->kpi_status__amount_of_reviews){ ?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-success' >
							<strong>Die Bewertungen scheinen gut zu sein.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
						</div>
					</div>
				<?php }else{ ?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-danger' >
							<strong>Wir empfehlen Ihnen, Käufer zum Bewerten Ihres Produkts zu motivieren.</strong>
						</div>
					</div>
				<?php } ?>
					
				<?php if($product->kpi_status__length_of_title){ ?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-success' >
							<strong>Der Titel sollte zwischen 100 und 200 Zeichen lang sein</strong>
						</div>
					</div>
				<?php }else{ ?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-danger' >
							<strong>Der Titel sollte zwischen 100 und 200 Zeichen lang sein</strong>
						</div>
					</div>
				<?php } ?>
				
				<?php if($product->kpi_status__amount_of_bullet_points){?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-success' >
							<strong>Es sollten alle Bullet Points mit Inhalt gefüllt werden</strong>
						</div>
					</div>
				<?php }else{?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-danger' >
							<strong>Es sollten alle Bullet Points mit Inhalt gefüllt werden</strong>
						</div>
					</div>
				<?php } ?>
				
				<?php if($product->kpi_status__length_of_each_bullet_point){?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-success' >
							<strong>Die Bullet-Points sollten jeweils 150 bis 300 Zeichen umfassen</strong>
						</div>
					</div>
				<?php }else{?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-danger' >
							<strong>Die Bullet-Points sollten jeweils 150 bis 300 Zeichen umfassen</strong>
						</div>
					</div>
				<?php } ?>
				
				
				<?php if($product->kpi_status__length_of_description){ ?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-success' >
							<strong>Die Beschreibung sollte mindestens 1300 Zeichen umfassen</strong>
						</div>
					</div>
				<?php }else{ ?>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6' >
						<div class='alert alert-danger' >
							<strong>Die Beschreibung sollte mindestens 1300 Zeichen umfassen</strong>
						</div>
					</div>
				<?php } ?>
				
			</div>	
		</div>
	<?php } else { ?>
		<div class="site-index">
			<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' >
				<div class='alert alert-danger' >
					Result Not Found for <strong><?php echo $product->asin; ?></strong> and <strong>.<?php echo $product->domain; ?></strong> domain. Maybe you need to change your domain...
				</div>
			</div>
		</div>

	<?php } ?>
</div>
