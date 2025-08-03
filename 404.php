<?php
/**
 * 404 error page template
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container mx-auto px-6 py-24 max-w-4xl text-center">
        <div class="error-404 not-found">
            <header class="page-header mb-12">
                <h1 class="text-8xl md:text-9xl font-serif leading-none mb-6">404</h1>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif mb-8">
                    <?php esc_html_e('Page Not Found', 'typography-theme'); ?>
                </h2>
            </header>

            <div class="page-content prose prose-xl mx-auto">
                <p class="text-xl mb-8">
                    <?php esc_html_e('It looks like nothing was found at this location. Perhaps searching can help?', 'typography-theme'); ?>
                </p>

                <?php get_search_form(); ?>

                <div class="mt-16">
                    <h3 class="text-2xl font-serif mb-6"><?php esc_html_e('Popular Pages', 'typography-theme'); ?></h3>
                    <nav class="popular-pages">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'flex flex-col space-y-3 text-lg',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ));
                        ?>
                    </nav>
                </div>

                <div class="mt-12">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block px-8 py-3 bg-gray-900 text-white rounded-md hover:bg-gray-700 transition-colors duration-300">
                        <?php esc_html_e('Go to Homepage', 'typography-theme'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>