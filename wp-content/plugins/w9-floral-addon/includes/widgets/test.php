<?php
///**
// * Created by PhpStorm.
// * User: Life
// * Date: 7/25/2016
// * Time: 6:07 PM
// */
//
//$icon_lib     = array(
//    '9wpthemes'    => '9WPThemes',
//    'floral'       => 'Floral',
//    'font-awesome' => 'Font Awesome',
//);
//$iconpickerid = $field . '-icon-picker';
//$input        = '<div class="floral-icon-picker" id="' . $iconpickerid . '">';
//$input .= '<input class="picker-input" type="hidden" name="' . $field . '" id="' . $field . '" value="' . $value . '" />';
//$input .= '<span class="picker-preview"><i class="' . $value . '"></i></span>';
//$input .= '<select class="floral-icon-picker-lib" id="' . $field . '-icon-lib" name="' . $field . '-icon-lib"' . '>';
//if ( preg_match( '/^w9 w9-ico-/', $value ) == 1 ) {
//    $current_icon_lib = '9wpthemes';
//} elseif ( preg_match( '/^ico floral-ico-/', $value ) == 1 ) {
//    $current_icon_lib = 'floral';
//} elseif ( preg_match( '/^fa fa-/', $value ) == 1 ) {
//    $current_icon_lib = 'font-awesome';
//}
//foreach ( $icon_lib as $key => $option ) {
//    $selected = ( $key == $current_icon_lib ) ? 'selected' : '';
//    $input .= '<option value="' . esc_attr( $key ) . '" ' . $selected . '>' . esc_attr( $option ) . '</option>';
//}
//$input .= '</select>';
//$input .= '<button type="button" class="button-secondary picker-pick">' . __( 'Choose Icon', 'floral' ) . ' </button>';
//$input .= '<button type="button" class="button-secondary picker-remove">' . __( 'Remove Icon', 'floral' ) . ' </button>';
//$input .= '</div>';
//$input .= '<script>floral_admin.icon_picker("#' . $iconpickerid . '");</script>';
//
////------------------------------------
//$iconpicker_lib = array(
//    '9wpthemes'    => '9WPThemes',
//    'floral'       => 'Floral',
//    'font-awesome' => 'Font Awesome',
//);
//
//
//$iconpicker_id = 'widget-field-icon-picker' . uniqid();
//?>
<!---->
<!--<div class="floral-icon-picker" id="--><?php //echo $iconpicker_id; ?><!--">-->
<!--    <label for="--><?php //echo esc_attr( $this->get_field_id( $id ) ); ?><!--">--><?php //echo esc_html( $field['title'] ); ?><!-- </label>-->
<!--    <input class="picker-input" type="hidden"-->
<!--           name="--><?php //echo esc_attr( $this->get_field_name( $id ) ); ?><!--"-->
<!--           id="--><?php //echo esc_attr( $this->get_field_id( $id ) ); ?><!--"-->
<!--           value="--><?php //echo esc_attr( $value ); ?><!--" />-->
<!--    <span class="picker-preview"><i class="--><?php //echo esc_attr( $value ); ?><!--"></i></span>-->
<!--    <select class="floral-icon-picker-lib">-->
<!--        --><?php //foreach ( $iconpicker_lib as $key => $option ) :
//
//            if ( preg_match( '/^w9 w9-ico-/', $value ) == 1 ) {
//                $current_icon_lib = '9wpthemes';
//            } elseif ( preg_match( '/^ico floral-ico-/', $value ) == 1 ) {
//                $current_icon_lib = 'floral';
//            } elseif ( preg_match( '/^fa fa-/', $value ) == 1 ) {
//                $current_icon_lib = 'font-awesome';
//            }
//            $selected = ( $key == $current_icon_lib ) ? 'selected' : '';
//            ?>
<!---->
<!--            <option value="--><?php //echo esc_attr( $key ); ?><!--" --><?php //echo $selected; ?><!-->--><?php //echo esc_html( $option ); ?><!--</option>-->
<!--        --><?php //endforeach; ?>
<!--    </select>-->
<!--    <button type="button" class="button-secondary picker-pick">' . __( 'Choose Icon', 'floral' ) . '</button>-->
<!--    <button type="button" class="button-secondary picker-remove">' . __( 'Remove Icon', 'floral' ) . '</button>-->
<!--</div>-->
<!--<script>floral_admin.icon_picker("#' . $iconpickerid . '");</script>-->
<div class="__content-inner">
	<div class="__name p-color s-font"><a>Christina Hilton</a></div>
	<div class="__text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.</div>
</div>

<div class="__comment">Lorem ipsum dolor sit amet, consectetur adipiscing elit, se ut labore et dolore magna aliqua. Ut enim ad minim exercitat ullamco laboris nisi ut. On the other hand, we denounce with righteous indignation and dislikemen who are so beguiled and demoralized by the charms of...</div>
<div class="__name p-font"><a href="#">Christina Hilton</a></div>
<div class="__role s-font">Financial Adviser</div>

<style>

	.section-what-clients-say .__content-block-1 > div {
		padding-top:    80px;
		padding-bottom: 100px;
	}

	.section-what-clients-say .__content-block-1 .__item {
		outline: none;
	}

	.section-what-clients-say .__slider-container-1 > div > .wpb_wrapper > *:not(.slick-list):not(.slick-arrow):not(.slick-dots),
	.section-what-clients-say .__slider-container-2 > *:not(.slick-list):not(.slick-arrow):not(.slick-dots) {
		display: none;
	}

	.section-what-clients-say .__content-block-2 {
		position: relative;
	}

	.section-what-clients-say .__content-block-2 > div {
		max-width:    600px;
		margin-left:  auto;
		margin-right: auto;
	}

	.section-what-clients-say .__slider-container-2 {
		padding-bottom: 80px;
		padding-top:    80px;
	}

	.section-what-clients-say .__slider-container-2 .slick-arrow {
		position:         absolute;
		top:              -35px;
		font-size:        0;
		width:            70px;
		height:           70px;
		background-color: rgba(255, 255, 255, 0.2);
		color:            #fff;
		border:           0;
	}

	.section-what-clients-say .__slider-container-2 .slick-arrow:before {
		display:     block;
		font-family: '9wpthemes';
		line-height: 70px;
		font-size:   30px;
	}

	.section-what-clients-say .__slider-container-2 .slick-prev {
		left: 15px;
	}

	.section-what-clients-say .__slider-container-2 .slick-prev:before {
		content:     "\e0ac";
		margin-left: -5px;
	}

	.section-what-clients-say .__slider-container-2 .slick-next {
		right: 15px;
	}

	.section-what-clients-say .__slider-container-2 .slick-next:before {
		content:      "\e0f9";
		margin-right: -5px;
	}

	.section-what-clients-say .__content-block-2 .__background-image {
		position: absolute;
		top:      0;
		width:    100%;
		left:     0;
		z-index:  1;
	}

	.section-what-clients-say .__content-block-2 .__accessory-icon {
		position:          absolute;
		top:               -40px;
		left:              50%;
		width:             80px;
		z-index:           5;
		-webkit-transform: translate(-50%, 0);
		-moz-transform:    translate(-50%, 0);
		-ms-transform:     translate(-50%, 0);
		-o-transform:      translate(-50%, 0);
		transform:         translate(-50%, 0);
	}

	.section-what-clients-say .__content-block-2 .__item {
		width:      206px;
		height:     350px;
		position:   relative;
		text-align: center;
		outline:    none;
	}

	.section-what-clients-say .__content-block-2 .__item > div {
		position:           absolute;
		opacity:            0.5;
		bottom:             0;
		left:               50%;
		-webkit-transform:  translateX(-50%);
		-moz-transform:     translateX(-50%);
		-ms-transform:      translateX(-50%);
		-o-transform:       translateX(-50%);
		transform:          translateX(-50%);
		width:              230px;
		margin-left:        0;
		margin-right:       0;
		-webkit-transition: opacity 0.3s ease-out, width 0.3s ease-out;
		-o-transition:      opacity 0.3s ease-out, width 0.3s ease-out;
		transition:         opacity 0.3s ease-out, width 0.3s ease-out;
		padding-left:       0;
		padding-right:      0;
	}

	.section-what-clients-say .__content-block-2 .__item.slick-center > div {
		opacity: 1;
	}

	.section-what-clients-say .__content-block-2 .__item .__avatar {
		margin-left:        auto;
		margin-right:       auto;
		width:              150px;
		-webkit-transition: width 0.3s ease-out;
		-o-transition:      width 0.3s ease-out;
		transition:         width 0.3s ease-out;
		margin-bottom:      20px;
	}

	.section-what-clients-say .__content-block-2 .__item.slick-center .__avatar {
		margin-bottom: 20px;
		width:         100%;
	}

	.section-what-clients-say .__content-block-2 .__item .__name {
		font-size:      18px;
		font-weight:    600;
		text-transform: uppercase;
		margin-bottom:  5px;
		line-height:    1.2;
		color:          #fff;
	}

	.section-what-clients-say .__content-block-2 .__item .__role {
		margin-bottom: 20px;
		font-style:    italic;
		color:         #999;
		line-height:   1.2;
	}

	.section-what-clients-say .__content-block-2 .__item:not(.slick-center) .__name,
	.section-what-clients-say .__content-block-2 .__item:not(.slick-center) .__role,
	.section-what-clients-say .__content-block-2 .__item:not(.slick-center) .__rating {
		overflow:      hidden;
		max-height:    0;
		margin-bottom: 0;
	}

	.section-what-clients-say .__content-block-2 .__item:not(.slick-center) .__avatar {
		margin-bottom: 0;
		cursor:        pointer;
	}

	@media (min-width: 1200px) {
		.section-what-clients-say .__content-block-1 {
			width: 55%;
			left:  45%;
		}

		.section-what-clients-say .__content-block-1 > div {
			padding-top:    150px;
			padding-bottom: 135px;
		}

		.section-what-clients-say .__content-block-2 {
			width:          45%;
			right:          55%;
			padding-bottom: 20px;
		}

		.section-what-clients-say .__content-block-2 .__accessory-icon {
			top:               50%;
			left:              auto;
			right:             -40px;
			-webkit-transform: translate(0, -50%);
			-moz-transform:    translate(0, -50%);
			-ms-transform:     translate(0, -50%);
			-o-transform:      translate(0, -50%);
			transform:         translate(0, -50%);
		}
	}


</style>


<style>
	.section-what-clients-say .__content-block-2 {
		position: relative;
	}

	.section-what-clients-say .__slider-container-1 > *:not(.slick-list):not(.slick-arrow):not(.slick-dots),
	.section-what-clients-say .__slider-container-2 > div > .wpb_wrapper > *:not(.slick-list):not(.slick-arrow):not(.slick-dots) {
		display: none;
	}

	.section-what-clients-say .__content-block-1 > div {
		max-width:    600px;
		margin-left:  auto;
		margin-right: auto;
	}

	.section-what-clients-say .__content-block-1 .__background-image {
		position: absolute;
		top:      0;
		width:    100%;
		left:     0;
	}

	.section-what-clients-say .__content-block-1 .__item {
		width:      206px;
		height:     350px;
		position:   relative;
		text-align: center;
		outline:    none;
	}

	.section-what-clients-say .__content-block-1 .__item > div {
		position:           absolute;
		opacity:            0.5;
		bottom:             0;
		left:               50%;
		-webkit-transform:  translateX(-50%);
		-moz-transform:     translateX(-50%);
		-ms-transform:      translateX(-50%);
		-o-transform:       translateX(-50%);
		transform:          translateX(-50%);
		width:              150px;
		margin-left:        0;
		margin-right:       0;
		-webkit-transition: opacity 0.3s ease-out, width 0.3s ease-out;
		-o-transition:      opacity 0.3s ease-out, width 0.3s ease-out;
		transition:         opacity 0.3s ease-out, width 0.3s ease-out;
		padding-left:       0;
		padding-right:      0;
	}

	.section-what-clients-say .__content-block-1 .__item.slick-center > div {
		opacity: 1;
		width:   230px;
	}

	.section-what-clients-say .__content-block-1 .__item .__avatar {
		margin-bottom: 20px;
	}

	.section-what-clients-say .__content-block-1 .__item .__name {
		font-size:      18px;
		font-weight:    600;
		text-transform: uppercase;
		margin-bottom:  5px;
		line-height:    1.2;
		color:          #fff;
	}

	.section-what-clients-say .__content-block-1 .__item .__role {
		margin-bottom: 20px;
		font-style:    italic;
		color:         #999;
		line-height:   1.2;
	}

	.section-what-clients-say .__content-block-1 .__item:not(.slick-center) .__name,
	.section-what-clients-say .__content-block-1 .__item:not(.slick-center) .__role,
	.section-what-clients-say .__content-block-1 .__item:not(.slick-center) .__rating {
		overflow:      hidden;
		max-height:    0;
		margin-bottom: 0;
	}

	.section-what-clients-say .__content-block-1 .__item:not(.slick-center) .__avatar {
		margin-bottom: 0;
		cursor:        pointer;
	}


</style>

<style>
	.section-our-services .__content-block-3 {
		width: 45%;
	}

	.section-our-services .__content-block-3 .__accessory-image {
		position: absolute;
	}


</style>


<script type="text/javascript">
	(function ($, window) {
		'use strict';
		$(document).ready(function () {
			console.log('wtf');
			var $container = $("#what-clients-say"),
				$slider_1 = $('.__slider-container-1 > div > .wpb_wrapper', $container),
				$slider_2 = $('.__slider-container-2', $container);
			$slider_1.on("init", function (event, slick) {
				$(this).children().show();
			}).slick({
				arrows        : false,
				infinite      : true,
				fade          : true,
				autoplaySpeed : 15000,
				slidesToShow  : 1,
				slidesToScroll: 1,
				asNavFor      : $slider_2
			});

			$slider_2.on("init", function (event, slick) {
				$(this).children().show();
			}).slick({
				arrows        : false,
				infinite      : true,
				autoplaySpeed : 15000,
				slidesToShow  : 1,
				slidesToScroll: 1,
				variableWidth : true,
				centerMode    : true,
				focusOnSelect : true,
				asNavFor      : $slider_1,
				responsive    : [
					{
						breakpoint: 600,
						settings  : {
							arrows: true
						}
					}
				]
			});
		});
	})(jQuery, window);
</script>


<div class="floral-iconbox-item">
	<div class="__content">
		<div class="__icon p-color">
			<!-- Note: you can use font awesome (http://fontawesome.io/icons/) to change the icon below. for example: <i class="fa fa-bug"></i>		-->
			<i class="flor-ico flor-ico-medical"></i>
		</div>
		<div class="__title s-font">SPA THERAPY</div>
		<div class="__text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</div>
	</div>
	<div class="__overlay overlay-object">
		<div class="__inner"></div>
	</div>
</div>

<style>
	.section-our-services .__content-block-1 .__background-image {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
	}
	.section-our-services .__content-block-1 .__content {
		position: relative;
	}
	.section-our-services .floral-iconbox-item {
		text-align:     center;
		max-width:      350px;
		margin-left:    auto;
		margin-right:   auto;
		padding-top:    75px;
		padding-bottom: 90px;
	}

	.section-our-services .floral-iconbox-item .__icon {
		width:         120px;
		height:        120px;
		border-radius: 100%;
		border:        2px solid;
		font-size:     60px;
		margin-left:   auto;
		margin-right:  auto;
		margin-bottom: 25px;
	}

	.section-our-services .floral-iconbox-item .__icon i:before {
		display:     block;
		line-height: 116px;
	}

	.section-our-services .floral-iconbox-item .__title {
		font-size:      20px;
		letter-spacing: 0.1em;
		color:          #000;
		text-transform: uppercase;
		line-height:    1.2;
		margin-bottom:  10px;
	}

	.section-our-services .floral-iconbox-item .__text {
		letter-spacing: 0.05em;
	}

	.section-our-services .floral-iconbox-item-wrapper .__button {
		position:          absolute;
		left:              0;
		top:               50%;
		-webkit-transform: translateY(-50%);
		-moz-transform:    translateY(-50%);
		-ms-transform:     translateY(-50%);
		-o-transform:      translateY(-50%);
		transform:         translateY(-50%);
		width:             100%;
		z-index: 20;
	}

	.section-our-services .floral-iconbox-item-wrapper .__button > a {
		opacity: 0;
	}

	.section-our-services .floral-iconbox-item .__overlay {
		z-index:    10;
		padding:    45px;
		opacity:    0;
		transition: all 0.3s ease-out;
	}

	.section-our-services .floral-iconbox-item .__overlay .__inner {
		width:  100%;
		height: 100%;
	}

	.section-our-services .floral-iconbox-item.style-even .__overlay .__inner {
		background-color: #eee;
	}

	.section-our-services .floral-iconbox-item.style-odd .__overlay .__inner {
		background-color: #fff;
	}

	.section-our-services .floral-iconbox-item-wrapper:hover .__button > a {
		opacity: 1;
	}

	.section-our-services .floral-iconbox-item-wrapper:hover .__overlay {
		opacity: 0.7;
	}
	@media (min-width: 1600px) {
		.section-our-services .__content-block-1 {
			width: 45%;
		}
	
		.section-our-services .__content-block-2 {
			width: 55%;
		}
	}
</style>