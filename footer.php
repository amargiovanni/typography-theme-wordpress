    <footer id="colophon" class="site-footer mt-24 transition-colors duration-300" style="background-color: rgb(var(--color-bg-secondary));">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-2xl font-serif mb-4" style="color: rgb(var(--color-text-primary));"><?php bloginfo('name'); ?></h3>
                    <?php
                    $description = get_bloginfo('description', 'display');
                    if ($description) : ?>
                        <p class="text-lg" style="color: rgb(var(--color-text-secondary));"><?php echo $description; ?></p>
                    <?php endif; ?>
                </div>

                <?php if (has_nav_menu('footer')) : ?>
                    <div>
                        <h3 class="text-xl font-semibold mb-4" style="color: rgb(var(--color-text-primary));">Quick Links</h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'space-y-2 text-lg',
                            'container'      => false,
                            'depth'          => 1,
                            'link_before'    => '<span class="transition-colors duration-300" style="color: rgb(var(--color-text-secondary));">',
                            'link_after'     => '</span>',
                        ));
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-widget-area')) : ?>
                    <div class="widget-area">
                        <?php dynamic_sidebar('footer-widget-area'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-12 pt-8 border-t text-center" style="border-color: rgb(var(--color-border));">
                <p class="text-lg" style="color: rgb(var(--color-text-secondary));">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
                    <?php printf(esc_html__('Proudly powered by %s', 'typography-theme'), '<a href="https://wordpress.org/" class="transition-colors duration-300" style="color: rgb(var(--color-text-primary));">WordPress</a>'); ?>
                </p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>