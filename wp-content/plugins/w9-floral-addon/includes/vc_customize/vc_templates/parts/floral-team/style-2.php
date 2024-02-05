<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: style-2.php
 * @time    : 4/18/2017 4:37 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>

<div class="floral-team-member-inner">
	<?php if ( ! empty( $member_avatar ) ): ?>
		<div class="__avatar-wrapper">
			<div class="__avatar">
				<?php
				$avatar_size = Floral_Image::get_fixed_ratio_size( $avatar_size, $avatar_ratio );
				if ( $avatar_onclick == 'lightbox' ) {
					$avatar = Floral_Wrap::prettyphoto_image( $member_avatar, $avatar_size );
				} else {
					$avatar = Floral_Image::get_image( $member_avatar, $avatar_size );
					
					if ( $avatar_onclick == 'member_url' && ! empty( $member_url['url'] ) ) {
						$avatar = Floral_Wrap::link( $avatar, $member_url['url'], array(
							'target' => $member_url['target'],
							'title'  => $member_url['title']
						) );
					}
				}
				echo sprintf( '%s', $avatar );
				?>
			</div>
			<?php if ( ! empty( $member_socials ) ): ?>
			<ul class="__social-list social-profiles list-unstyled">
				<?php foreach ( $member_socials as $social ):
					$social_type = ( isset( $social['social_type'] ) && isset( $social_list[ $social['social_type'] ] ) ) ? $social_list[ $social['social_type'] ] : false;
					$social_url  = ( isset( $social['social_url'] ) ) ? $social['social_url'] : '';
					if ( $social_type ) {
						$icon = '<i class="' . $social_type['icon'] . '"></i>';
						$icon = Floral_Wrap::link( $icon, esc_url( $social_url ), array(
							'target' => '_blank',
							'title'  => $social_type['label']
						) );
						echo sprintf( '<li>%s</li>', $icon );
					}
				endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="__member-info">
		<div class="__member-info-inner">
			<?php
			//Name
			if ( ! empty( $member_name ) ) {
				if ( ! empty( $member_url['url'] ) ) {
					$member_name = Floral_Wrap::link( esc_html( $member_name ), $member_url['url'], array(
						'target' => $member_url['target'],
						'title'  => $member_url['title']
					) );
				}
				echo sprintf( '<h3 class="__name">%s</h3>', $member_name );
			}
			// Role
			if ( ! empty( $member_role ) ) {
				echo sprintf( '<h4 class="__role">%s</h4>', esc_html( $member_role ) );
			}
			//des
			if ( ! empty( $member_description ) ) {
				if ( @preg_match( '/^#E\-8_/', $member_description ) ) {
					$member_description = @preg_replace( '/^#E\-8_/', '', $member_description );
					$member_description = urldecode( base64_decode( $member_description ) );
				}
				echo sprintf( '<div class="__description">%s</div>', $member_description );
			}
			
			//Soc
			if ( empty( $member_avatar ) && ! empty( $member_socials ) ): ?>
				<ul class="__social-list social-profiles list-unstyled">
					<?php foreach ( $member_socials as $social ):
						$social_type = ( isset( $social['social_type'] ) && isset( $social_list[ $social['social_type'] ] ) ) ? $social_list[ $social['social_type'] ] : false;
						$social_url  = ( isset( $social['social_url'] ) ) ? $social['social_url'] : '';
						if ( $social_type ) {
							$icon = '<i class="' . $social_type['icon'] . '"></i>';
							$icon = Floral_Wrap::link( $icon, esc_url( $social_url ), array(
								'target' => '_blank',
								'title'  => $social_type['label']
							) );
							echo sprintf( '<li>%s</li>', $icon );
						}
					endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</div>