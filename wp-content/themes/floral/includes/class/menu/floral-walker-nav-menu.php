<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-walker-nav-menu.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * What the class handles.
     *
     * @see   Walker::$tree_type
     * @since 3.0.0
     * @var string
     */
    public $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    
    /**
     * Database fields to use.
     *
     * @see   Walker::$db_fields
     * @since 3.0.0
     * @todo  Decouple this.
     * @var array
     */
    public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    
    /**
     * Starts the list before the elements are added.
     *
     * @see   Walker::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        //============== W9 Custom ===============
        $background_code = '';
        if ( isset( $args->submenu_bg_img ) ) {
            $background_code = 'style="background-image: url(\' ' . $args->submenu_bg_img . ' \') "';
            unset( $args->submenu_bg_img );
        }
        $output .= "\n$indent<ul class=\"sub-menu\" " . $background_code . ">\n";
        //============== End W9 Custom ===============
    }
    
    /**
     * Ends the list of after the elements are added.
     *
     * @see   Walker::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "$indent</ul>\n";
    }
    
    /**
     * Start the element output.
     *
     * @see   Walker::start_el()
     *
     * @since 3.0.0
     * @since 4.4.0 'nav_menu_item_args' filter was added.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        
        $args = (object) $args;
        
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        //============== W9 Custom ===============
        //Mega menu or tree menu
        $menu_item_icon                 = $item->menu_item_icon;
        $submenu_mega                   = $item->submenu_mega;
        $submenu_bg_img                 = $item->submenu_bg_img;
        $submenu_number_column          = $item->submenu_number_column;
        $submenu_position               = $item->submenu_position;
        $submenu_content_template       = $item->submenu_content_template;
        $submenu_content_template_exist = ( $submenu_content_template != 'none' && !empty( $submenu_content_template ) );
        $menu_item_href_surfix          = $item->menu_item_href_surfix;
    
        if ( $submenu_content_template_exist ) {
            $classes[] = 'floral-menu-item-include-content-template';
        }
        
        if(!empty($menu_item_href_surfix)){
            $item->url .=  $item->menu_item_href_surfix;
        }
        
        if ( array_search( 'menu-item-has-children', $classes ) && $depth == 0 ) {
            if ( $submenu_mega == 'on' ) {
                $classes[] = 'floral-mega-menu';
                $classes[] = sprintf( 'floral-mega-%s-col', $submenu_number_column );
                
            } else {
                $classes[] = 'floral-tree-menu';
                $classes[] = sprintf( 'floral-tree-%s-col', $submenu_number_column );
                
            }
        }
        
        // Submenu Float
        if ( !empty( $submenu_position ) ) {
            $classes[] = $submenu_position;
        }
        
        if ( !empty( $submenu_bg_img ) ) {
            $args->submenu_bg_img = $submenu_bg_img;
        }
        
        //============== End W9 Custom============
        
        /**
         * Filter the arguments for a single nav menu item.
         *
         * @since 4.4.0
         *
         * @param array  $args  An array of arguments.
         * @param object $item  Menu item data object.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
        
        /**
         * Filter the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        /**
         * Filter the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names . '>';
        
        $atts           = array();
        $atts['title']  = !empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = !empty( $item->target ) ? $item->target : '';
        $atts['rel']    = !empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = !empty( $item->url ) ? $item->url : '';
        
        /**
         * Filter the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array  $atts   {
         *                       The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         * @type string  $title  Title attribute.
         * @type string  $target Target attribute.
         * @type string  $rel    The rel attribute.
         * @type string  $href   The href attribute.
         * }
         *
         * @param object $item   The current menu item.
         * @param array  $args   An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth  Depth of menu item. Used for padding.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
        
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( !empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        //============== W9 Custom ===============
        if ( !empty( $menu_item_icon ) ) {
            $title = '<i class="floral-menu-icon ' . $menu_item_icon . '" ></i>' . $title;
        }
        //============== End W9 Custom ===============
        
        /**
         * Filter a menu item's title.
         *
         * @since 4.4.0
         *
         * @param string $title The menu item's title.
         * @param object $item  The current menu item.
         * @param array  $args  An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        if ( $this->has_children ) {
            if ( $depth < 1 ) {
                $item_output .= '<span class="w9 w9-ico-down-open-big floral-parent-caret"></span>';
            } else {
                $item_output .= '<span class="w9 w9-ico-right-open-big floral-parent-caret"></span>';
            }
        }
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item        Menu item data object.
         * @param int    $depth       Depth of menu item. Used for padding.
         * @param array  $args        An array of {@see wp_nav_menu()} arguments.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        
        
        //============== W9 Custom ===============
        //Print content template
        if ( $submenu_content_template_exist ) {
            $content_template_html = sprintf( '<div class="floral-menu-content-template-wrapper sub-menu">%s</div>', floral_get_post_content_by_name( $submenu_content_template, 'content-template' ) );
            $output .= $content_template_html;
        }
        //============== End W9 Custom ===============
        
    }
    
    /**
     * Ends the element output, if needed.
     *
     * @see   Walker::end_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Page data object. Not used.
     * @param int    $depth  Depth of page. Not Used.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
    
}