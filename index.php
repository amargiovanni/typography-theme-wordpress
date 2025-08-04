<?php
/**
 * Main template file
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container mx-auto px-6 py-12 max-w-4xl">
        <?php if (have_posts()) : ?>
            <?php if (is_home() && !is_front_page()) : ?>
                <header class="page-header mb-16">
                    <h1 class="text-6xl md:text-7xl lg:text-8xl font-serif leading-tight mb-4">
                        <?php single_post_title(); ?>
                    </h1>
                </header>
            <?php endif; ?>

            <div class="space-y-24">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('prose prose-xl lg:prose-2xl max-w-none'); ?>>
                        <header class="entry-header mb-8">
                            <?php if (is_singular()) : ?>
                                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif leading-tight mb-6">
                                    <?php the_title(); ?>
                                </h1>
                            <?php else : ?>
                                <h2 class="text-4xl md:text-5xl lg:text-6xl font-serif leading-tight mb-6">
                                    <a href="<?php the_permalink(); ?>" class="transition-colors duration-300 no-underline" style="color: rgb(var(--color-text-primary));">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                            <?php endif; ?>

                            <div class="text-lg space-x-4" style="color: rgb(var(--color-text-secondary));">
                                <time datetime="<?php echo get_the_date('c'); ?>" class="italic">
                                    <?php echo get_the_date(); ?>
                                </time>
                                <span>·</span>
                                <span><?php the_author(); ?></span>
                            </div>
                        </header>

                        <div class="entry-content">
                            <?php
                            if (is_singular()) {
                                the_content();
                                
                                wp_link_pages(array(
                                    'before' => '<div class="page-links mt-12 text-xl">',
                                    'after'  => '</div>',
                                ));
                            } else {
                                the_excerpt();
                                ?>
                                <a href="<?php the_permalink(); ?>" class="inline-block mt-6 text-xl font-medium transition-colors duration-300" style="color: rgb(var(--color-text-primary));">
                                    Continue reading →
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="mt-16">
                <?php the_posts_navigation(array(
                    'prev_text' => '← Older posts',
                    'next_text' => 'Newer posts →',
                    'class'     => 'text-xl font-medium'
                )); ?>
            </div>

        <?php else : ?>
            <article class="prose prose-xl lg:prose-2xl max-w-none">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif leading-tight mb-8">
                    Nothing Found
                </h1>
                <p>It seems we can't find what you're looking for. Perhaps searching can help.</p>
                <?php get_search_form(); ?>
            </article>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>