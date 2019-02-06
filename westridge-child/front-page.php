<?php get_header(); ?>
		<main id="contentArea">
			<?php if( in_category('alert')) { ?>
			<section id="alerts">
				<?php
					$my_query = new WP_Query( array('showposts' => $posts_to_show, 'category_name'  => 'alert'));
				   			while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				   				<article class="post">
							   		<header class="postmeta">
										<h1><?php the_title(); ?></h1>
											<ul>
												<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
											</ul>
									</header>
							   		<?php echo the_content(); ?>
							   	</article>
							<?php endwhile;
					wp_reset_query();
				?>
				<button id="closeAlert"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/round-delete-button-white.svg" alt="Close Alerts" /></button>
			</section>
			<?php } ?>
			 <section id="announcments">
				<h1>Westridge Announcements</h1>
					 <div class="slick-wrapper">
					  <?php
					  		$args = array( 'post_type' => 'announcement' ,'posts_per_page' => 5 , 'orderby'  => array('date' => 'DESC'));
							// Variable to call WP_Query.
							$the_query = new WP_Query( $args );
							if($the_query->have_posts()) :
								while ($the_query->have_posts()) : $the_query->the_post();?>
									<article class="slide" style="background-image: url('<?php the_field('announcement_image'); ?>')">
									  	<div class="slide-text">
									  		<h2><?php the_title(); ?></h2>
									  		<p><?php
										  			the_field('announcement_text');
										  			$slideLink = get_field('announcement_link');
										  			$slideLinkLabel = get_field('announcement_link_label');
										  			if($slideLink) { ?>
												 		<a href="<?php echo $slideLink ?>"><?php echo $slideLinkLabel ?></a>
												 	<?php }
										  		?>
										  	</p>
									  	</div>
								  	</article>
								<?php endwhile;
							else :
								echo '<p>No Content Found</p>';

							endif;
						wp_reset_query();
						?>
					 </div>
			</section>
			<section id="mainContent" class="postgrid newsBlog">
				<h1>Westridge News</h1>
					<?php
						
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$the_query = new WP_Query( array( 'posts_per_page' => 9 , 'post_type'  => array('post', 'principals_message') , 'paged'  => $paged) );
						if($the_query->have_posts()) :
							while ($the_query->have_posts()) : $the_query->the_post();?>
						   		<article class="post">
					   				<header class="postmeta">
						   				<?php 
							   				if ($post->post_type == "principals_message") { ?>
							   					<a href="<?php the_permalink(); ?>">
						   							<div class="featured-image">
						   								<img src="<?php echo get_theme_file_uri(); ?>/assets/images/principal-message.jpg" alt="Admin photo" class="left" />
								   					</div>
 									<?php	} elseif (has_post_thumbnail()) { ?>
						   						<a href="<?php the_permalink(); ?>">
						   							<div class="featured-image">
						   								<?php the_post_thumbnail(); ?>
								   					</div>
							   					
							   		<?php } else { ?>
								   				<a href="<?php the_permalink(); ?>">
												   	<div class="featured-image">
											   			<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/building-image.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" width="217" height="175">
											   		</div>
							   					
							   		<?php }?>
													<h2><?php if ($post->post_type == "principals_message") { echo "Principal's Message - " . get_the_title(); } else { the_title(); } ?></h2>
								   				</a>
										<ul>
											<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
										</ul>
									</header>

					   				<?php
						   				echo get_excerpt();
						   			?>
						   		</article>
						   	<?php endwhile;?>
							   	<nav class="archiveNav">
							   		<?php echo paginate_links( array( 'total' => $the_query->max_num_pages)); ?>
							   	</nav>
								<?php else :
									echo '<p>No Content Found</p>';
						endif;
					wp_reset_query();
					?>
			</section>
		</main>
		<?php
			get_sidebar();
			get_footer();
		?>