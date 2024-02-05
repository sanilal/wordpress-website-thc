<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-download.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_Widget_Download extends Floral_Widget_Base {
	/**
	 * Floral_Widget_Download constructor.
	 */
	public function __construct() {
		$args = array(
			'id'      => 'floral-widget-download',
			'name'    => esc_html__( 'Floral Download', 'w9-floral-addon' ),
			'options' => array(
				'classname'   => 'floral-widget-download',
				'description' => esc_html__( 'Widget to get a link to download.', 'w9-floral-addon' )
			),
			'fields'  => array(
				array(
					'id'      => 'title',
					'type'    => 'text',
					'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
					'default' => ''
				),
				array(
					'id'    => 'file',
					'type'  => 'file-selector',
					'title' => esc_html__( 'Select File', 'w9-floral-addon' ),
				),
				
				array(
					'id'      => 'display_text',
					'type'    => 'text',
					'title'   => esc_html__( 'Display Text', 'w9-floral-addon' ),
					'default' => __( 'DOWNLOAD', 'w9-floral-addon' )
				),
				
				array(
					'id'      => 'file_type',
					'type'    => 'select',
					'title'   => esc_html__( 'File Type', 'w9-floral-addon' ),
					'options' => array(
						'DOC'    => esc_html__( 'DOC', 'w9-floral-addon' ),
						'XLS'    => esc_html__( 'XLS', 'w9-floral-addon' ),
						'PDF'    => esc_html__( 'PDF', 'w9-floral-addon' ),
						'PPT'    => esc_html__( 'PPT', 'w9-floral-addon' ),
						'custom' => esc_html__( 'Custom', 'w9-floral-addon' ),
					),
					'default' => 'DOC'
				),
			)
		
		);
		parent::__construct( $args );
	}
	
	public function widget_content( $args, $instance ) {
		$file = $display_text = $file_type = '';
		extract( $instance, EXTR_IF_EXISTS );
		if ( empty( $file ) ) {
			return;
		}
		
		$icon = '';
		
		switch ( $file_type ) {
			case 'DOC':
				$icon = 'floral-ico floral-ico-doc2';
				break;
			case 'XLS':
				$icon = 'fa fa-file-excel-o';
				break;
			case 'PDF':
				$icon = 'floral-ico floral-ico-pdf19';
				break;
			case 'PPT':
				$icon = 'floral-ico floral-ico-ppt';
				break;
			default:
				$icon = 'floral-ico floral-ico-document';
		}
		
		$display_text = ( ! empty( $display_text ) ) ? $display_text : __( 'DOWNLOAD', 'w9-floral-addon' );
		
		$this->the_widget_title( $args, $instance );
		ob_start();
		?>
		
		<div class="floral-download">
			<a target="_blank" href="<?php echo esc_url( $file ); ?>" class="__inner">
				<div class="__icon">
					<i class="<?php echo esc_attr( $icon ); ?>"></i>
				</div>
				<div class="__text">
					<?php echo esc_html( $display_text ); ?>
				</div>
			</a>
		</div>
		<?php
		echo ob_get_clean();
	}
}
