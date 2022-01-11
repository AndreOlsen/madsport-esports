        <footer class="site-footer">
            <section class="footer-navigation is-center default-width">
                <?php if (is_active_sidebar('footer-left')) : ?>
                    <div id="footer-left-sidebar" class="footer-left-sidebar widget-area" role="complementary">
                        <?php dynamic_sidebar('footer-left'); ?>
                    </div><!-- .footer-left-sidebar -->
                <?php endif; ?>
            </section><!-- .footer-navigation -->

            <section class="copyright-bar">
                <p>&copy; <?php echo sprintf(__('Madsport %d. All rights reserved. Created by %s', 'madsport'), date('Y'), '<a href="https://www.linkedin.com/in/andre-w-olsen/" target="_blank" rel="noopener noreferrer">André Winther Olsen</a>'); ?></p>
            </section> <!-- .copyright-bar -->
        </footer><!-- .site-footer -->

        <?php wp_footer(); ?>

    </body>
</html>