<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

<div <?php generate_do_attr( 'content' ); ?>>
	<main <?php generate_do_attr( 'main' ); ?>>
		<?php
		/**
		 * generate_before_main_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_before_main_content' );
		?>

		<article id="post-404" class="page">
			<div class="inside-article">
				<?php
				/**
				 * generate_before_content hook.
				 *
				 * @since 0.1
				 *
				 * Example: generate_featured_page_header_inside_single
				 */
				do_action( 'generate_before_content' );

				/**
				 * We mimic the page structure:
				 * Check if GeneratePress wants to show the header/title.
				 * 
				 * Normally, `generate_show_entry_header()` checks if the title is hidden.
				 * But here, we’ll override to ensure we ALWAYS show a custom 404 title.
				 */
				?>
				<header class="header-color-transition">
					<?php
					/**
					 * generate_before_page_title hook.
					 *
					 * @since 2.4
					 */
					do_action( 'generate_before_page_title' );
					?>

                    <h1 class="entry-title" itemprop="headline">
						<?php 
						// Use GeneratePress's filterable string for the 404 title.
						// This matches the parent theme’s 404-content.php approach:
						echo apply_filters(
							'generate_404_title',
							__( 'Oops! That page can&rsquo;t be found.', 'generatepress' )
						);
						?>
					</h1>

					<?php
					/**
					 * generate_after_page_title hook.
					 *
					 * @since 2.4
					 */
					do_action( 'generate_after_page_title' );
					?>
				</header>

				<?php
				/**
				 * generate_after_entry_header hook.
				 *
				 * @since 0.1
				 *
				 * Example usage: generate_post_image on single pages
				 */
				do_action( 'generate_after_entry_header' );

				/**
				 * For microdata schema type.
				 */
				$itemprop = ( 'microdata' === generate_get_schema_type() ) ? ' itemprop="text"' : '';
				?>

				<div class="entry-content"<?php echo $itemprop; // phpcs:ignore ?>>

			        <div class="gb-grid-wrapper gb-grid-wrapper-6b38c6a5 text-wide">
                        <div class="gb-grid-column gb-grid-column-09982790"><div class="gb-container gb-container-09982790">
                            <p>
                                <?php
                                // Also replicate the parent theme’s approach for the descriptive text:
                                echo apply_filters(
                                    'generate_404_text',
                                    __( 'It looks like nothing was found at this location. Maybe check the menu or head back home?', 'generatepress' )
                                );
                                ?>
                            </p>
                                <a class="gb-button gb-button-2e0a194b gb-button-text button-round"
								   href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php
									// If GeneratePress has a translation for "Return to Home" or similar,
									// wrap in the same domain:
									esc_html_e( 'Return to Home', 'generatepress' );
									?>
								</a>
                        </div>
                    </div>
				</div><!-- .entry-content -->

				<?php
				/**
				 * generate_after_content hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_after_content' );
				?>
			</div><!-- .inside-article -->
		</article><!-- #post-404 -->

		<?php
		/**
		 * generate_after_main_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_main_content' );
		?>
	</main><!-- #main -->
</div><!-- #content -->

<?php
/**
 * generate_after_primary_content_area hook.
 *
 * @since 2.0
 */
do_action( 'generate_after_primary_content_area' );

get_footer();
