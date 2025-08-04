<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main">Skip to content</a>

    <header id="masthead" class="site-header border-b transition-colors duration-300" style="background-color: rgb(var(--color-bg-primary)); border-color: rgb(var(--color-border));">
        <div class="container mx-auto px-6 py-8">
            <div class="flex items-center justify-between">
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <h1 class="text-3xl md:text-4xl font-serif">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="transition-colors duration-300 no-underline" style="color: rgb(var(--color-text-primary));">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) : ?>
                            <p class="site-description text-lg mt-2" style="color: rgb(var(--color-text-secondary));"><?php echo $description; ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <button id="menu-toggle" class="lg:hidden p-2 rounded-md transition-colors duration-200" aria-controls="primary-menu" aria-expanded="false" style="color: rgb(var(--color-text-primary));">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path class="menu-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path class="menu-close hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="sr-only">Menu</span>
                </button>

                <nav id="site-navigation" class="main-navigation hidden lg:block">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'flex space-x-8 text-lg',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'link_before'    => '<span class="transition-colors duration-300" style="color: rgb(var(--color-text-primary));">',
                        'link_after'     => '</span>',
                    ));
                    ?>
                </nav>
            </div>

            <!-- Mobile menu -->
            <nav id="mobile-menu" class="mobile-navigation lg:hidden hidden mt-6">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-primary-menu',
                    'menu_class'     => 'flex flex-col space-y-4 text-lg',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'link_before'    => '<span class="transition-colors duration-300 block py-2" style="color: rgb(var(--color-text-primary));">',
                    'link_after'     => '</span>',
                ));
                ?>
            </nav>
        </div>
    </header>