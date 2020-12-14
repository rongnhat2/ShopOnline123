
<!-- SLIDER-SECTION-START -->
<div class="main-slider-one slider-area">
	<div id="wrapper">
		<div class="slider-wrapper">
			<div id="mainSlider" class="nivoSlider">
				<?php foreach ($carousel as $key => $value): ?>
					<img src="{{ asset($value->image) }}" alt="main slider" title="#htmlcaption<?php echo $key ?>"/>
				<?php endforeach ?>
			</div>
			<?php foreach ($carousel as $key => $value): ?>
				<div id="htmlcaption<?php echo $key ?>" class="nivo-html-caption slider-caption">
					<div class="container">
						<div class="slider-left slider-right">
							<div class="slide-text animated bounceInRight">
								<h1><?php echo $value->title ?></h1>
							</div>
							<div class="one-p animated bounceInLeft">
								<p><?php echo $value->detail ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>							
	</div>
</div>
<!-- SLIDER SECTION END -->