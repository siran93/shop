<div class="container">
	<br>
	<div id="myCarousel" class="carousel slide slider_" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php for ($i = 0; $i < count($slider); $i++) : ?>
				<li class="<?=($i == 0) ? 'active' : ''?>" data-target="#myCarousel" data-slide-to="<?=$i?>"></li>
			<?php endfor; ?>
		</ol>
		<div class="carousel-inner" role="listbox">
			<?php foreach($slider as $value):?>
				<div class="item" style="height: 350px;">
					<img src="<?=base_url().'assets/photos/slider_photos/'.$value['image']?>" alt="Chania" class='image'>
				</div>
			<?php endforeach; ?>
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
