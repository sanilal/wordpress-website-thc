<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-grids-common.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once vc_path_dir( 'CONFIG_DIR', 'grids/class-vc-grids-common.php' );

class Floral_Grids_Common extends VcGridsCommon {
    protected static $pagination_label;
    protected static $slider_label;
    protected static $pagination_dependency;
    
    /*
     * Change:
     * Add style slider
     * Extend condtion of pagination tab to slider
     * Extend defaut nav and dots style with theme addition style
     */
    protected static function initData() {
        
        self::$btn3Params = vc_map_integrate_shortcode( 'vc_btn', 'btn_', __( 'Load More Button', 'w9-floral-addon' ), array(
            'exclude' => array(
                'link',
                'css',
                'el_class',
                'css_animation',
            ),
        ), array(
            'element' => 'style',
            'value'   => array( 'load-more' ),
        ) );
        foreach ( self::$btn3Params as $key => $value ) {
            if ( 'btn_title' == $value['param_name'] ) {
                self::$btn3Params[$key]['value'] = __( 'Load more', 'w9-floral-addon' );
            } else {
                if ( 'btn_color' == $value['param_name'] ) {
                    self::$btn3Params[$key]['std'] = 'blue';
                } else {
                    if ( 'btn_style' == $value['param_name'] ) {
                        self::$btn3Params[$key]['std'] = 'flat';
                    }
                }
            }
        }
        
        // Grid column list
        self::$gridColsList = array(
            array(
                'label' => '6',
                'value' => 2,
            ),
            array(
                'label' => '4',
                'value' => 3,
            ),
            array(
                'label' => '3',
                'value' => 4,
            ),
            array(
                'label' => '2',
                'value' => 6,
            ),
            array(
                'label' => '1',
                'value' => 12,
            ),
        );
        
        self::$pagination_dependency = array(
            'element' => 'style',
            'value'   => array( 'pagination', 'slider' ),
        );
        self::$pagination_label      = __( 'Pagination', 'w9-floral-addon' );
        self::$slider_label          = __( 'Slider', 'w9-floral-addon' );
    }
    
    // Basic Grid Common Settings
    public static function getBasicAtts() {
        
        if ( self::$basicGrid ) {
            return self::$basicGrid;
        }
        
        if ( is_null( self::$btn3Params ) && is_null( self::$gridColsList ) ) {
            self::initData();
        }
        
        $postTypes         = get_post_types( array() );
        $postTypesList     = array();
        $excludedPostTypes = array(
            'revision',
            'nav_menu_item',
            'vc_grid_item',
        );
        if ( is_array( $postTypes ) && !empty( $postTypes ) ) {
            foreach ( $postTypes as $postType ) {
                if ( !in_array( $postType, $excludedPostTypes ) ) {
                    $label           = ucfirst( $postType );
                    $postTypesList[] = array(
                        $postType,
                        $label,
                    );
                }
            }
        }
        $postTypesList[] = array(
            'custom',
            __( 'Custom query', 'w9-floral-addon' ),
        );
        $postTypesList[] = array(
            'ids',
            __( 'List of IDs', 'w9-floral-addon' ),
        );
        
        $taxonomiesForFilter = array();
        
        if ( 'vc_edit_form' === vc_post_param( 'action' ) ) {
            $vcTaxonomiesTypes = vc_taxonomies_types();
            if ( is_array( $vcTaxonomiesTypes ) && !empty( $vcTaxonomiesTypes ) ) {
                foreach ( $vcTaxonomiesTypes as $t => $data ) {
                    if ( 'post_format' !== $t && is_object( $data ) ) {
                        $taxonomiesForFilter[$data->labels->name . ' (' . $t . ')'] = $t;
                    }
                }
            }
        }
//        echo '<pre>';
//        var_dump($postTypesList);
//        echo '</pre>';
        
        self::$basicGrid = array_merge( array(
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Data source', 'w9-floral-addon' ),
                'param_name'  => 'post_type',
                'value'       => $postTypesList,
                'save_always' => true,
                'description' => __( 'Select content type for your grid.', 'w9-floral-addon' ),
                'admin_label' => true,
            ),
            array(
                'type'        => 'autocomplete',
                'heading'     => __( 'Include only', 'w9-floral-addon' ),
                'param_name'  => 'include',
                'description' => __( 'Add posts, pages, etc. by title.', 'w9-floral-addon' ),
                'settings'    => array(
                    'multiple' => true,
                    'sortable' => true,
                    'groups'   => true,
                ),
                'dependency'  => array(
                    'element' => 'post_type',
                    'value'   => array( 'ids' ),
                ),
            ),
            // Custom query tab
            array(
                'type'        => 'textarea_safe',
                'heading'     => __( 'Custom query', 'w9-floral-addon' ),
                'param_name'  => 'custom_query',
                'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'post_type',
                    'value'   => array( 'custom' ),
                ),
            ),
            array(
                'type'               => 'autocomplete',
                'heading'            => __( 'Narrow data source', 'w9-floral-addon' ),
                'param_name'         => 'taxonomies',
                'settings'           => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    // In UI show results grouped by groups, default false
                    'unique_values'  => true,
                    // In UI show results except selected. NB! You should manually check values in backend, default false
                    'display_inline' => true,
                    // In UI show results inline view, default false (each value in own line)
                    'delay'          => 500,
                    // delay for search. default 500
                    'auto_focus'     => true,
                    // auto focus input, default true
                ),
                'param_holder_class' => 'vc_not-for-custom',
                'description'        => __( 'Enter categories, tags or custom taxonomies.', 'w9-floral-addon' ),
                'dependency'         => array(
                    'element'            => 'post_type',
                    'value_not_equal_to' => array(
                        'ids',
                        'custom',
                    ),
                ),
            ),
            array(
                'type'               => 'textfield',
                'heading'            => __( 'Total items', 'w9-floral-addon' ),
                'param_name'         => 'max_items',
                'value'              => 10,
                // default value
                'param_holder_class' => 'vc_not-for-custom',
                'description'        => __( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'w9-floral-addon' ),
                'dependency'         => array(
                    'element'            => 'post_type',
                    'value_not_equal_to' => array(
                        'ids',
                        'custom',
                    ),
                ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => __( 'Display style', 'w9-floral-addon' ),
                'param_name'       => 'style',
                'value'            => array(
                    __( 'Show all', 'w9-floral-addon' )         => 'all',
                    self::$slider_label                         => 'slider',
                    __( 'Load more button', 'w9-floral-addon' ) => 'load-more',
                    __( 'Lazy loading', 'w9-floral-addon' )     => 'lazy',
                    self::$pagination_label                     => 'pagination',
                ),
                'dependency'       => array(
                    'element'            => 'post_type',
                    'value_not_equal_to' => array( 'custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'description'      => __( 'Select display style for grid.', 'w9-floral-addon' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Items per page', 'w9-floral-addon' ),
                'param_name' => 'items_per_page',
                'description' => __( 'Number of items to show per page.', 'w9-floral-addon' ),
                'value' => '10',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'lazy',
                        'load-more',
                        'pagination',
                    ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Show filter', 'w9-floral-addon' ),
                'param_name'  => 'show_filter',
                'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
                'description' => __( 'Append filter to grid.', 'w9-floral-addon' ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => __( 'Grid elements per row', 'w9-floral-addon' ),
                'param_name'       => 'element_width',
                'value'            => self::$gridColsList,
                'std'              => '4',
                'edit_field_class' => 'vc_col-sm-6',
                'description'      => __( 'Select number of single grid elements per row.', 'w9-floral-addon' ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => __( 'Gap', 'w9-floral-addon' ),
                'param_name'       => 'gap',
                'value'            => array(
                    '0px'  => '0',
                    '1px'  => '1',
                    '2px'  => '2',
                    '3px'  => '3',
                    '4px'  => '4',
                    '5px'  => '5',
                    '10px' => '10',
                    '15px' => '15',
                    '20px' => '20',
                    '25px' => '25',
                    '30px' => '30',
                    '35px' => '35',
                ),
                'std'              => '30',
                'description'      => __( 'Select gap between grid elements.', 'w9-floral-addon' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'checkbox',
                'heading'          => __( 'Auto responsive', 'w9-floral-addon' ),
                'description'      => __( 'Sure that columns is not too tight in small screen.', 'w9-floral-addon' ),
                'param_name'       => 'element_auto_responsive',
                'value'            => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
                'dependency'       => array(
                    'element'            => 'style',
                    'value_not_equal_to' => array( 'slider' ),
                ),
            ),
            //Special Item
            //Create new special item
            array(
                'type'       => 'param_group',
                'heading'    => __( 'Special Item', 'w9-floral-addon' ),
                'param_name' => 'special_item',
                'value'      => '',
                'params'     => array(
                    array(
                        'type'        => 'number',
                        'heading'     => __( 'Index of special item', 'w9-floral-addon' ),
                        'param_name'  => 'index',
                        'description' => __( 'Index must be integer and greater than 0.', 'w9-floral-addon' ),
                        'admin_label' => true,
                        'std'         => 2,
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => __( 'Item width', 'w9-floral-addon' ),
                        'description' => __( 'Width of special item.', 'w9-floral-addon' ),
                        'param_name'  => 'element_width',
                        'value'       => array(
                            '1/12'  => 1,
                            '2/12'  => 2,
                            '3/12'  => 3,
                            '4/12'  => 4,
                            '5/12'  => 5,
                            '6/12'  => 6,
                            '7/12'  => 7,
                            '8/12'  => 8,
                            '9/12'  => 9,
                            '10/12' => 10,
                            '11/12' => 11,
                            '12/12' => 12,
                        ),
                        'admin_label' => true,
                        'std'         => 4
                    ),
                    array(
                        'type'        => 'vc_grid_item',
                        'heading'     => __( 'Grid element template', 'w9-floral-addon' ),
                        'param_name'  => 'item',
                        'description' => sprintf( __( '%sCreate new%s template or %smodify selected%s. Predefined templates will be cloned.', 'w9-floral-addon' ), '<a href="'
                            . esc_url( admin_url( 'post-new.php?post_type=vc_grid_item' ) )
                            . '" target="_blank">', '</a>', '<a href="#" target="_blank" data-vc-grid-item="edit_link">', '</a>' ),
                        'group'       => __( 'Item Design', 'w9-floral-addon' ),
                        'value'       => 'none',
                    ),
                ),
            ),
            
            // Data settings
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Order by', 'w9-floral-addon' ),
                'param_name'         => 'orderby',
                'value'              => array(
                    __( 'Date', 'w9-floral-addon' )                  => 'date',
                    __( 'Order by post ID', 'w9-floral-addon' )      => 'ID',
                    __( 'Author', 'w9-floral-addon' )                => 'author',
                    __( 'Title', 'w9-floral-addon' )                 => 'title',
                    __( 'Last modified date', 'w9-floral-addon' )    => 'modified',
                    __( 'Post/page parent ID', 'w9-floral-addon' )   => 'parent',
                    __( 'Number of comments', 'w9-floral-addon' )    => 'comment_count',
                    __( 'Menu order/Page Order', 'w9-floral-addon' ) => 'menu_order',
                    __( 'Meta value', 'w9-floral-addon' )            => 'meta_value',
                    __( 'Meta value number', 'w9-floral-addon' )     => 'meta_value_num',
                    __( 'Random order', 'w9-floral-addon' )          => 'rand',
                ),
                'description'        => __( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'w9-floral-addon' ),
                'group'              => __( 'Data Settings', 'w9-floral-addon' ),
                'param_holder_class' => 'vc_grid-data-type-not-ids',
                'dependency'         => array(
                    'element'            => 'post_type',
                    'value_not_equal_to' => array(
                        'ids',
                        'custom',
                    ),
                ),
            ),
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Sort order', 'w9-floral-addon' ),
                'param_name'         => 'order',
                'group'              => __( 'Data Settings', 'w9-floral-addon' ),
                'value'              => array(
                    __( 'Descending', 'w9-floral-addon' ) => 'DESC',
                    __( 'Ascending', 'w9-floral-addon' )  => 'ASC',
                ),
                'param_holder_class' => 'vc_grid-data-type-not-ids',
                'description'        => __( 'Select sorting order.', 'w9-floral-addon' ),
                'dependency'         => array(
                    'element'            => 'post_type',
                    'value_not_equal_to' => array(
                        'ids',
                        'custom',
                    ),
                ),
            ),
            array(
                'type'               => 'textfield',
                'heading'            => __( 'Meta key', 'w9-floral-addon' ),
                'param_name'         => 'meta_key',
                'description'        => __( 'Input meta key for grid ordering.', 'w9-floral-addon' ),
                'group'              => __( 'Data Settings', 'w9-floral-addon' ),
                'param_holder_class' => 'vc_grid-data-type-not-ids',
                'dependency'         => array(
                    'element' => 'orderby',
                    'value'   => array(
                        'meta_value',
                        'meta_value_num',
                    ),
                ),
            ),
            array(
                'type'               => 'textfield',
                'heading'            => __( 'Offset', 'w9-floral-addon' ),
                'param_name'         => 'offset',
                'description'        => __( 'Number of grid elements to displace or pass over.', 'w9-floral-addon' ),
                'group'              => __( 'Data Settings', 'w9-floral-addon' ),
                'param_holder_class' => 'vc_grid-data-type-not-ids',
                'dependency'         => array(
                    'element'            => 'post_type',
                    'value_not_equal_to' => array(
                        'ids',
                        'custom',
                    ),
                ),
            ),
            array(
                'type'               => 'autocomplete',
                'heading'            => __( 'Exclude', 'w9-floral-addon' ),
                'param_name'         => 'exclude',
                'description'        => __( 'Exclude posts, pages, etc. by title.', 'w9-floral-addon' ),
                'group'              => __( 'Data Settings', 'w9-floral-addon' ),
                'settings'           => array(
                    'multiple' => true,
                ),
                'param_holder_class' => 'vc_grid-data-type-not-ids',
                'dependency'         => array(
                    'element'            => 'post_type',
                    'value_not_equal_to' => array(
                        'ids',
                        'custom',
                    ),
                    'callback'           => 'vc_grid_exclude_dependency_callback',
                ),
            ),
            //Filter tab
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Filter by', 'w9-floral-addon' ),
                'param_name'  => 'filter_source',
                'value'       => $taxonomiesForFilter,
                'group'       => __( 'Filter', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'show_filter',
                    'value'   => array( 'yes' ),
                ),
                'save_always' => true,
                'description' => __( 'Select filter source.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'autocomplete',
                'heading'     => __( 'Exclude from filter list', 'w9-floral-addon' ),
                'param_name'  => 'exclude_filter',
                'settings'    => array(
                    'multiple'       => true,
                    // is multiple values allowed? default false
                    'min_length'     => 1,
                    // min length to start search -> default 2
                    'groups'         => true,
                    // In UI show results grouped by groups, default false
                    'unique_values'  => true,
                    // In UI show results except selected. NB! You should manually check values in backend, default false
                    'display_inline' => true,
                    // In UI show results inline view, default false (each value in own line)
                    'delay'          => 500,
                    // delay for search. default 500
                    'auto_focus'     => true,
                    // auto focus input, default true
                ),
                'description' => __( 'Enter categories, tags won\'t be shown in the filters list.', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element'  => 'show_filter',
                    'value'    => array( 'yes' ),
                    'callback' => 'vcGridFilterExcludeCallBack',
                ),
                'group'       => __( 'Filter', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Style', 'w9-floral-addon' ),
                'param_name'  => 'filter_style',
                'value'       => array(
                    __( 'Simple', 'w9-floral-addon' )              => 'simple',
                    __( 'Rounded', 'w9-floral-addon' )             => 'default',
                    __( 'Less Rounded', 'w9-floral-addon' )        => 'default-less-rounded',
                    __( 'Border', 'w9-floral-addon' )              => 'bordered',
                    __( 'Rounded Border', 'w9-floral-addon' )      => 'bordered-rounded',
                    __( 'Less Rounded Border', 'w9-floral-addon' ) => 'bordered-rounded-less',
                    __( 'Filled', 'w9-floral-addon' )              => 'filled',
                    __( 'Rounded Filled', 'w9-floral-addon' )      => 'filled-rounded',
                    __( 'Dropdown', 'w9-floral-addon' )            => 'dropdown',
                ),
                'dependency'  => array(
                    'element' => 'show_filter',
                    'value'   => array( 'yes' ),
                ),
                'group'       => __( 'Filter', 'w9-floral-addon' ),
                'description' => __( 'Select filter display style.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Default title', 'w9-floral-addon' ),
                'param_name'  => 'filter_default_title',
                'value'       => __( 'All', 'w9-floral-addon' ),
                'description' => __( 'Enter default title for filter option display (empty: "All").', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'show_filter',
                    'value'   => array( 'yes' ),
                ),
                'group'       => __( 'Filter', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Alignment', 'w9-floral-addon' ),
                'param_name'  => 'filter_align',
                'value'       => array(
                    __( 'Center', 'w9-floral-addon' ) => 'center',
                    __( 'Left', 'w9-floral-addon' )   => 'left',
                    __( 'Right', 'w9-floral-addon' )  => 'right',
                ),
                'dependency'  => array(
                    'element' => 'show_filter',
                    'value'   => array( 'yes' ),
                ),
                'group'       => __( 'Filter', 'w9-floral-addon' ),
                'description' => __( 'Select filter alignment.', 'w9-floral-addon' ),
            ),
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Color', 'w9-floral-addon' ),
                'param_name'         => 'filter_color',
                'value'              => getVcShared( 'colors' ),
                'std'                => 'grey',
                'param_holder_class' => 'vc_colored-dropdown',
                'dependency'         => array(
                    'element'            => 'filter_style',
                    'value_not_equal_to' => array( 'simple' ),
                ),
                'group'              => __( 'Filter', 'w9-floral-addon' ),
                'description'        => __( 'Select filter color.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Filter size', 'w9-floral-addon' ),
                'param_name'  => 'filter_size',
                'value'       => getVcShared( 'sizes' ),
                'std'         => 'md',
                'description' => __( 'Select filter size.', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'show_filter',
                    'value'   => array( 'yes' ),
                ),
                'group'       => __( 'Filter', 'w9-floral-addon' ),
            ),
            // moved to the end
            // Paging controls
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Arrows design', 'w9-floral-addon' ),
                'param_name'  => 'arrows_design',
                'value'       => array(
                    __( 'None', 'w9-floral-addon' )                  => 'none',
                    __( 'Floral', 'w9-floral-addon' )                => 'owl-nav-style-floral',
                    __( 'Floral 2', 'w9-floral-addon' )              => 'owl-nav-style-floral-2',
                    __( 'Simple', 'w9-floral-addon' )                => 'vc_arrow-icon-arrow_01_left',
                    __( 'Simple Circle Border', 'w9-floral-addon' )  => 'vc_arrow-icon-arrow_02_left',
                    __( 'Simple Circle', 'w9-floral-addon' )         => 'vc_arrow-icon-arrow_03_left',
                    __( 'Simple Square', 'w9-floral-addon' )         => 'vc_arrow-icon-arrow_09_left',
                    __( 'Simple Square Rounded', 'w9-floral-addon' ) => 'vc_arrow-icon-arrow_12_left',
                    __( 'Simple Rounded', 'w9-floral-addon' )        => 'vc_arrow-icon-arrow_11_left',
                    __( 'Rounded', 'w9-floral-addon' )               => 'vc_arrow-icon-arrow_04_left',
                    __( 'Rounded Circle Border', 'w9-floral-addon' ) => 'vc_arrow-icon-arrow_05_left',
                    __( 'Rounded Circle', 'w9-floral-addon' )        => 'vc_arrow-icon-arrow_06_left',
                    __( 'Rounded Square', 'w9-floral-addon' )        => 'vc_arrow-icon-arrow_10_left',
                    __( 'Simple Arrow', 'w9-floral-addon' )          => 'vc_arrow-icon-arrow_08_left',
                    __( 'Simple Rounded Arrow', 'w9-floral-addon' )  => 'vc_arrow-icon-arrow_07_left',
                
                ),
                'group'       => self::$pagination_label,
                'dependency'  => self::$pagination_dependency,
                'description' => __( 'Select design for arrows.', 'w9-floral-addon' ),
                'std'         => 'none'
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Pagination offset top', 'w9-floral-addon' ),
                'param_name'  => 'pagination_position',
                'value'       => array(
                    '-100px' => 'pagination-position--100px',
                    '-90px'  => 'pagination-position--90px',
                    '-80px'  => 'pagination-position--80px',
                    '-70px'  => 'pagination-position--70px',
                    '-60px'  => 'pagination-position--60px',
                    '-50px'  => 'pagination-position--50px',
                    '-40px'  => 'pagination-position--40px',
                    '-30px'  => 'pagination-position--30px',
                    '-20px'  => 'pagination-position--20px',
                    '-10px'  => 'pagination-position--10px',
                    '0px'    => 'pagination-position-0px',
                    '10px'   => 'pagination-position-10px',
                    '20px'   => 'pagination-position-20px',
                    '30px'   => 'pagination-position-30px',
                    '40px'   => 'pagination-position-40px',
                    '50px'   => 'pagination-position-50px',
                    '60px'   => 'pagination-position-60px',
                    '70px'   => 'pagination-position-70px',
                    '80px'   => 'pagination-position-80px',
                    '90px'   => 'pagination-position-90px',
                    '100px'  => 'pagination-position-100px',
                ),
                'group'       => self::$pagination_label,
                'dependency'  => self::$pagination_dependency,
                'description' => __( 'Select offset for pagination', 'w9-floral-addon' ),
                'std'         => 'pagination-position-30px'
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Arrows position', 'w9-floral-addon' ),
                'param_name'  => 'arrows_position',
                'value'       => array(
                    __( 'Inside Wrapper', 'w9-floral-addon' )  => 'inside',
                    __( 'Outside Wrapper', 'w9-floral-addon' ) => 'outside',
                ),
                'group'       => self::$pagination_label,
                'dependency'  => array(
                    'element'            => 'arrows_design',
                    'value_not_equal_to' => array( 'none' ),
                ),
                'description' => __( 'Arrows will be displayed inside or outside grid.', 'w9-floral-addon' ),
            ),
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Arrows color', 'w9-floral-addon' ),
                'param_name'         => 'arrows_color',
                'value'              => array_merge(
                    array( __( 'Default CSS', 'w9-floral-addon' ) => '__', ),
                    Floral_Map_Helpers::get_just_colors()
                ),
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => self::$pagination_label,
                'dependency'         => array(
                    'element'            => 'arrows_design',
                    'value_not_equal_to' => array( 'none' ),
                    // New dependency
                ),
                'description'        => __( 'Select color for arrows.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Pagination style', 'w9-floral-addon' ),
                'param_name'  => 'paging_design',
                'value'       => array(
                    __( 'None', 'w9-floral-addon' )                     => 'none',
                    __( 'Floral Simple', 'w9-floral-addon' )            => 'floral-simple',
                    __( 'Floral Pagination', 'w9-floral-addon' )        => 'floral-pagination',
                    __( 'Floral Pagination 2', 'w9-floral-addon' )      => 'floral-pagination-2',
                    __( 'Square Dots', 'w9-floral-addon' )              => 'square_dots',
                    __( 'Radio Dots', 'w9-floral-addon' )               => 'radio_dots',
                    __( 'Point Dots', 'w9-floral-addon' )               => 'point_dots',
                    __( 'Fill Square Dots', 'w9-floral-addon' )         => 'fill_square_dots',
                    __( 'Rounded Fill Square Dots', 'w9-floral-addon' ) => 'round_fill_square_dots',
                    __( 'Pagination Default', 'w9-floral-addon' )       => 'pagination_default',
//                    __( 'Outline Default Dark', 'w9-floral-addon' ) => 'pagination_default_dark',
//                    __( 'Outline Default Light', 'w9-floral-addon' ) => 'pagination_default_light',
//                    __( 'Pagination Rounded', 'w9-floral-addon' ) => 'pagination_rounded',
//                    __( 'Outline Rounded Dark', 'w9-floral-addon' ) => 'pagination_rounded_dark',
//                    __( 'Outline Rounded Light', 'w9-floral-addon' ) => 'pagination_rounded_light',
//                    __( 'Pagination Square', 'w9-floral-addon' ) => 'pagination_square',
//                    __( 'Outline Square Dark', 'w9-floral-addon' ) => 'pagination_square_dark',
//                    __( 'Outline Square Light', 'w9-floral-addon' ) => 'pagination_square_light',
//                    __( 'Pagination Rounded Square', 'w9-floral-addon' ) => 'pagination_rounded_square',
//                    __( 'Outline Rounded Square Dark', 'w9-floral-addon' ) => 'pagination_rounded_square_dark',
//                    __( 'Outline Rounded Square Light', 'w9-floral-addon' ) => 'pagination_rounded_square_light',
//                    __( 'Stripes Dark', 'w9-floral-addon' ) => 'pagination_stripes_dark',
//                    __( 'Stripes Light', 'w9-floral-addon' ) => 'pagination_stripes_light',
                ),
                'std'         => 'floral_simple',
                'group'       => self::$pagination_label,
                'dependency'  => self::$pagination_dependency,
                'description' => __( 'Select pagination style.', 'w9-floral-addon' ),
            ),
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Pagination color', 'w9-floral-addon' ),
                'param_name'         => 'paging_color',
                'value'              => array_merge(
                    array( __( 'Default CSS', 'w9-floral-addon' ) => '__', ),
                    Floral_Map_Helpers::get_just_colors()
                ),
                'std'                => 'grey',
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => self::$pagination_label,
                'dependency'         => array(
                    'element'            => 'paging_design',
                    'value_not_equal_to' => array( 'none', 'floral-pagination-2' ),
                    // New dependency
                ),
                'description'        => __( 'Select pagination color.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Loop pages?', 'w9-floral-addon' ),
                'param_name'  => 'loop',
                'description' => __( 'Allow items to be repeated in infinite loop (carousel).', 'w9-floral-addon' ),
                'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
                'group'       => self::$pagination_label,
                'dependency'  => self::$pagination_dependency,
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Autoplay delay', 'w9-floral-addon' ),
                'param_name'  => 'autoplay',
                'value'       => '-1',
                'description' => __( 'Enter value in seconds. Set -1 to disable autoplay.', 'w9-floral-addon' ),
                'group'       => self::$pagination_label,
                'dependency'  => self::$pagination_dependency,
            ),
            array(
                'type'        => 'animation_style',
                'heading'     => __( 'Animation in', 'w9-floral-addon' ),
                'param_name'  => 'paging_animation_in',
                'group'       => self::$pagination_label,
                'settings'    => array(
                    'type' => array(
                        'in',
                        'other',
                    ),
                ),
                'dependency'  => self::$pagination_dependency,
                'description' => __( 'Select "animation in" for page transition.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'animation_style',
                'heading'     => __( 'Animation out', 'w9-floral-addon' ),
                'param_name'  => 'paging_animation_out',
                'group'       => self::$pagination_label,
                'settings'    => array(
                    'type' => array( 'out' ),
                ),
                'dependency'  => self::$pagination_dependency,
                'description' => __( 'Select "animation out" for page transition.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'vc_grid_item',
                'heading'     => __( 'Grid element template', 'w9-floral-addon' ),
                'param_name'  => 'item',
                'description' => sprintf( __( '%sCreate new%s template or %smodify selected%s. Predefined templates will be cloned.', 'w9-floral-addon' ), '<a href="'
                    . esc_url( admin_url( 'post-new.php?post_type=vc_grid_item' ) )
                    . '" target="_blank">', '</a>', '<a href="#" target="_blank" data-vc-grid-item="edit_link">', '</a>' ),
                'group'       => __( 'Item Design', 'w9-floral-addon' ),
                'value'       => 'none',
            ),
            array(
                'type'       => 'vc_grid_id',
                'param_name' => 'grid_id',
            ),
            array(
                'type'        => 'animation_style',
                'heading'     => __( 'Initial loading animation', 'w9-floral-addon' ),
                'param_name'  => 'initial_loading_animation',
                'value'       => 'fadeIn',
                'settings'    => array(
                    'type' => array(
                        'in',
                        'other',
                    ),
                ),
                'description' => __( 'Select initial loading animation for grid element.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Extra class name', 'w9-floral-addon' ),
                'param_name'  => 'el_class',
                'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'w9-floral-addon' ),
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'CSS box', 'w9-floral-addon' ),
                'param_name' => 'css',
                'group'      => __( 'Design Options', 'w9-floral-addon' ),
            ),
            
            // Load more btn
            array(
                'type'               => 'hidden',
                'heading'            => __( 'Button style', 'w9-floral-addon' ),
                'param_name'         => 'button_style',
                'value'              => '',
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => __( 'Load More Button', 'w9-floral-addon' ),
                'dependency'         => array(
                    'element' => 'style',
                    'value'   => array( 'load-more' ),
                ),
                'description'        => __( 'Select button style.', 'w9-floral-addon' ),
            ),
            array(
                'type'               => 'hidden',
                'heading'            => __( 'Button color', 'w9-floral-addon' ),
                'param_name'         => 'button_color',
                'value'              => '',
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => __( 'Load More Button', 'w9-floral-addon' ),
                'dependency'         => array(
                    'element' => 'style',
                    'value'   => array( 'load-more' ),
                ),
                'description'        => __( 'Select button color.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'hidden',
                'heading'     => __( 'Button size', 'w9-floral-addon' ),
                'param_name'  => 'button_size',
                'value'       => '',
                'description' => __( 'Select button size.', 'w9-floral-addon' ),
                'group'       => __( 'Load More Button', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'style',
                    'value'   => array( 'load-more' ),
                ),
            ),
        ), self::$btn3Params );
        self::$basicGrid = array_merge( self::$basicGrid );
        
        return self::$basicGrid;
    }
    
    // Media grid common settings
    public static function getMediaCommonAtts() {
        
        if ( self::$mediaGrid ) {
            return self::$mediaGrid;
        }
        
        if ( is_null( self::$btn3Params ) && is_null( self::$gridColsList ) ) {
            self::initData();
        }
        
        self::$mediaGrid = array_merge( array(
            array(
                'type'        => 'attach_images',
                'heading'     => __( 'Images', 'w9-floral-addon' ),
                'param_name'  => 'include',
                'description' => __( 'Select images from media library.', 'w9-floral-addon' ),
            
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => __( 'Display style', 'w9-floral-addon' ),
                'param_name'       => 'style',
                'value'            => array(
                    __( 'Show all', 'w9-floral-addon' )         => 'all',
                    self::$slider_label                         => 'slider',
                    __( 'Load more button', 'w9-floral-addon' ) => 'load-more',
                    __( 'Lazy loading', 'w9-floral-addon' )     => 'lazy',
                    self::$pagination_label                     => 'pagination',
                ),
                'dependency'       => array(
                    'element'            => 'post_type',
                    'value_not_equal_to' => array( 'custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'description'      => __( 'Select display style for grid.', 'w9-floral-addon' ),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => __( 'Items per page', 'w9-floral-addon' ),
                'param_name'       => 'items_per_page',
                'description'      => __( 'Number of items to show per page.', 'w9-floral-addon' ),
                'value'            => '10',
                'dependency'       => array(
                    'element' => 'style',
                    'value'   => array(
                        'lazy',
                        'load-more',
                        'pagination',
                    ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => __( 'Grid elements per row', 'w9-floral-addon' ),
                'param_name'       => 'element_width',
                'value'            => self::$gridColsList,
                'std'              => '4',
                'edit_field_class' => 'vc_col-sm-6',
                'description'      => __( 'Select number of single grid elements per row.', 'w9-floral-addon' ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => __( 'Gap', 'w9-floral-addon' ),
                'param_name'       => 'gap',
                'value'            => array(
                    '0px'  => '0',
                    '1px'  => '1',
                    '2px'  => '2',
                    '3px'  => '3',
                    '4px'  => '4',
                    '5px'  => '5',
                    '10px' => '10',
                    '15px' => '15',
                    '20px' => '20',
                    '25px' => '25',
                    '30px' => '30',
                    '35px' => '35',
                ),
                'std'              => '5',
                'description'      => __( 'Select gap between grid elements.', 'w9-floral-addon' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'               => 'hidden',
                'heading'            => __( 'Button style', 'w9-floral-addon' ),
                'param_name'         => 'button_style',
                'value'              => '',
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => __( 'Load More Button', 'w9-floral-addon' ),
                'dependency'         => array(
                    'element' => 'style',
                    'value'   => array( 'load-more' ),
                ),
                'description'        => __( 'Select button style.', 'w9-floral-addon' ),
            ),
            array(
                'type'               => 'hidden',
                'heading'            => __( 'Button color', 'w9-floral-addon' ),
                'param_name'         => 'button_color',
                'value'              => '',
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => __( 'Load More Button', 'w9-floral-addon' ),
                'dependency'         => array(
                    'element' => 'style',
                    'value'   => array( 'load-more' ),
                ),
                'description'        => __( 'Select button color.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'hidden',
                'heading'     => __( 'Button size', 'w9-floral-addon' ),
                'param_name'  => 'button_size',
                'value'       => '',
                'description' => __( 'Select button size.', 'w9-floral-addon' ),
                'group'       => __( 'Load More Button', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'style',
                    'value'   => array( 'load-more' ),
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Arrows design', 'w9-floral-addon' ),
                'param_name'  => 'arrows_design',
                'value'       => array(
                    __( 'None', 'w9-floral-addon' )                  => 'none',
                    __( 'Floral', 'w9-floral-addon' )                => 'owl-nav-style-floral',
                    __( 'Floral', 'w9-floral-addon' )                => 'owl-nav-style-floral',
                    __( 'Simple', 'w9-floral-addon' )                => 'vc_arrow-icon-arrow_01_left',
                    __( 'Simple Circle Border', 'w9-floral-addon' )  => 'vc_arrow-icon-arrow_02_left',
                    __( 'Simple Circle', 'w9-floral-addon' )         => 'vc_arrow-icon-arrow_03_left',
                    __( 'Simple Square', 'w9-floral-addon' )         => 'vc_arrow-icon-arrow_09_left',
                    __( 'Simple Square Rounded', 'w9-floral-addon' ) => 'vc_arrow-icon-arrow_12_left',
                    __( 'Simple Rounded', 'w9-floral-addon' )        => 'vc_arrow-icon-arrow_11_left',
                    __( 'Rounded', 'w9-floral-addon' )               => 'vc_arrow-icon-arrow_04_left',
                    __( 'Rounded Circle Border', 'w9-floral-addon' ) => 'vc_arrow-icon-arrow_05_left',
                    __( 'Rounded Circle', 'w9-floral-addon' )        => 'vc_arrow-icon-arrow_06_left',
                    __( 'Rounded Square', 'w9-floral-addon' )        => 'vc_arrow-icon-arrow_10_left',
                    __( 'Simple Arrow', 'w9-floral-addon' )          => 'vc_arrow-icon-arrow_08_left',
                    __( 'Simple Rounded Arrow', 'w9-floral-addon' )  => 'vc_arrow-icon-arrow_07_left',
                
                ),
                'group'       => self::$pagination_label,
                'dependency'  => self::$pagination_dependency,
                'description' => __( 'Select design for arrows.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Arrows position', 'w9-floral-addon' ),
                'param_name'  => 'arrows_position',
                'value'       => array(
                    __( 'Inside Wrapper', 'w9-floral-addon' )  => 'inside',
                    __( 'Outside Wrapper', 'w9-floral-addon' ) => 'outside',
                ),
                'group'       => self::$pagination_label,
                'dependency'  => array(
                    'element'            => 'arrows_design',
                    'value_not_equal_to' => array( 'none' ),
                    // New dependency
                ),
                'description' => __( 'Arrows will be displayed inside or outside grid.', 'w9-floral-addon' ),
            ),
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Arrows color', 'w9-floral-addon' ),
                'param_name'         => 'arrows_color',
                'value'              => array(
                        __( 'Primary Color', 'w9-floral-addon' )   => 'p',
                        __( 'Secondary Color', 'w9-floral-addon' ) => 's',
                        __( 'Text Color', 'w9-floral-addon' )      => 'text',
                        __( 'Gray #222', 'w9-floral-addon' )       => 'gray2',
                        __( 'Gray #444', 'w9-floral-addon' )       => 'gray4',
                        __( 'Gray #666', 'w9-floral-addon' )       => 'gray6',
                        __( 'Gray #888', 'w9-floral-addon' )       => 'gray8',
                    ) + getVcShared( 'colors' ),
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => self::$pagination_label,
                'dependency'         => array(
                    'element'            => 'arrows_design',
                    'value_not_equal_to' => array( 'none' ),
                    // New dependency
                ),
                'description'        => __( 'Select color for arrows.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Pagination style', 'w9-floral-addon' ),
                'param_name'  => 'paging_design',
                'value'       => array(
                    __( 'None', 'w9-floral-addon' )                     => 'none',
                    __( 'Floral Pagination', 'w9-floral-addon' )        => 'floral-pagination',
                    __( 'Floral Simple', 'w9-floral-addon' )            => 'floral-simple',
                    __( 'Square Dots', 'w9-floral-addon' )              => 'square_dots',
                    __( 'Radio Dots', 'w9-floral-addon' )               => 'radio_dots',
                    __( 'Point Dots', 'w9-floral-addon' )               => 'point_dots',
                    __( 'Fill Square Dots', 'w9-floral-addon' )         => 'fill_square_dots',
                    __( 'Rounded Fill Square Dots', 'w9-floral-addon' ) => 'round_fill_square_dots',
                    __( 'Pagination Default', 'w9-floral-addon' )       => 'pagination_default',
//                    __( 'Outline Default Dark', 'w9-floral-addon' ) => 'pagination_default_dark',
//                    __( 'Outline Default Light', 'w9-floral-addon' ) => 'pagination_default_light',
//                    __( 'Pagination Rounded', 'w9-floral-addon' ) => 'pagination_rounded',
//                    __( 'Outline Rounded Dark', 'w9-floral-addon' ) => 'pagination_rounded_dark',
//                    __( 'Outline Rounded Light', 'w9-floral-addon' ) => 'pagination_rounded_light',
//                    __( 'Pagination Square', 'w9-floral-addon' ) => 'pagination_square',
//                    __( 'Outline Square Dark', 'w9-floral-addon' ) => 'pagination_square_dark',
//                    __( 'Outline Square Light', 'w9-floral-addon' ) => 'pagination_square_light',
//                    __( 'Pagination Rounded Square', 'w9-floral-addon' ) => 'pagination_rounded_square',
//                    __( 'Outline Rounded Square Dark', 'w9-floral-addon' ) => 'pagination_rounded_square_dark',
//                    __( 'Outline Rounded Square Light', 'w9-floral-addon' ) => 'pagination_rounded_square_light',
//                    __( 'Stripes Dark', 'w9-floral-addon' ) => 'pagination_stripes_dark',
//                    __( 'Stripes Light', 'w9-floral-addon' ) => 'pagination_stripes_light',
                ),
                'std'         => 'floral-simple',
                'group'       => self::$pagination_label,
                'dependency'  => self::$pagination_dependency,
                'description' => __( 'Select pagination style.', 'w9-floral-addon' ),
            ),
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Pagination color', 'w9-floral-addon' ),
                'param_name'         => 'paging_color',
                'value'              => array(
                    __( 'Primary Color', 'w9-floral-addon' )   => 'p',
                    __( 'Secondary Color', 'w9-floral-addon' ) => 's',
                    __( 'Text Color', 'w9-floral-addon' )      => 'text',
                    __( 'Gray #222', 'w9-floral-addon' )       => 'gray2',
                    __( 'Gray #444', 'w9-floral-addon' )       => 'gray4',
                    __( 'Gray #666', 'w9-floral-addon' )       => 'gray6',
                    __( 'Gray #888', 'w9-floral-addon' )       => 'gray8',
                )
//                    +getVcShared( 'colors' )
            ,
                'std'                => 'grey',
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => self::$pagination_label,
                'dependency'         => array(
                    'element'            => 'paging_design',
                    'value_not_equal_to' => array( 'none' ),
                    // New dependency
                ),
                'description'        => __( 'Select pagination color.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Loop pages?', 'w9-floral-addon' ),
                'param_name'  => 'loop',
                'description' => __( 'Allow items to be repeated in infinite loop (carousel).', 'w9-floral-addon' ),
                'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
                'group'       => self::$pagination_label,
                'dependency'  => self::$pagination_dependency,
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Autoplay delay', 'w9-floral-addon' ),
                'param_name'  => 'autoplay',
                'value'       => '-1',
                'description' => __( 'Enter value in seconds. Set -1 to disable autoplay.', 'w9-floral-addon' ),
                'group'       => self::$pagination_label,
                'dependency'  => self::$pagination_dependency,
            ),
            array(
                'type'        => 'animation_style',
                'heading'     => __( 'Animation in', 'w9-floral-addon' ),
                'param_name'  => 'paging_animation_in',
                'group'       => self::$pagination_label,
                'settings'    => array(
                    'type' => array(
                        'in',
                        'other',
                    ),
                ),
                'dependency'  => self::$pagination_dependency,
                'description' => __( 'Select "animation in" for page transition.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'animation_style',
                'heading'     => __( 'Animation out', 'w9-floral-addon' ),
                'param_name'  => 'paging_animation_out',
                'group'       => self::$pagination_label,
                'settings'    => array(
                    'type' => array( 'out' ),
                ),
                'dependency'  => self::$pagination_dependency,
                'description' => __( 'Select "animation out" for page transition.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'vc_grid_item',
                'heading'     => __( 'Grid element template', 'w9-floral-addon' ),
                'param_name'  => 'item',
                'description' => sprintf( __( '%sCreate new%s template or %smodify selected%s. Predefined templates will be cloned.', 'w9-floral-addon' ), '<a href="'
                    . esc_url( admin_url( 'post-new.php?post_type=vc_grid_item' ) )
                    . '" target="_blank">', '</a>', '<a href="#" target="_blank" data-vc-grid-item="edit_link">', '</a>' ),
                'group'       => __( 'Item Design', 'w9-floral-addon' ),
                'value'       => 'mediaGrid_Default',
            ),
            array(
                'type'       => 'vc_grid_id',
                'param_name' => 'grid_id',
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'CSS box', 'w9-floral-addon' ),
                'param_name' => 'css',
                'group'      => __( 'Design Options', 'w9-floral-addon' ),
            ),
        ), self::$btn3Params, array(
            // Load more btn bc
            array(
                'type'               => 'hidden',
                'heading'            => __( 'Button style', 'w9-floral-addon' ),
                'param_name'         => 'button_style',
                'value'              => '',
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => __( 'Load More Button', 'w9-floral-addon' ),
                'dependency'         => array(
                    'element' => 'style',
                    'value'   => array( 'load-more' ),
                ),
                'description'        => __( 'Select button style.', 'w9-floral-addon' ),
            ),
            array(
                'type'               => 'hidden',
                'heading'            => __( 'Button color', 'w9-floral-addon' ),
                'param_name'         => 'button_color',
                'value'              => '',
                'param_holder_class' => 'vc_colored-dropdown',
                'group'              => __( 'Load More Button', 'w9-floral-addon' ),
                'dependency'         => array(
                    'element' => 'style',
                    'value'   => array( 'load-more' ),
                ),
                'description'        => __( 'Select button color.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'hidden',
                'heading'     => __( 'Button size', 'w9-floral-addon' ),
                'param_name'  => 'button_size',
                'value'       => '',
                'description' => __( 'Select button size.', 'w9-floral-addon' ),
                'group'       => __( 'Load More Button', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'style',
                    'value'   => array( 'load-more' ),
                ),
            ),
            array(
                'type'        => 'animation_style',
                'heading'     => __( 'Initial loading animation', 'w9-floral-addon' ),
                'param_name'  => 'initial_loading_animation',
                'value'       => 'fadeIn',
                'settings'    => array(
                    'type' => array(
                        'in',
                        'other',
                    ),
                ),
                'description' => __( 'Select initial loading animation for grid element.', 'w9-floral-addon' ),
            ),
        ) );
        
        self::$mediaGrid = array_merge( self::$mediaGrid );
        
        return self::$mediaGrid;
    }
    
    public static function getMasonryCommonAtts() {
        
        if ( self::$masonryGrid ) {
            return self::$masonryGrid;
        }
        
        $gridParams = self::getBasicAtts();
        
        self::$masonryGrid = $gridParams;
        $style             = self::arraySearch( self::$masonryGrid, 'param_name', 'style' );
        unset( self::$masonryGrid[$style]['value'][self::$pagination_label] );
        unset( self::$masonryGrid[$style]['value'][self::$slider_label] );
        
        $animation        = self::arraySearch( self::$masonryGrid, 'param_name', 'initial_loading_animation' );
        $masonryAnimation = array(
            'type'        => 'dropdown',
            'heading'     => __( 'Initial loading animation', 'w9-floral-addon' ),
            'param_name'  => 'initial_loading_animation',
            'value'       => array(
                __( 'None', 'w9-floral-addon' )    => 'none',
                __( 'Default', 'w9-floral-addon' ) => 'zoomIn',
                __( 'Fade In', 'w9-floral-addon' ) => 'fadeIn',
            ),
            'std'         => 'zoomIn',
            'description' => __( 'Select initial loading animation for grid element.', 'w9-floral-addon' ),
        );
        // unset( self::$masonryGrid[$animation] );
        self::$masonryGrid[$animation] = $masonryAnimation;
        
        while ( $key = self::arraySearch( self::$masonryGrid, 'group', self::$pagination_label ) ) {
            unset( self::$masonryGrid[$key] );
        }
        
        $vcGridItem                              = self::arraySearch( self::$masonryGrid, 'param_name', 'item' );
        self::$masonryGrid[$vcGridItem]['value'] = 'masonryGrid_Default';
        
        self::$masonryGrid = array_merge( self::$masonryGrid );
        
        return array_merge( self::$masonryGrid );
    }
    
    public static function getMasonryMediaCommonAtts() {
        
        if ( self::$masonryMediaGrid ) {
            return self::$masonryMediaGrid;
        }
        
        $mediaGridParams = self::getMediaCommonAtts();
        
        self::$masonryMediaGrid = $mediaGridParams;
        
        while ( $key = self::arraySearch( self::$masonryMediaGrid, 'group', self::$pagination_label ) ) {
            unset( self::$masonryMediaGrid[$key] );
        }
        
        $vcGridItem                                   = self::arraySearch( self::$masonryMediaGrid, 'param_name', 'item' );
        self::$masonryMediaGrid[$vcGridItem]['value'] = 'masonryMedia_Default';
        
        $style = self::arraySearch( self::$masonryMediaGrid, 'param_name', 'style' );
        
        unset( self::$masonryMediaGrid[$style]['value'][self::$pagination_label] );
        unset( self::$masonryMediaGrid[$style]['value'][self::$slider_label] );
        
        $animation                          = self::arraySearch( self::$masonryMediaGrid, 'param_name', 'initial_loading_animation' );
        $masonryAnimation                   = array(
            'type'        => 'dropdown',
            'heading'     => __( 'Initial loading animation', 'w9-floral-addon' ),
            'param_name'  => 'initial_loading_animation',
            'value'       => array(
                __( 'None', 'w9-floral-addon' )    => 'none',
                __( 'Default', 'w9-floral-addon' ) => 'zoomIn',
                __( 'Fade In', 'w9-floral-addon' ) => 'fadeIn',
            ),
            'std'         => 'zoomIn',
            'settings'    => array(
                'type' => array(
                    'in',
                    'other',
                ),
            ),
            'description' => __( 'Select initial loading animation for grid element.', 'w9-floral-addon' ),
        );
        self::$masonryMediaGrid[$animation] = $masonryAnimation;
        
        self::$masonryMediaGrid = array_merge( self::$masonryMediaGrid );
        
        return array_merge( self::$masonryMediaGrid );
    }
}