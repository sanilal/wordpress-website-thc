<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-general-page-transitions.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'      => esc_html__( 'Transitions', 'floral' ),
    'desc'       => '',
    'icon'       => 'fa fa-spinner fa-spin',
    'subsection' => true,
    'fields'     => array(

        array(
            'id'       => 'loading-transitions',
            'type'     => 'switch',
            'title'    => esc_html__( 'Page transitions', 'floral' ),
            'subtitle' => esc_html__( 'Enable/disable page transitions.', 'floral' ),
            'desc'     => '',
            'default'  => 0
        ),
        array(
            'id'       => 'transition-random-number-1',
            'type'     => 'info',
            'desc'     => esc_html__( 'Loading logo.', 'floral' ),
            'required' => array( 'loading-transitions', '!=', array( '0' ) ),
        ),
        array(
            'id'       => 'loading-logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Loading logo', 'floral' ),
            'subtitle' => esc_html__( 'Upload loading logo.', 'floral' ),
            'required' => array( 'loading-transitions', '!=', array( '0' ) ),
        ),
        //loading text
        array(
            'id'       => 'transition-random-number-2',
            'type'     => 'info',
            'desc'     => esc_html__( 'Loading text.', 'floral' ),
            'required' => array( 'loading-transitions', '!=', array( '0' ) ),
        ),
        array(
            'id'       => 'loading-text',
            'type'     => 'text',
            'title'    => esc_html__( 'Loading text', 'floral' ),
            'subtitle' => esc_html__( 'Use a loading text.', 'floral' ),
            'desc'     => '',
            'required' => array( 'loading-transitions', '!=', array( '0' ) ),
        ),
        array(
            'id'          => 'loading-text-typo',
            'type'        => 'typography',
            'title'       => esc_html__( 'Loading text typography', 'floral' ),
            'google'      => true,
            'font-backup' => false,
            'output'      => array( 'h3.loading-text' ),
            'units'       => 'px',
            'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'floral' ),
            'default'     => array(),
            'required'    => array( 'loading-transitions', '!=', array( '0' ) ),
        ),

        //Loading Animation
        array(
            'id'       => 'transition-random-number-3',
            'type'     => 'info',
            'desc'     => esc_html__( 'Loading animations.', 'floral' ),
            'required' => array( 'loading-transitions', '!=', array( '0' ) ),
        ),
        array(
            'id'       => 'loading-animation-bg-color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Loading background color', 'floral' ),
            'subtitle' => esc_html__( 'Set loading background color.', 'floral' ),
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => 1,
                'rgba'  => 'rgba(255, 255, 255, 1)'
            ),
            'output'   => array( 'background-color' => '.floral-page-transitions-wrapper, .floral-page-transitions' ),
            'validate' => 'colorrgba',
            'required' => array( 'loading-transitions', '!=', array( '0' ) ),
        ),

        array(
            'id'       => 'loading-animation',
            'type'     => 'select',
            'title'    => esc_html__( 'Loading animation', 'floral' ),
            'subtitle' => esc_html__( 'Choose type of preload animation.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'none'          => esc_html__( 'No animation', 'floral' ),
                'rotating'      => esc_html__( 'Rotating Plane', 'floral' ),
                'double-bounce' => esc_html__( 'Double Bounce', 'floral' ),
                'wave'          => esc_html__( 'Wave', 'floral' ),
                'cube'          => esc_html__( 'Wandering Cube', 'floral' ),
                'pulse'         => esc_html__( 'Pulse', 'floral' ),
                'chasing-dots'  => esc_html__( 'Chasing Dots', 'floral' ),
                'three-bounce'  => esc_html__( 'Three Bounce', 'floral' ),
                'circle'        => esc_html__( 'Circle', 'floral' ),
                'folding-cube'  => esc_html__( 'Cube Grid', 'floral' ),
                'fading-circle' => esc_html__( 'Fading Circle', 'floral' ),
            ),
            'default'  => 'none',
            'required' => array( 'loading-transitions', '!=', array( '0' ) ),
        ),

        //Spinner Color
        array(
            'id'       => 'spinner-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Spinner color', 'floral' ),
            'subtitle' => esc_html__( 'Pick a spinner color.', 'floral' ),
            'default'  => '',
            'validate' => 'color',
            'output'   => array( 'background-color' => '.sk-spinner-pulse,.sk-rotating-plane,.sk-double-bounce .sk-child,.sk-wave .sk-rect,.sk-chasing-dots .sk-child,.sk-three-bounce .sk-child,.sk-circle .sk-child:before,.sk-fading-circle .sk-circle:before,.sk-folding-cube .sk-cube:before, .circle-2, .circle-3, .circle-4, .circle-5, .circle-6' ),
            'required' => array( 'loading-animation', 'not_empty_and', array( 'none' ) ),
        ),
    )
);