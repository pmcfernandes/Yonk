<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php
/**
 * The template for displaying the footer.
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
 */
 ?>

                </div>
            </div>
            <!-- End row for main content area -->

            <!-- Footer area -->
            <?php do_action('Yonk_content_after'); ?>
            <footer id="footer">
                <div id="inner-footer">

                </div>
                <p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
            </footer>
        </div>
    </div>
    <?php do_action('Yonk_body_end'); ?>
	<?php wp_footer(); ?>
</body>
</html>