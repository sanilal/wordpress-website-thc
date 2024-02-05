<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-social-profiles.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_Widget_Social_Profiles extends Floral_Widget_Base {
	private $social_data;
	
	public function __construct() {
		$args = array(
			'id'      => 'floral-widget-social-profiles',
			'name'    => __( 'Floral Social Profiles', 'w9-floral-addon' ),
			'options' => array(
				'classname'   => 'floral-widget-social-profiles',
				'description' => __( 'Widget to show social profiles in the sidebar.', 'w9-floral-addon' )
			),
			'fields'  => array(
				array(
					'id'      => 'title',
					'type'    => 'text',
					'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
					'default' => ''
				),
				
				array(
					'id'      => 'module_type',
					'type'    => 'select',
					'title'   => __( 'Module Type', 'w9-floral-addon' ),
					'options' => array(
						'social-url' => __( 'Social URL', 'w9-floral-addon' ),
						'share-this' => __( 'Share This', 'w9-floral-addon' ),
					),
					'default' => 'social-url'
				),
				
				array(
					'id'         => 'profiles',
					'type'       => 'multi-select',
					'title'      => __( 'Social Profiles', 'w9-floral-addon' ),
					'options'    => array(
						'social-twitter-url'    => __( 'Twitter', 'w9-floral-addon' ),
						'social-facebook-url'   => __( 'Facebook', 'w9-floral-addon' ),
						'social-dribbble-url'   => __( 'Dribbble', 'w9-floral-addon' ),
						'social-vimeo-url'      => __( 'Vimeo', 'w9-floral-addon' ),
						'social-tumblr-url'     => __( 'Tumblr', 'w9-floral-addon' ),
						'social-skype-url'      => __( 'Skype', 'w9-floral-addon' ),
						'social-linkedin-url'   => __( 'LinkedIn', 'w9-floral-addon' ),
						'social-googleplus-url' => __( 'Google+', 'w9-floral-addon' ),
						'social-flickr-url'     => __( 'Flickr', 'w9-floral-addon' ),
						'social-youtube-url'    => __( 'YouTube', 'w9-floral-addon' ),
						'social-pinterest-url'  => __( 'Pinterest', 'w9-floral-addon' ),
						'social-foursquare-url' => __( 'Foursquare', 'w9-floral-addon' ),
						'social-instagram-url'  => __( 'Instagram', 'w9-floral-addon' ),
						'social-github-url'     => __( 'GitHub', 'w9-floral-addon' ),
						'social-xing-url'       => __( 'Xing', 'w9-floral-addon' ),
						'social-behance-url'    => __( 'Behance', 'w9-floral-addon' ),
						'social-deviantart-url' => __( 'Deviantart', 'w9-floral-addon' ),
						'social-soundcloud-url' => __( 'SoundCloud', 'w9-floral-addon' ),
						'social-yelp-url'       => __( 'Yelp', 'w9-floral-addon' ),
						'social-rss-url'        => __( 'RSS Feed', 'w9-floral-addon' ),
						'social-email-url'      => __( 'Email address', 'w9-floral-addon' )
					),
					'dependency' => array(
						'element'  => 'module_type',
						'equal_to' => 'social-url'
					),
					'default'    => 'social-twitter-url||social-facebook-url||social-googleplus-url'
				),
				
				array(
					'id'         => 'share_this_label',
					'type'       => 'text',
					'title'      => esc_html__( 'Share This Label', 'w9-floral-addon' ),
					'dependency' => array(
						'element'  => 'module_type',
						'equal_to' => 'share-this'
					),
				),
				
				array(
					'id'      => 'alignment',
					'type'    => 'select',
					'title'   => __( 'Alignment', 'w9-floral-addon' ),
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
					'default' => '20',
					'title'   => __( 'Icon Size (px)', 'w9-floral-addon' )
				),
				
				array(
					'id'      => 'icon_color',
					'type'    => 'select',
					'title'   => __( 'Icons Color', 'w9-floral-addon' ),
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
					'title'      => __( 'Color - Hover', 'w9-floral-addon' ),
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
					'id'    => 'is_rounded_icon',
					'type'  => 'checkbox',
					'title' => __( 'Is Rounded Icon', 'w9-floral-addon' ),
				
				),
				
				array(
					'id'         => 'rounded_size',
					'type'       => 'number-slider',
					'min'        => '20',
					'max'        => '60',
					'step'       => '1',
					'default'    => '35',
					'title'      => __( 'Size (px)', 'w9-floral-addon' ),
					'dependency' => array(
						'element'  => 'is_rounded_icon',
						'equal_to' => '1',
					)
				),
				
				array(
					'id'         => 'background_colors',
					'type'       => 'select',
					'title'      => __( 'Background Color', 'w9-floral-addon' ),
					'options'    => array(
						                '__'          => __( 'Default CSS', 'w9-floral-addon' ),
						                'transparent' => __( 'Transparent', 'w9-floral-addon' ),
						                'custom'      => __( 'Custom Color', 'w9-floral-addon' ),
						                'p'           => __( 'Primary', 'w9-floral-addon' ),
						                's'           => __( 'Secondary', 'w9-floral-addon' ),
						                'meta-text'   => __( 'Meta Text Color', 'w9-floral-addon' ),
						                'border'      => __( 'Border Color', 'w9-floral-addon' ),
						                'text'        => __( 'Text Color', 'w9-floral-addon' ),
						                'light'       => __( 'Light #FFF', 'w9-floral-addon' ),
						                'dark'        => __( 'Dark #000', 'w9-floral-addon' ),
						                'gray2'       => __( 'Gray #222', 'w9-floral-addon' ),
						                'gray4'       => __( 'Gray #444', 'w9-floral-addon' ),
						                'gray6'       => __( 'Gray #666', 'w9-floral-addon' ),
						                'gray8'       => __( 'Gray #888', 'w9-floral-addon' ),
					                ) + floral_get_most_used_colors( 'key_name' ),
					'default'    => '__',
					'dependency' => array(
						'element'  => 'is_rounded_icon',
						'equal_to' => '1',
					)
				),
				
				array(
					'id'         => 'background_colors_cp',
					'type'       => 'colorpicker',
					'dependency' => array(
						'element'  => 'background_colors',
						'equal_to' => 'custom'
					),
					'default'    => ''
				),
				
				array(
					'id'         => 'background_hover_colors',
					'type'       => 'select',
					'title'      => __( 'Background Hover Color', 'w9-floral-addon' ),
					'options'    => array(
						                '__'          => __( 'Default CSS', 'w9-floral-addon' ),
						                'transparent' => __( 'Transparent', 'w9-floral-addon' ),
						                'custom'      => __( 'Custom Color', 'w9-floral-addon' ),
						                'p'           => __( 'Primary', 'w9-floral-addon' ),
						                's'           => __( 'Secondary', 'w9-floral-addon' ),
						                'meta-text'   => __( 'Meta Text Color', 'w9-floral-addon' ),
						                'border'      => __( 'Border Color', 'w9-floral-addon' ),
						                'text'        => __( 'Text Color', 'w9-floral-addon' ),
						                'light'       => __( 'Light #FFF', 'w9-floral-addon' ),
						                'dark'        => __( 'Dark #000', 'w9-floral-addon' ),
						                'gray2'       => __( 'Gray #222', 'w9-floral-addon' ),
						                'gray4'       => __( 'Gray #444', 'w9-floral-addon' ),
						                'gray6'       => __( 'Gray #666', 'w9-floral-addon' ),
						                'gray8'       => __( 'Gray #888', 'w9-floral-addon' ),
					                ) + floral_get_most_used_colors( 'key_name' ),
					'default'    => '__',
					'dependency' => array(
						'element'  => 'is_rounded_icon',
						'equal_to' => '1',
					)
				),
				
				array(
					'id'         => 'background_hover_colors_cp',
					'type'       => 'colorpicker',
					'dependency' => array(
						'element'  => 'background_hover_colors',
						'equal_to' => 'custom'
					),
					'default'    => ''
				),
				
				array(
					'id'      => 'spacing_between_items',
					'type'    => 'number-slider',
					'title'   => __( 'Spacing Between Items (px)', 'w9-floral-addon' ),
					'min'     => '10',
					'max'     => '50',
					'step'    => '5',
					'default' => '10',
				),
			
			)
		
		);
		parent::__construct( $args );
		$this->social_data = $this->_social_data();
	}
	
	public function widget_content( $args, $instance ) {
		$module_type = $share_this_label = $profiles = $icon_size = $alignment = $icon_color = $colors = $colors_cp = $colors_hover = $colors_hover_cp = $is_rounded_icon = $rounded_size
			= $background_colors = $background_colors_cp = $background_hover_colors = $background_hover_colors_cp = $spacing_between_items = '';
		extract( $instance, EXTR_IF_EXISTS );
		$this->the_widget_title( $args, $instance );
		
		$icon_size    = intval( $icon_size ) ? intval( $icon_size ) : 20;
		$rounded_size = intval( $rounded_size ) ? intval( $rounded_size ) : 35;
		
		if ( ! empty( $profiles ) ) {
			$profiles = explode( '||', $profiles );
		} else {
			$profiles = array();
		}
		
		$unique_class   = uniqid( 'social-profiles-' );
		$internal_style = array();
		
		$social_profiles_class   = array();
		$social_profiles_class[] = $unique_class;
		$social_profiles_class[] = $module_type;
		if ( $module_type === 'social-url' ) {
			$social_profiles_class[] = 'fz-0';
		}
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
		if ( $is_rounded_icon ) {
			$social_profiles_class[] = 'style-rounded';
			$social_profiles_class[] = 'rounded-size-' . $rounded_size;
			if ( $background_colors !== 'custom' ) {
				$social_profiles_class[] = 'rounded-bg-' . $background_colors;
			} else {
				if ( ! empty( $background_colors_cp ) ) {
					$internal_style[".social-profiles.style-rounded.$unique_class li a"] = 'background-color: ' . $background_colors_cp;
				}
			}
			if ( $background_hover_colors !== 'custom' ) {
				$social_profiles_class[] = 'rounded-bg-hover-' . $background_hover_colors;
			} else {
				if ( ! empty( $background_hover_colors_cp ) ) {
					$internal_style[".social-profiles.style-rounded.$unique_class li a:hover"] = 'background-color: ' . $background_hover_colors_cp;
				}
			}
		}
		ob_start();
		?>
		<div class="social-profiles <?php floral_the_clean_html_classes( $social_profiles_class ); ?>">
			<div class="social-profiles-inner-wrapper">
				<?php if ( $module_type === 'social-url' ) : ?>
					<ul class="social-profiles-inner">
						<?php foreach ( $profiles as $profile ):
							echo $this->get_single_social_profile( $profile );
						endforeach; ?>
					</ul>
				<?php elseif ( $module_type === 'share-this' ): ?>
					<?php echo ( ! empty( $share_this_label ) ) ? sprintf( '<span class="share-this-label">%s</span>', $share_this_label ) : ''; ?>
					<ul class="social-profiles-inner"><?php echo $this->get_share_this_profile(); ?></ul>
				<?php endif; ?>
			</div>
		</div>
		<?php
		$this->widget_custom_css( $internal_style );
		echo ob_get_clean();
	}
	
	
	private function get_single_social_profile( $profile ) {
		$profile_url = floral_get_option( $profile, '', '' );
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
	
	private function get_share_this_profile() {
		$enable_facebook  = floral_get_option( 'social-sharing', 'facebook', '' );
		$enable_twitter   = floral_get_option( 'social-sharing', 'twitter', '' );
		$enable_google    = floral_get_option( 'social-sharing', 'google', '' );
		$enable_linkedin  = floral_get_option( 'social-sharing', 'linkedin', '' );
		$enable_tumblr    = floral_get_option( 'social-sharing', 'tumblr', '' );
		$enable_pinterest = floral_get_option( 'social-sharing', 'pinterest', '' );
		
		
		if ( empty( $enable_facebook ) &&
		     empty( $enable_twitter ) &&
		     empty( $enable_google ) &&
		     empty( $enable_linkedin ) &&
		     empty( $enable_tumblr ) &&
		     empty( $enable_pinterest )
		) {
			return '';
		}
		
		ob_start();
		?>
		
		<?php if ( $enable_facebook == 1 ) : ?>
			<li>
				<a onclick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>','sharer', 'toolbar=0,status=0,width=620,height=280');" href="javascript:;" title="<?php echo esc_attr__( 'Share on Facebook', 'w9-floral-addon' ); ?>">
					<i class="w9 w9-ico-facebook-1"></i> <span class="share-label">Facebook</span>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $enable_twitter == 1 ) : ?>
			<li>
				<a onclick="popUp=window.open('http://twitter.com/home?status=<?php echo esc_attr( urlencode( get_the_title() ) ); ?> <?php echo esc_attr( urlencode( get_permalink() ) ); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;" title="<?php echo esc_attr__( 'Share on Twitter', 'w9-floral-addon' ); ?>">
					<i class="w9 w9-ico-twitter-1"></i> <span class="share-label">Twitter</span>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $enable_google == 1 ) : ?>
			<li>
				<a href="javascript:;" onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" title="<?php echo esc_attr__( 'Share on Google', 'w9-floral-addon' ); ?>">
					<i class="w9 w9-ico-gplus"></i> <span class="share-label">Google</span>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $enable_linkedin == 1 ): ?>
			<li>
				<a onclick="popUp=window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>&amp;title=<?php echo esc_attr( urlencode( get_the_title() ) ); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;" title="<?php echo esc_attr__( 'Share on Linkedin', 'w9-floral-addon' ); ?>">
					<i class="w9 w9-ico-linkedin-1"></i> <span class="share-label">Linkedin</span>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $enable_tumblr == 1 ) : ?>
			<li>
				<a onclick="popUp=window.open('http://www.tumblr.com/share/link?url=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>&amp;name=<?php echo esc_attr( urlencode( get_the_title() ) ); ?>&amp;description=<?php echo esc_attr( urlencode( get_the_excerpt() ) ); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;" title="<?php echo esc_attr__( 'Share on Tumblr', 'w9-floral-addon' ); ?>">
					<i class="w9 w9-ico-tumblr-1"></i> <span class="share-label">Tumblr</span>
				</a>
			</li>
		<?php endif; ?>
		
		<?php if ( $enable_pinterest == 1 ) : ?>
			<li>
				<a onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>&amp;description=<?php echo esc_attr( urlencode( get_the_title() ) ); ?>&amp;media=<?php $arrImages = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				echo has_post_thumbnail() ? esc_attr( $arrImages[0] ) : ""; ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;" title="<?php echo esc_attr__( 'Share on Pinterest', 'w9-floral-addon' ); ?>">
					<i class="w9 w9-ico-pinterest"></i> <span class="share-label">Pinterest</span>
				</a>
			</li>
		<?php endif; ?>
		<?php
		return ob_get_clean();
	}
	
	private function _social_data() {
		return array(
			'social-twitter-url'    => array(
				'title'       => __( 'Twitter', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-twitter"></i>',
				'href-prefix' => ''
			),
			'social-facebook-url'   => array(
				'title'       => __( 'Facebook', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-facebook"></i>',
				'href-prefix' => ''
			),
			'social-dribbble-url'   => array(
				'title'       => __( 'Dribbble', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-dribbble"></i>',
				'href-prefix' => ''
			),
			'social-youtube-url'    => array(
				'title'       => __( 'Youtube', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-youtube"></i>',
				'href-prefix' => ''
			),
			'social-vimeo-url'      => array(
				'title'       => __( 'Vimeo', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-vimeo-square"></i>',
				'href-prefix' => ''
			),
			'social-tumblr-url'     => array(
				'title'       => __( 'Tumblr', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-tumblr"></i>',
				'href-prefix' => ''
			),
			'social-skype-url'      => array(
				'title'       => __( 'Skype', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-skype"></i>',
				'href-prefix' => 'skype:'
			),
			'social-linkedin-url'   => array(
				'title'       => __( 'Linkedin', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-linkedin"></i>',
				'href-prefix' => ''
			),
			'social-googleplus-url' => array(
				'title'       => __( 'GooglePlus', 'w9-floral-addon' ),
				'icon'        => '<i class="w9 w9-ico-gplus"></i>',
				'href-prefix' => ''
			),
			'social-flickr-url'     => array(
				'title'       => __( 'Flickr', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-flickr"></i>',
				'href-prefix' => ''
			),
			'social-pinterest-url'  => array(
				'title'       => __( 'Pinterest', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-pinterest"></i>',
				'href-prefix' => ''
			),
			'social-foursquare-url' => array(
				'title'       => __( 'Foursquare', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-foursquare"></i>',
				'href-prefix' => ''
			),
			'social-instagram-url'  => array(
				'title'       => __( 'Instagram', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-instagram"></i>',
				'href-prefix' => ''
			),
			'social-github-url'     => array(
				'title'       => __( 'GitHub', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-github"></i>',
				'href-prefix' => ''
			),
			'social-xing-url'       => array(
				'title'       => __( 'Xing', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-xing"></i>',
				'href-prefix' => ''
			),
			'social-behance-url'    => array(
				'title'       => __( 'Behance', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-behance"></i>',
				'href-prefix' => ''
			),
			'social-deviantart-url' => array(
				'title'       => __( 'Deviantart', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-deviantart"></i>',
				'href-prefix' => ''
			),
			'social-soundcloud-url' => array(
				'title'       => __( 'SoundCloud', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-soundcloud"></i>',
				'href-prefix' => ''
			),
			'social-yelp-url'       => array(
				'title'       => __( 'Yelp', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-yelp"></i>',
				'href-prefix' => ''
			),
			'social-rss-url'        => array(
				'title'       => __( 'rss', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-rss"></i>',
				'href-prefix' => ''
			),
			'social-email-url'      => array(
				'title'       => __( 'Email', 'w9-floral-addon' ),
				'icon'        => '<i class="fa fa-vk"></i>',
				'href-prefix' => 'mailto:'
			)
		);
	}
}