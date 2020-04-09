<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Jogasana
 * @since Jogasana 1.0
 */
get_header(); ?>

<?php if ( have_posts() ): ?>

	<?php global $jogasana_settings; ?>

	<div class="ys-single-entry-holder">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			global $post;
			$this_post = array();
			$this_post['id'] = $this_id = get_the_ID();
			$name = get_the_title($this_id);
			$this_post['content'] = get_the_content();
			$this_post['post_format'] = $format = get_post_format() ? get_post_format() : 'standard';
			$this_post['url'] = $link = get_permalink($this_id);
			$image_size = jogasana_blog_alias( $format, '', 'ys-big-thumbs', 'ys-type-2' );
			$this_post['image_size'] = $image_size;
			$this_post = apply_filters( 'jogasana-entry-format-single', $this_post );
			
			$thumbnail_atts = array(
				'alt'	=> trim(strip_tags(get_the_excerpt($this_id))),
				'title'	=> trim(strip_tags(get_the_title($this_id)))
			);

			extract($this_post);
			?>

			<div class="ys-content-element content-element">

				<div id="<?php echo get_the_ID() ?>" <?php post_class('ys-single content-element3'); ?>>
				<div class="entry-box single-entry">
				
					<div class="entry-body content-element4">
			  
					  <?php if ( $jogasana_settings['post-title'] ){ ?>
					  <h1 class="entry-title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses_post($name); ?></a></h1>
					  <?php } ?>
					  
					  <div class="entry-meta">
			  
						<?php echo jogasana_blog_post_meta($this_id,
								array(
									'author' => true,
									'date' => true,
									'comments' => true,
									'cat' => true
								));  ?>
						
					  </div>
					  
					</div>
				
				<div class="ys-entry entry">

					<?php if ( is_sticky($this_id) ): ?>
						<?php printf( '<div class="sticky-post label-top">%s</div>', esc_html__( 'Featured', 'jogasana' ) ); ?>
					<?php endif; ?>
					
					<?php if ( ! post_password_required() ) : ?>
						<div class="thumbnail-attachment">
							<?php cvm_video_embed_html(); ?>
						</div>
					<?php endif; ?>

					<div class="single-content content-element3">
						<?php if ( !empty($this_post['content']) ): ?>
						<?php the_content(); ?>
						<?php 
						wp_link_pages( array(
							'before'      => '<div class="pagination nav-pagination" role="navigation">',
							'after'       => '</div>',
							'link_before'      => '<span class="page-link-number">',
							'link_after'       => '</span>'
						) );
						?>
						<?php endif; ?>
					</div>
					
					
					<?php $tag_list = get_the_tag_list( '', ' ', '', $this_id ); ?>
					 <?php 
					 if ( ( $jogasana_settings['post-tag'] && !empty($tag_list) ) || $jogasana_settings['post-single-share'] ){ ?>
					<div class="flex-row justify-content-between">
					
					  <?php if ( $jogasana_settings['post-tag'] ){ ?>
                        
						<?php if ( !empty($tag_list) ): ?>
							<div class="tagcloud">
							<?php echo wp_kses_post($tag_list); ?>
							</div>
						<?php endif; ?>
                        
                      <?php } ?>
					  
					 <?php if ( $jogasana_settings['post-single-share'] ){ ?>
					  <?php if ( function_exists('jogasana_base_post_share_btn') ): ?>
					  <?php echo jogasana_base_post_share_btn($this_id, esc_html__( 'Share', 'jogasana' ));  ?>
					  <?php endif; ?>
                     <?php } ?>
					  
					</div>
					 <?php } ?>
					
				</div>
				</div>
				</div>
				
				<?php if ( $jogasana_settings['post-nav'] ): ?>
					<?php get_template_part( 'template-parts/single', 'link-pages' ) ?>
				<?php endif; ?>

				<?php if ( $jogasana_settings['post-author'] ): ?>
					<?php get_template_part( 'template-parts/single', 'author-box' ); ?>
				<?php endif; ?>
				
				<?php if ( $jogasana_settings['post-related'] ): ?>
				<?php get_template_part( 'template-parts/single', 'related' ); ?>
				<?php endif; ?>
				
			</div>
			
			<?php if ( $jogasana_settings['post-comments'] ): ?>
				<?php if ( comments_open() || '0' != get_comments_number() ): ?>
					<?php comments_template(); ?>
				<?php endif; ?>
			<?php endif; ?>

		<?php endwhile ?>

	</div>

<?php endif; ?>

<?php get_footer(); ?>