<?php
/**
 * Archive template
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container mx-auto px-6 py-12 max-w-4xl">
        <?php if (have_posts()) : ?>
            <header class="page-header mb-16 text-center">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif leading-tight mb-6">
                    <?php the_archive_title(); ?>
                </h1>
                <?php the_archive_description('<div class="archive-description prose prose-xl mx-auto">', '</div>'); ?>
            </header>

            <div class="space-y-16">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header mb-6">
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif leading-tight mb-4">
                                <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-gray-600 transition-colors duration-300 no-underline">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="text-lg text-gray-600 space-x-4">
                                <time datetime="<?php echo get_the_date('c'); ?>" class="italic">
                                    <?php echo get_the_date(); ?>
                                </time>
                                <span>·</span>
                                <span><?php the_author(); ?></span>
                            </div>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mb-6">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300')); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content prose prose-lg max-w-none">
                            <?php the_excerpt(); ?>
                        </div>

                        <footer class="entry-footer mt-6">
                            <a href="<?php the_permalink(); ?>" class="inline-block text-xl font-medium text-gray-900 hover:text-gray-600 transition-colors duration-300">
                                <?php esc_html_e('Continue reading', 'typography-theme'); ?> →
                            </a>
                        </footer>
                    </article>
                <?php endwhile; ?>
            </div>

            <nav class="pagination mt-16">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '←',
                    'next_text' => '→',
                    'before_page_number' => '<span class="screen-reader-text">' . __('Page', 'typography-theme') . ' </span>',
                ));
                ?>
            </nav>

        <?php else : ?>
            <article class="prose prose-xl lg:prose-2xl max-w-none text-center">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif leading-tight mb-8">
                    <?php esc_html_e('Nothing Found', 'typography-theme'); ?>
                </h1>
                <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'typography-theme'); ?></p>
                <?php get_search_form(); ?>
            </article>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>