<?php
/**
 * Page template
 */

get_header(); ?>

<main id="main" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('container mx-auto px-6 py-12 max-w-4xl'); ?>>
        <?php while (have_posts()) : the_post(); ?>
            <header class="entry-header mb-12">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif leading-tight">
                    <?php the_title(); ?>
                </h1>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="mt-8">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg shadow-sm')); ?>
                    </div>
                <?php endif; ?>
            </header>

            <div class="entry-content prose prose-xl lg:prose-2xl max-w-none prose-headings:font-serif prose-a:text-gray-900 prose-a:no-underline hover:prose-a:text-gray-600">
                <?php the_content(); ?>
                
                <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links mt-12 text-xl">',
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <?php
            // If comments are open or we have at least one comment, load up the comment template
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </article>
</main>

<?php get_footer(); ?>