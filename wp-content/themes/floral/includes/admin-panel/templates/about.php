<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: about.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$stickies = array(
    array(
        'icon'    => 'w9 w9-ico-tag-1',
        'name'    => esc_html__( 'Submit A Ticket', 'floral' ),
        'content' => esc_html__( 'We offer excellent support through our advanced ticket system. Make sure to register your purchase first to access our support services and other resources.', 'floral' ),
        'url'     => self::$args['support_url'],
        'class'   => 'support-ticket'
    ),
    array(
        'icon'    => 'w9 w9-ico-book-1',
        'name'    => esc_html__( 'Documentation', 'floral' ),
        'content' => esc_html__( 'This is the place to go to reference different aspects of the theme. Our online documentaiton is an incredible resource for learning the ins and outs of using Floral.', 'floral' ),
        'url'     => self::$args['docs_url']
    ),
    array(
        'icon'    => 'w9 w9-ico-suitcase-1',
        'name'    => esc_html__( 'Knowledgebase', 'floral' ),
        'content' => esc_html__( 'Our knowledgebase contains additional content that is not inside of our documentation. This information is more specific and unique to various versions or aspects of Floral.', 'floral' ),
        'url'     => self::$args['knowledgebase_url']
    ),
    array(
        'icon'    => 'w9 w9-ico-caret-square-o-right',
        'name'    => esc_html__( 'Video Tutorials', 'floral' ),
        'content' => esc_html__( 'Nothing is better than watching a video to learn. We have a growing library of high-definititon, narrated video tutorials to help teach you the different aspects of using Floral.', 'floral' ),
        'url'     => self::$args['video_tuts_url']
    ),
    array(
        'icon'    => 'w9 w9-ico-facebook-squared',
        'name'    => esc_html__( 'Facebook Fanpage', 'floral' ),
        'content' => esc_html__( 'We have an amazing Facebook Group! Come and share with other Floral users and help grow our community. Please note, 9WPThemes does not provide support here.', 'floral' ),
        'url'     => self::$args['fb_url']
    ),
    array(
        'icon'    => 'w9 w9-ico-twitter-2',
        'name'    => esc_html__( 'Twitter Channel', 'floral' ),
        'content' => esc_html__( 'We have an amazing Twitter channel! Come and share with other Floral users and help grow our community. Please note, 9WPThemes does not provide support here.', 'floral' ),
        'url'     => self::$args['tw_url']
    ),
);

?>
<div class="page-content-inner page-about">
    <div class="about-9wpthemes white-board">
        <div class="logo-9wpthemes-wrapper">
            <img src="<?php echo esc_url( self::$args['9wptheme_logo_url'] ); ?>" alt="<?php esc_attr_e( '9WPThemes', 'floral' ) ?>">
        </div>
        <div class="description-9wpthemes">
            <h3><?php echo esc_html__( 'About 9WPThemes', 'floral' ); ?></h3>
            <p><?php echo sprintf( __( 'We are <a href="%1$s" target="_blank">9WPThemes</a> (stands for Nice Wordpress Themes), a dedicated group of individuals who love WordPress and beauty of design almost as much as we love our customers. In our work we use the latest technologies, and our heads are always full of ideas to create trendy, unique and easy to set up templates. Moreover, <a href="%1$s" target="_blank">9WPThemes</a> #1 priority is you, the user, and we live this out by providing each and every user with top-notch support. When you need help, you can count on us.', 'floral' ), esc_url( self::$args['author_url'] ) ); ?></p>
        </div>
    </div>
    <div class="stickies-9wpthemes">
        <?php foreach ( $stickies as $sticky ): ?>
            <div class="sticky <?php echo isset( $sticky['class'] ) ? $sticky['class'] : ''; ?>">
                <h4><?php echo isset( $sticky['icon'] ) ? '<i class="' . $sticky['icon'] . '"></i>' : '' ?><?php echo sprintf( $sticky['name'] ); ?></h4>
                <p><?php echo sprintf( $sticky['content'] ); ?></p>
                <a class="button button-primary" href="<?php echo esc_url( $sticky['url'] ); ?>" target="_blank"><?php echo sprintf( $sticky['name'] ); ?></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
