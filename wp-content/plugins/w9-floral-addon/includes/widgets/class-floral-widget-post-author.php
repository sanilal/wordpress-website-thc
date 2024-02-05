<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: class-floral-widget-post-author.php
 * @time    : 5/12/2017 8:47 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// NOTE: The skype_username may not be shown right.

class Floral_Widget_Post_Author extends Floral_Widget_Base {
	private $social_data;
	
	/**
	 * Floral_Widget_Logo constructor.
	 */
	public function __construct() {
		$args = array(
			'id'      => 'floral-widget-post-author',
			'name'    => esc_html__( 'Floral Post Author', 'w9-floral-addon' ),
			'options' => array(
				'classname'   => 'floral-widget-post-author',
				'description' => esc_html__( 'Display the information about the post author.', 'w9-floral-addon' )
			),
			'fields'  => array(
				array(
					'id'      => 'title',
					'type'    => 'text',
					'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
					'default' => ''
				),
				
				array(
					'id'      => 'profiles',
					'type'    => 'multi-select',
					'title'   => __( 'Social Profiles', 'w9-floral-addon' ),
					'options' => array(
						'facebook_url'   => __( 'Facebook', 'w9-floral-addon' ),
						'twitter_url'    => __( 'Twitter', 'w9-floral-addon' ),
						'dribbble_url'   => __( 'Dribbble', 'w9-floral-addon' ),
						'vimeo_url'      => __( 'Vimeo', 'w9-floral-addon' ),
						'tumblr_url'     => __( 'Tumblr', 'w9-floral-addon' ),
						'skype_username' => __( 'Skype', 'w9-floral-addon' ),
						'linkedin_url'   => __( 'LinkedIn', 'w9-floral-addon' ),
						'googleplus_url' => __( 'Google+', 'w9-floral-addon' ),
						'flickr_url'     => __( 'Flickr', 'w9-floral-addon' ),
						'youtube_url'    => __( 'YouTube', 'w9-floral-addon' ),
						'pinterest_url'  => __( 'Pinterest', 'w9-floral-addon' ),
						'foursquare_url' => __( 'Foursquare', 'w9-floral-addon' ),
						'instagram_url'  => __( 'Instagram', 'w9-floral-addon' ),
						'github_url'     => __( 'GitHub', 'w9-floral-addon' ),
						'xing_url'       => __( 'Xing', 'w9-floral-addon' ),
						'behance_url'    => __( 'Behance', 'w9-floral-addon' ),
						'deviantart_url' => __( 'Deviantart', 'w9-floral-addon' ),
						'soundcloud_url' => __( 'SoundCloud', 'w9-floral-addon' ),
						'yelp_url'       => __( 'Yelp', 'w9-floral-addon' ),
						'rss_url'        => __( 'RSS Feed', 'w9-floral-addon' ),
						'url_email'      => __( 'Email address', 'w9-floral-addon' )
					),
					
					'default' => 'facebook_url||googleplus_url||twitter_url'
				),
				
				array(
					'id'      => 'alignment',
					'type'    => 'select',
					'title'   => __( 'Social Profiles - Alignment', 'w9-floral-addon' ),
					'options' => array(
						''                => __( 'Default', 'w9-floral-addon' ),
						'inline-block-el' => __( 'Inline', 'w9-floral-addon' ),
						'text-left'       => __( 'Left', 'w9-floral-addon' ),
						'text-center'     => __( 'Center', 'w9-floral-addon' ),
						'text-right'      => __( 'Right', 'w9-floral-addon' ),
					),
					'default' => ''
				),
				
				array(
					'id'      => 'icon_size',
					'type'    => 'number-slider',
					'min'     => '10',
					'max'     => '40',
					'step'    => '1',
					'default' => '16',
					'title'   => __( 'Icon Size (px)', 'w9-floral-addon' )
				),
				
				array(
					'id'      => 'icon_color',
					'type'    => 'select',
					'title'   => __( 'Social Profiles - Icons Color', 'w9-floral-addon' ),
					'options' => array(
						'inherit'      => __( 'Inherit link color', 'w9-floral-addon' ),
						'custom-style' => __( 'Custom style', 'w9-floral-addon' ),
					),
					'default' => 'inherit'
				),
				
				array(
					'id'         => 'colors',
					'type'       => 'select',
					'title'      => __( 'Color', 'w9-floral-addon' ),
					'options'    => array(
						                '__'        => __( 'Default CSS', 'w9-floral-addon' ),
						                'custom'    => __( 'Custom Color', 'w9-floral-addon' ),
						                'p'         => __( 'Primary', 'w9-floral-addon' ),
						                's'         => __( 'Secondary', 'w9-floral-addon' ),
						                'meta-text' => __( 'Meta Text Color', 'w9-floral-addon' ),
						                'border'    => __( 'Border Color', 'w9-floral-addon' ),
						                'text'      => __( 'Text Color', 'w9-floral-addon' ),
						                'light'     => __( 'Light #FFF', 'w9-floral-addon' ),
						                'dark'      => __( 'Dark #000', 'w9-floral-addon' ),
						                'gray2'     => __( 'Gray #222', 'w9-floral-addon' ),
						                'gray4'     => __( 'Gray #444', 'w9-floral-addon' ),
						                'gray6'     => __( 'Gray #666', 'w9-floral-addon' ),
						                'gray8'     => __( 'Gray #888', 'w9-floral-addon' ),
					                ) + floral_get_most_used_colors( 'key_name' ),
					'dependency' => array(
						'element'  => 'icon_color',
						'equal_to' => 'custom-style'
					),
					'default'    => 'text'
				),
				
				array(
					'id'         => 'colors_cp',
					'type'       => 'colorpicker',
					'dependency' => array(
						'element'  => 'colors',
						'equal_to' => 'custom'
					),
					'default'    => ''
				),
				
				array(
					'id'         => 'colors_hover',
					'type'       => 'select',
					'title'      => __( 'Social Profiles - Color - Hover', 'w9-floral-addon' ),
					'options'    => array(
						                '__'        => __( 'Default CSS', 'w9-floral-addon' ),
						                'custom'    => __( 'Custom Color', 'w9-floral-addon' ),
						                'p'         => __( 'Primary', 'w9-floral-addon' ),
						                's'         => __( 'Secondary', 'w9-floral-addon' ),
						                'meta-text' => __( 'Meta Text Color', 'w9-floral-addon' ),
						                'border'    => __( 'Border Color', 'w9-floral-addon' ),
						                'text'      => __( 'Text Color', 'w9-floral-addon' ),
						                'light'     => __( 'Light #FFF', 'w9-floral-addon' ),
						                'dark'      => __( 'Dark #000', 'w9-floral-addon' ),
						                'gray2'     => __( 'Gray #222', 'w9-floral-addon' ),
						                'gray4'     => __( 'Gray #444', 'w9-floral-addon' ),
						                'gray6'     => __( 'Gray #666', 'w9-floral-addon' ),
						                'gray8'     => __( 'Gray #888', 'w9-floral-addon' ),
					                ) + floral_get_most_used_colors( 'key_name' ),
					'dependency' => array(
						'element'  => 'icon_color',
						'equal_to' => 'custom-style'
					),
					'default'    => 'p',
				),
				
				array(
					'id'         => 'colors_hover_cp',
					'type'       => 'colorpicker',
					'dependency' => array(
						'element'  => 'colors_hover',
						'equal_to' => 'custom'
					),
					'default'    => ''
				),
				
				array(
					'id'      => 'spacing_between_items',
					'type'    => 'number-slider',
					'title'   => __( 'Social Profiles - Spacing Between Items (px)', 'w9-floral-addon' ),
					'min'     => '10',
					'max'     => '50',
					'step'    => '5',
					'default' => '20',
				),
			)
		
		);
		parent::__construct( $args );
		$this->social_data = $this->_social_data();
	}
	
	public function widget( $args, $instance ) {
		$get_author_id = $this->get_author_id();
		if ( ! is_singular( 'post' ) || empty( $get_author_id ) ) {
			return;
		}
		
		echo sprintf( '%s', $args['before_widget'] );
		$this->widget_content( $args, $instance );
		echo sprintf( '%s', $args['after_widget'] );
	}
	
	public function widget_content( $args, $instance ) {
		$get_author_id = $this->get_author_id();
		
//		if ( ! is_singular( 'post' ) || empty( $get_author_id ) ) {
////		if ( empty($get_author_id) ) {
//			return;
//		}
		
		$profiles = $icon_size = $alignment = $icon_color = $colors = $colors_cp = $colors_hover = $colors_hover_cp = $is_rounded_icon = $spacing_between_items = '';
		extract( $instance, EXTR_IF_EXISTS );
		$this->the_widget_title( $args, $instance );
		
		//
		$description = get_the_author_meta( 'description', $get_author_id );
		
		// Social
		
		$icon_size = intval( $icon_size ) ? intval( $icon_size ) : 20;
		
		if ( ! empty( $profiles ) ) {
			$profiles = explode( '||', $profiles );
		} else {
			$profiles = array();
		}
		
		$unique_class   = uniqid( 'social-profiles-' );
		$internal_style = array();
		
		$social_profiles_class   = array();
		$social_profiles_class[] = $unique_class;
		
		$social_profiles_class[] = 'icon-fz-' . $icon_size;
		$social_profiles_class[] = $alignment;
		
		if ( $icon_color === 'custom-style' ) {
			if ( $colors !== 'custom' ) {
				$social_profiles_class[] = 'icon-color-' . $colors;
			} else {
				if ( ! empty( $colors_cp ) ) {
					$internal_style[".social-profiles.$unique_class li a"] = 'color: ' . $colors_cp;
				}
			}
			
			if ( $colors_hover !== 'custom' ) {
				$social_profiles_class[] = 'icon-color-hover-' . $colors_hover;
			} else {
				if ( ! empty( $colors_hover_cp ) ) {
					$internal_style[".social-profiles.$unique_class li a:hover"] = 'color: ' . $colors_hover_cp;
				}
			}
		}
		
		$social_profiles_class[] = 'item-spacing-' . $spacing_between_items;
		
		ob_start();
		?>
		<div class="floral-widget-post-author-inner">
			<div class="post-author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email', $get_author_id ), 170 ); ?>
			</div>
			<div class="post-author-info">
				<h3 class="written-by"><?php printf( esc_attr__( '%s', 'floral' ), get_the_author_posts_link() ); ?></h3>
				<p class="author-description"><?php echo esc_html( $description ) ?></p>
				<div class="social-profiles <?php floral_the_clean_html_classes( $social_profiles_class ); ?>">
					<div class="social-profiles-inner-wrapper">
						<ul class="social-profiles-inner">
							<?php foreach ( $profiles as $profile ):
								echo $this->get_single_social_profile( $profile );
							endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
		$this->widget_custom_css( $internal_style );
		echo ob_get_clean();
	}
	
	private function get_author_id() {
		if ( is_singular( 'post' ) ) {
			$get_post      = get_post();
			$get_author_id = $get_post->post_author;
			
			return $get_author_id;
		}
		
		return '';
	}
	
	private function get_single_social_profile( $profile ) {
		$author_id = $this->get_author_id();
		if ( empty( $author_id ) ) {
			return '';
		}
		
		$profile_url = get_the_author_meta( $profile, $author_id );
		
		if ( empty( $profile_url ) ) {
			$profile_url = '#';
		}
		if ( isset( $this->social_data[ $profile ] ) ) {
			return sprintf( '<li><a title="%1$s" href="%2$s%3$s" target="_blank">%4$s <span class="social-name">%1$s</span></a></li>',
				$this->social_data[ $profile ]['title'],
				$this->social_data[ $profile ]['href-prefix'],
				$profile_url,
				$this->social_data[ $profile ]['icon']
			);
		}
		
		return '';
	}
	
	private function _social_data() {
		return array(
			'facebook_url'   => array(
				'title'       => __( 'Facebook', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-facebook"></i>',
				'href-prefix' => ''
			),
			'twitter_url'    => array(
				'title'       => __( 'Twitter', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-twitter"></i>',
				'href-prefix' => ''
			),
			'dribbble_url'   => array(
				'title'       => __( 'Dribbble', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-dribbble"></i>',
				'href-prefix' => ''
			),
			'vimeo_url'      => array(
				'title'       => __( 'Vimeo', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-vimeo-square"></i>',
				'href-prefix' => ''
			),
			'tumblr_url'     => array(
				'title'       => __( 'Tumblr', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-tumblr"></i>',
				'href-prefix' => ''
			),
			'skype_username' => array(
				'title'       => __( 'Skype', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-skype"></i>',
				'href-prefix' => 'skype:'
			),
			'linkedin_url'   => array(
				'title'       => __( 'Linkedin', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-linkedin"></i>',
				'href-prefix' => ''
			),
			'googleplus_url' => array(
				'title'       => __( 'GooglePlus', 'w9-floral-addon' ),
				'icon'        => '<i class="w9 w9-ico-gplus"></i>',
				'href-prefix' => ''
			),
			'flickr_url'     => array(
				'title'       => __( 'Flickr', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-flickr"></i>',
				'href-prefix' => ''
			),
			'youtube_url'    => array(
				'title'       => __( 'Youtube', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-youtube"></i>',
				'href-prefix' => ''
			),
			'pinterest_url'  => array(
				'title'       => __( 'Pinterest', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-pinterest"></i>',
				'href-prefix' => ''
			),
			'foursquare_url' => array(
				'title'       => __( 'Foursquare', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-foursquare"></i>',
				'href-prefix' => ''
			),
			'instagram_url'  => array(
				'title'       => __( 'Instagram', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-instagram"></i>',
				'href-prefix' => ''
			),
			'github_url'     => array(
				'title'       => __( 'GitHub', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-github"></i>',
				'href-prefix' => ''
			),
			'xing_url'       => array(
				'title'       => __( 'Xing', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-xing"></i>',
				'href-prefix' => ''
			),
			'behance_url'    => array(
				'title'       => __( 'Behance', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-behance"></i>',
				'href-prefix' => ''
			),
			'deviantart_url' => array(
				'title'       => __( 'Deviantart', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-deviantart"></i>',
				'href-prefix' => ''
			),
			'soundcloud_url' => array(
				'title'       => __( 'SoundCloud', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-soundcloud"></i>',
				'href-prefix' => ''
			),
			'yelp_url'       => array(
				'title'       => __( 'Yelp', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-yelp"></i>',
				'href-prefix' => ''
			),
			'rss_url'        => array(
				'title'       => __( 'rss', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-rss"></i>',
				'href-prefix' => ''
			),
			'user_email'     => array(
				'title'       => __( 'Email', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-vk"></i>',
				'href-prefix' => 'mailto:'
			)
		);
	}
}