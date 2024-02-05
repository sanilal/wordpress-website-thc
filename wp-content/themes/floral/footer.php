<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package floral
 */

?>
					<?php
					/**
					 * @hook: Hook something here!
					 */
					do_action('floral_page_content_inner_end');
					?>
	
				</div><!-- #content -->
				<?php
				/**
				 * @hook: Hook something here!
				 */
				do_action('floral_page_content_after');
				?>
	
			</div><!-- #page -->
			<?php
			/**
			 * @hook: Hook something here!
			 *
			 */
		do_action('floral_page_after');
			?>

		</div><!-- #page wrapper -->
		<?php
		/**
		 * @hook: Hook something here!
		 *
		 */
		do_action('floral_page_wrapper_after');
		?>
		<?php wp_footer(); ?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script>
		
        	$(document).ready(function() {
				
					$('.floral-shortcode-logo img').attr('src','http://smebusinessapp.com/thc/wp-content/uploads/2018/11/logo.png');
				

                });

        </script>-->
	</body>
</html>
<!-- Look so cool, right? -->