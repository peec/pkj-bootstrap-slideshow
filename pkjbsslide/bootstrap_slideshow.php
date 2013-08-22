<div id="<?php echo $id?>" class="carousel slide">
	<!-- Indicators -->
	<ol class="carousel-indicators">
  	<?php foreach ($attachments as $i =>  $att):?>
    	<li data-target="#<?php echo $id?>" data-slide-to="<?php echo $i?>"
			<?php echo $i == 0 ? 'class="active"' : ''?>></li>
    <?php endforeach?>
  </ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php foreach ($attachments as $i =>  $att):?>
		<div class="item <?php echo $i == 0 ? 'active' : ''?>">
			<img src="<?php echo $att->guid?>" alt="<?php echo $att->post_title?>" />
			<div class="carousel-caption">
				<?php if ($att->post_title):?><h3><?php echo $att->post_title?></h3><?php endif?>
				<?php if ($att->post_excerpt):?><p><?php echo $att->post_excerpt?></p><?php endif?>
			</div>
		</div>
		<?php endforeach?>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#<?php echo $id?>"
		data-slide="prev"> <span class="icon-prev"></span>
	</a> <a class="right carousel-control" href="#<?php echo $id?>"
		data-slide="next"> <span class="icon-next"></span>
	</a>
</div>