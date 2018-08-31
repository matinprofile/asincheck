<div class="row">
	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">				
		<!-- PRICE ITEM -->
		<div class="panel price panel-red">
			<div class="panel-heading  text-center">
			<h3><?php echo $product->product_title; ?></h3>
			</div>
			<div class="panel-body text-center">
				<?php echo  $product->product_images; ?>
				<p class="lead" style="font-size:20px"><strong><?php echo $product->asin; ?></strong></p>
			</div>
			<ul class="list-group list-group-flush text-center">
				<li class="list-group-item"><i class="icon-ok text-danger">Amount of Reviews :</i><?php echo $product->kpi__amount_of_reviews; ?></li>
				<li class="list-group-item"><i class="icon-ok text-danger">Length of Title :</i><?php echo $product->kpi__length_of_title; ?></li>
				<li class="list-group-item"><i class="icon-ok text-danger">Amount of Bullet Points :</i><?php echo $product->kpi__amount_of_bullet_points; ?></li>
				<li class="list-group-item"><i class="icon-ok text-danger">Average length of bullet points :</i><?php echo round(array_sum($product->kpi__length_of_each_bullet_point)/count($product->kpi__length_of_each_bullet_point)); ?></li>
				<li class="list-group-item"><i class="icon-ok text-danger">Length of Description :</i><?php echo $product->kpi__length_of_description; ?></li>
			</ul>
			<div class="panel-footer">
				<a class="btn btn-lg btn-block btn-danger" href="https://www.amazon.com/dp/<?php echo $product->asin; ?>" target="_blank" >View on Amazon</a>
			</div>
		</div>
		<!-- /PRICE ITEM -->
	</div>
	<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" >
		<table class='table table-dark' >
			<tr><th>Title</th><td col='3' ><?php echo $product->product_title; ?></td></tr>
			<tr><th>ASIN</th><td><?php echo $product->asin; ?></td><th>Brand</th><td><?php echo $product->brand; ?></td></tr>
			<tr><th>Main Category</th><td><?php echo $product->category; ?></td><th>Color</th><td><?php echo $product->color; ?></td></tr>
			<tr><th>Sales Rank</th><td><?php echo $product->salesrank; ?></td><th>Size</th><td><?php echo $product->size; ?></td></tr>
			<tr><th>Prime</th><td><?php echo $product->prime; ?></td><th>Visibility Index</th><td><?php echo $product->visibility_index; ?></td></tr>
		</table>


		<div class="row">
			<?php if($product->kpi_status__amount_of_reviews){ ?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-success' >
						<strong>Wir empfehlen Ihnen, Käufer zum Bewerten Ihres Produkts zu motivieren.</strong>
					</div>
				</div>
			<?php }else{ ?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-danger' >
						<strong>Wir empfehlen Ihnen, Käufer zum Bewerten Ihres Produkts zu motivieren.</strong>
					</div>
				</div>
			<?php } ?>
				
			<?php if($product->kpi_status__length_of_title){ ?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-success' >
						<strong>Der Titel sollte zwischen 100 und 200 Zeichen lang sein</strong>
					</div>
				</div>
			<?php }else{ ?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-danger' >
						<strong>Der Titel sollte zwischen 100 und 200 Zeichen lang sein</strong>
					</div>
				</div>
			<?php } ?>
			
			<?php if($product->kpi_status__amount_of_bullet_points){?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-success' >
						<strong>Es sollten alle Bullet Points mit Inhalt gefüllt werden</strong>
					</div>
				</div>
			<?php }else{?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-danger' >
						<strong>Es sollten alle Bullet Points mit Inhalt gefüllt werden</strong>
					</div>
				</div>
			<?php } ?>
			
			<?php if($product->kpi_status__length_of_each_bullet_point){?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-success' >
						<strong>Die Bullet-Points sollten jeweils 150 bis 300 Zeichen umfassen</strong>
					</div>
				</div>
			<?php }else{?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-danger' >
						<strong>Die Bullet-Points sollten jeweils 150 bis 300 Zeichen umfassen</strong>
					</div>
				</div>
			<?php } ?>
			
			
			<?php if($product->kpi_status__length_of_description){ ?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-success' >
						<strong>Die Beschreibung sollte mindestens 1300 Zeichen umfassen</strong>
					</div>
				</div>
			<?php }else{ ?>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' >
					<div class='alert alert-danger' >
						<strong>Die Beschreibung sollte mindestens 1300 Zeichen umfassen</strong>
					</div>
				</div>
			<?php } ?>
			
		</div>	
		
	</div>
</div>
