<?php
/**
 * The template for displaying the footer.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div>
</div>

<div class="push grid-container container">
    <div class="inside-article">
        <div class="text-wide"></div>
    </div>
</div>

<?php
/**
 * generate_before_footer hook.
 *
 * @since 0.1
 */
do_action( 'generate_before_footer' );
?>

<div <?php generate_do_attr( 'footer' ); ?>>

<footer class="footer-color-transition">
    <!-- Sponsoren Section -->
    <div class="footer-box">
        <h1><?php echo esc_html(pll__('Unsere Sponsoren', 'gp-winterthur')); ?></h1>
    </div>
<div class="footer-box">
    <?php if (is_active_sidebar('footer-sponsors')) : ?>
        <?php dynamic_sidebar('footer-sponsors'); ?>
    <?php else : ?>
        <div class="footer-box">
            <a href="https://ostschweiz.migros.ch/">
                <img width="196" height="36" loading="lazy" class="footer-image" src="<?php echo esc_url(get_theme_mod('footer_logo_migros', get_stylesheet_directory_uri() . '/images/migros_lime.svg')); ?>" alt="Migros">
            </a>
        </div>
        <div class="footer-box">
            <a href="https://www.newbalance.ch/">
                <img width="170" height="94" loading="lazy" class="footer-image" src="<?php echo esc_url(get_theme_mod('footer_logo_newbalance', get_stylesheet_directory_uri() . '/images/nb_lime.svg')); ?>" alt="New Balance">
            </a>
        </div>
        <div class="footer-box">
            <a href="https://www.swica.ch/">
                <img width="196" height="67" loading="lazy" class="footer-image" src="<?php echo esc_url(get_theme_mod('footer_logo_swica', get_stylesheet_directory_uri() . '/images/swica_lime.svg')); ?>" alt="SWICA">
            </a>
        </div>
    <?php endif; ?>
</div>

    <!-- Spacer (if needed) -->
    <div class="footer-box">
        <h1>&nbsp;</h1>
    </div>

    <!-- Links and Contact Section -->
    <div class="footer-section-links">
        <!-- Left Column: Contact Information -->
<div class="footer-column-left">
    <?php if (is_active_sidebar('footer-left-column')) : ?>
        <?php dynamic_sidebar('footer-left-column'); ?>
    <?php else : ?>
        <p>
            Grand Prix Winterthur<br>
            Oberseenerstrasse 184<br>
            8405 Winterthur
        </p>
        <p>
            +41 52 238 10 79<br>
            <a href="mailto:hello@gp-winterthur.ch">hello@gp-winterthur.ch</a>
        </p>
    <?php endif; ?>
</div>


        <!-- Right Column: Links, Newsletter, Social Media, and Bottom Links -->
        <div class="footer-column-right">
            <!-- Top Row: Links and Newsletter -->
            <div class="footer-top-row">
                <div class="footer-center">

    <?php 	
	// Left Menu
if (has_nav_menu('footer-menu-left')) {
    echo '<div class="footer-center-left"><p>';
    wp_nav_menu(array(
        'theme_location' => 'footer-menu-left',
        'container'      => false,
        'items_wrap'     => '%3$s', // No <ul> wrapper
        'depth'          => 1,
        'walker'         => new Footer_Menu_Walker2(), // Use the custom walker
    ));
    echo '</p></div>';
}
	
	?>

<?php
// Right Menu
if (has_nav_menu('footer-menu-right')) {
    echo '<div class="footer-center-right"><p>';
    wp_nav_menu(array(
        'theme_location' => 'footer-menu-right',
        'container'      => false,
        'items_wrap'     => '%3$s', // No <ul> wrapper
        'depth'          => 1,
        'walker'         => new Footer_Menu_Walker2(), // Use the custom walker
    ));
    echo '</p></div>';
}
?>
					
                </div>
                <div class="footer-right">
                    <a href="<?php echo esc_url(pll__( get_theme_mod('footer_button_link', '#'))); ?>">
                        <button class="button-round"><?php echo esc_html(pll__(get_theme_mod('footer_button_text', __('Newsletter Anmeldung', 'gp-winterthur')))); ?></button>
                    </a>
                </div>
            </div>
            
            <!-- Bottom Row: Social Media and Bottom Links -->
            <div class="footer-bottom-row">
    <div class="footer-social-media">
    <a href="<?php echo esc_url(get_theme_mod('footer_facebook_link', 'https://www.facebook.com/wintimarathon')); ?>">
        <img src="<?php echo esc_url(get_theme_mod('footer_facebook_icon', get_stylesheet_directory_uri() . '/images/facebook_darkforest.svg')); ?>" alt="Facebook">
    </a>
    <a href="<?php echo esc_url(get_theme_mod('footer_instagram_link', 'https://www.instagram.com/wintimarathon/')); ?>">
        <img src="<?php echo esc_url(get_theme_mod('footer_instagram_icon', get_stylesheet_directory_uri() . '/images/instagram_darkforest.svg')); ?>" alt="Instagram">
    </a>
    </div>
                <div class="footer-bottom-right">      
                       <?php display_footer_menu(); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

</div>

<?php
/**
 * generate_after_footer hook.
 *
 * @since 2.1
 */
do_action( 'generate_after_footer' );

wp_footer();
?>

</div><!-- .page-wrapper -->

</body>
</html>