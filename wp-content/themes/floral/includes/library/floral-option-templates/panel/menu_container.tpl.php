<?php
/**
 * The template for the menu container of the panel.
 *
 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
 *
 * @author     Redux Framework
 * @package    ReduxFramework/Templates
 * @version    :    3.5.4
 */

?>


<div class="redux-sidebar">
	<?php if ( ! empty( $this->parent->args['display_name'] ) ) { ?>
		<div class="display_header">
			<div class="__content">
				<img class="__logo" alt="logo" <?php echo 'src="' . floral_theme_url() . 'assets/images/logo-9w.png' . '"'; ?> />
				<div class="theme-name"><?php echo wp_kses_post( $this->parent->args['display_name'] ); ?></div>
				
				<?php if ( ! empty( $this->parent->args['display_version'] ) ) { ?>
					<div class="theme-version"><?php echo wp_kses_post( $this->parent->args['display_version'] ); ?></div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	<ul class="redux-group-menu">
		<?php
		foreach ( $this->parent->sections as $k => $section ) {
			$title = isset ( $section['title'] ) ? $section['title'] : '';
			
			$skip_sec = false;
			foreach ( $this->parent->hidden_perm_sections as $num => $section_title ) {
				if ( $section_title == $title ) {
					$skip_sec = true;
				}
			}
			
			if ( isset ( $section['customizer_only'] ) && $section['customizer_only'] == true ) {
				continue;
			}
			
			if ( false == $skip_sec ) {
				echo sprintf( '%s', $this->parent->section_menu( $k, $section ) );
				$skip_sec = false;
			}
		}
		
		/**
		 * action 'redux-page-after-sections-menu-{opt_name}'
		 *
		 * @param object $this ReduxFramework
		 */
		do_action( "redux-page-after-sections-menu-{$this->parent->args[ 'opt_name' ]}", $this );
		
		/**
		 * action 'redux/page/{opt_name}/menu/after'
		 *
		 * @param object $this ReduxFramework
		 */
		do_action( "redux/page/{$this->parent->args[ 'opt_name' ]}/menu/after", $this );
		?>
	</ul>
</div>