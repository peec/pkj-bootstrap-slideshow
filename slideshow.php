
			<?php if (isset($slides)): ?>
				<div id="carousel-<?php echo $slideshow_id ?>" class="carousel slide">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<?php if (count($slides) > 1):?>
							<?php foreach ($slides as $k => $slide): ?>
								
								<?php if (has_post_thumbnail($slide->ID)):?>
									<li data-target="#carousel-<?php echo $slideshow_id ?>" data-slide-to="<?php echo $k?>"
									class="<?php echo $k==0 ? 'active' : ''?>"></li>
								<?php endif?>
							<?php endforeach?>
						<?php endif?>
					</ol>
		
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<?php foreach ($slides as $k => $slide): ?>
							<?php if (has_post_thumbnail($slide->ID)):?>
								<div class="item <?php echo $k==0 ? 'active' : ''?>">
	
										<img style="width: 100%;" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($slide->ID), false)[0]?>" />
										<div class="carousel-caption">
											<?php if ($slide->post_title): ?>
												<h3><?php echo $slide->post_title?></h3>
											<?php endif?>
											<?php if ($slide->post_excerpt):?>
												<p><?php echo $slide->post_excerpt?></p>
											<?php endif?>
										</div>
								</div>
							<?php endif?>
						<?php endforeach?>
							
					</div>
	
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-<?php echo $slideshow_id ?>"
						data-slide="prev"> <span class="icon-prev"></span>
					</a> <a class="right carousel-control"
						href="#carousel-<?php echo $slideshow_id ?>" data-slide="next"> <span
						class="icon-next"></span>
					</a>
				</div>
			<?php endif?>