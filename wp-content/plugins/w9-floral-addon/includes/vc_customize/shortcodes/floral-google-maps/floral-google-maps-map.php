<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-google-maps-map.php
 * @time    : 8/26/2016 12:39 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
vc_map( array(
    'name'           => __( 'Floral Google Maps', 'w9-floral-addon' ),
    'base'           => Floral_SC_Google_Maps::SC_BASE,
    'icon'           => 'w9 w9-ico-basic-map',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'php_class_name' => 'Floral_SC_Google_Maps',
    'description'    => __( 'Customize the google map.', 'w9-floral-addon' ),
    'params'         => array(
//        array(
//            'type'        => 'textfield',
//            'heading'     => __( 'Google map API key', 'w9-floral-addon' ),
//            'description' => __( 'Enter your google map api key.', 'w9-floral-addon' ),
//            'param_name'  => 'api_key',
//            'std'         => ''
//        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Map position (latitude, longitude)', 'w9-floral-addon' ),
            'param_name'  => 'map_position',
            'description' => sprintf( __( 'Enter map position with latitude and longitude (etc: 41.40338, 2.17403). %s' ), '<a target="_blank" href="https://support.google.com/maps/answer/18539">' . __( 'How do i get it?' ) . '</a>' ),
            'std'         => '41.40338, 2.17403',
            'admin_label' => true
        ),
//        array(
//            'type'       => 'switcher',
//            'heading'    => __( 'Create marker on map position', 'w9-floral-addon' ),
//            'param_name' => 'marker_on_map_position',
//            'std'        => '1'
//        ),
//
//        array(
//            'type'        => 'textfield',
//            'heading'     => __( 'Marker title', 'w9-floral-addon' ),
//            'description' => __( 'Enter the title for marker at map position.', 'w9-floral-addon' ),
//            'param_name'  => 'map_marker_title',
//            'std'         => '',
//            'dependency'  => array(
//                'element' => 'marker_on_map_position',
//                'value'   => '1'
//            )
//        ),

        array(
            'type'        => 'textfield',
            'heading'     => __( 'Map height', 'w9-floral-addon' ),
            'param_name'  => 'map_height',
            'description' => __( 'Enter height of the map in px, em, vh ... Default value is 500px.', 'w9-floral-addon' ),
            'std'         => '500px',
        ),

        array(
            'type'             => 'dropdown',
            'heading'          => __( 'Map type', 'w9-floral-addon' ),
            'param_name'       => 'map_type',
            'value'            => array(
                __( 'Default (Road Map)', 'w9-floral-addon' ) => 'roadmap',
                __( 'Satellite', 'w9-floral-addon' )          => 'satellite',
                __( 'Hybrid', 'w9-floral-addon' )             => 'hybrid',
                __( 'Terrain', 'w9-floral-addon' )            => 'terrain',
            ),
            'admin_label'      => true,
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),

        array(
            'type'             => 'dropdown',
            'heading'          => __( 'Map theme', 'w9-floral-addon' ),
            'param_name'       => 'map_theme',
            'value'            => array(
                __( 'Default', 'w9-floral-addon' )            => '',
                __( 'Ultra light', 'w9-floral-addon' )        => 'ultra_light',
                __( 'Unsaturated browns', 'w9-floral-addon' ) => 'unsaturated_browns',
                __( 'Light dream', 'w9-floral-addon' )        => 'light_dream',
                __( 'Blue water', 'w9-floral-addon' )         => 'blue_water',
                __( 'Paper', 'w9-floral-addon' )              => 'paper',
                __( 'Midnight commander', 'w9-floral-addon' ) => 'midnight_commander',
                __( 'Retro', 'w9-floral-addon' )              => 'retro',
                __( 'Cool grey', 'w9-floral-addon' )          => 'cool_grey',
                __( 'Neutral blue', 'w9-floral-addon' )       => 'neutral_blue',
                __( 'Custom Code', 'w9-floral-addon' )        => 'custom_code',
            ),
            'admin_label'      => true,
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),

        array(
            'type'        => 'textarea_raw_html',
            'heading'     => __( 'JSON style string', 'w9-floral-addon' ),
            'param_name'  => 'custom_style',
            'value'       => __( base64_encode( '[{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#333333"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#333333"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}]' ), 'w9-floral-addon' ),
            'description' => sprintf( __( 'Enter your google map json style code here. %s', 'w9-floral-addon' ), '<a href="https://snazzymaps.com/" target="_blank">' . __( 'Check out awesome google maps style from snazzymaps', 'w9-floral-addon' ) . '</a>' ),
            'dependency'  => array(
                'element' => 'map_theme',
                'value'   => 'custom_code'
            )
        ),


        array(
            'type'       => 'slider',
            'heading'    => __( 'Zoom level', 'w9-floral-addon' ),
            'param_name' => 'zoom_level',
            'unit'       => '',
            'min'        => '1',
            'max'        => '20',
            'step'       => '1',
            'std'        => '10'
        ),
        array(
            'type'             => 'switcher',
            'heading'          => __( 'Zoom on mouse wheel', 'w9-floral-addon' ),
            'param_name'       => 'zoom_on_mouse_wheel',
            'std'              => '1',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type'             => 'switcher',
            'heading'          => __( 'Draggable', 'w9-floral-addon' ),
            'param_name'       => 'draggable',
            'std'              => '1',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type'        => 'attach_image',
            'heading'     => __( 'Custom marker icon', 'w9-floral-addon' ),
            'param_name'  => 'custom_marker',
            'value'       => '',
            'description' => __( 'Select image from media library.', 'w9-floral-addon' )
        ),
        array(
            'type'        => 'param_group',
            'heading'     => __( 'Markers', 'w9-floral-addon' ),
            'param_name'  => 'markers',
            'description' => __( 'Create markers on the map.', 'w9-floral-addon' ),
            'params'      => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Marker position (latitude, longitude)', 'w9-floral-addon' ),
                    'param_name'  => 'marker_position',
                    'description' => sprintf( __( 'Enter marker position with latitude and longitude (etd: 41.40338, 2.17403)' , 'w9-floral-addon' ) . '%s', '<a target="_blank" href="https://support.google.com/maps/answer/18539">' . __( 'How do i get it?' , 'w9-floral-addon' ) . '</a>' ),
                    'std'         => '',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Title', 'w9-floral-addon' ),
                    'param_name'  => 'marker_title',
                    'description' => __( 'Enter marker title.' , 'w9-floral-addon' ),
                    'std'         => ''
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Animation', 'w9-floral-addon' ),
                    'param_name' => 'marker_animation',
                    'value'      => array(
                        __( 'None', 'w9-floral-addon' )   => '',
                        __( 'Drop', 'w9-floral-addon' )   => 'drop',
                        __( 'Bounce', 'w9-floral-addon' ) => 'bounce',
                    )
                )
            )
        ),
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    )
) );