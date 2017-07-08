<?php
global $page_slider;

if(!empty($page_slider))
{
	$pp_slider_items = get_option('pp_slider_items');

	//Get all post from this category
	$args = array(
		'posts_per_page'  	=> $pp_slider_items,
		'category'			=> $page_slider,
	);
	
	$slider_posts = get_posts($args);
	$count_posts = count($slider_posts);
	
	if(!empty($slider_posts))
	{
?>
	<div id="page_slider" class="slider_wrapper" data-height="430" data-count="<?php echo $count_posts; ?>">
		<div class="flexslider">
			<ul class="slides">
<?php
		foreach($slider_posts as $key => $slider_post)
		{
			$image_thumb = '';
?>
				<li>
<?php
				if(has_post_thumbnail($slider_post->ID, 'blog_single_full'))
				{
				    $image_id = get_post_thumbnail_id($slider_post->ID);
				    $image_thumb = wp_get_attachment_image_src($image_id, 'blog_single_full', true);
				}
				
				$post_link = get_permalink($slider_post->ID);
?>
				<a href="<?php echo $post_link; ?>">
					<div class="main_post_full" style="background-image:url('<?php echo $image_thumb[0]; ?>');background-position: center top;background-repeat: repeat;">
						<div class="post_title">
						    <div class="post_title_full_wrapper">
						    	<h3><?php echo $slider_post->post_title; ?></h3>
						    	<div class="slider_date"><?php echo date(THEMEDATEFORMAT, strtotime($slider_post->post_date)); ?></div>
						    	<div class="read_full"><?php _e( 'Read Full Story', THEMEDOMAIN ); ?></div>
						    </div>
						</div>
					</div>
				</a>
				
				</li>
<?php
		}
?>			</ul>
		</div>
	</div>
<?php
	}
}
?>