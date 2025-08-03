<?php
/**
 * Search results template
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container mx-auto px-6 py-12 max-w-4xl">
        <header class="page-header mb-16">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif leading-tight mb-4">
                <?php printf(esc_html__('Search Results for: %s', 'typography-theme'), '<span class="text-gray-600">' . get_search_query() . '</span>'); ?>
            </h1>
        </header>

        <?php if (have_posts()) : ?>
            <div class="space-y-16">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header mb-4">
                            <h2 class="text-3xl md:text-4xl font-serif leading-tight mb-2">
                                <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-gray-600 transition-colors duration-300 no-underline">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="text-lg text-gray-600">
                                <?php echo get_post_type(); ?> · <?php echo get_the_date(); ?>
                            </div>
                        </header>

                        <div class="entry-summary prose prose-lg max-w-none">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="mt-16">
                <?php the_posts_navigation(array(
                    'prev_text' => '← Older results',
                    'next_text' => 'Newer results →',
                    'class'     => 'text-xl font-medium'
                )); ?>
            </div>

        <?php else : ?>
            <article class="prose prose-xl lg:prose-2xl max-w-none">
                <h2 class="text-4xl md:text-5xl font-serif leading-tight mb-8">
                    Nothing Found
                </h2>
                <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
                <?php get_search_form(); ?>
            </article>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>