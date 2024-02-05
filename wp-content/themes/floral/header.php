<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package floral
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js flexbox">
	<head>
		<?php wp_head(); ?>
		
	</head>

	<body <?php body_class(); ?>>
		<?php
		/**
		 * @hook: Hook something here!
		 *
		 */
		do_action('floral_page_wrapper_before');
		?>

		<div id="page-wrapper" class="page-wrapper">
			<?php
			/**
			 * @hook: Hook something here!
			 *
			 */
			do_action('floral_page_before');
			?>
	
			<div id="page" class="site">
				<?php
				/**
				 * @hook: header-template!
				 */
				do_action('floral_page_content_before');
	
				?>
	
				<div id="content" class="site-content">
	
					<?php
					/**
					 * @hook: Hook something here!
					 */
					do_action('floral_page_content_inner_begin');
					?>