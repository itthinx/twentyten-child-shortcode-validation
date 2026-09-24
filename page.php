<?php
/**
 * Template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div>
			<h2>Twenty Ten Child Page Template</h2>
			<h3>Validating dynamic shortcodes in this template</h3>
			<p>
			<?php

				//
				// Use the groups_shortcodes_validate_contents filter to validate shortcodes used dynamically in this template:
				//

				$groups = array( 'Test', 'Premium' );
				$shortcode_content = sprintf(
					'[groups_member group="%s"]Member of %s[/groups_member]',
					implode( ',', $groups ),
					implode( ' or ', $groups )
				);
				$shortcode_content .= '[groups_non_member group="Test"]Not a Test member[/groups_non_member]';
				$validate = function( $contents, $tag, $atts, $content ) use ( $shortcode_content ) {
					return $contents . ' ' . $shortcode_content;
				};
				add_filter( 'groups_shortcodes_validate_contents', $validate, 10, 4 );

				//
				// Process the shortcodes and render the result in this template:
				//

				$processed = do_shortcode( $shortcode_content );
				echo $processed;

			?>
			</p>
		</div>

		<div id="container">
			<div id="content" role="main">

			<?php
			/*
			 * Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
