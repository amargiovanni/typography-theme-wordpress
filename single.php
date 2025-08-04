<?php
/**
 * Single post template
 */

get_header(); ?>

<main id="main" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('container mx-auto px-6 py-12 max-w-4xl'); ?>>
        <?php while (have_posts()) : the_post(); ?>
            <header class="entry-header mb-12">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif leading-tight mb-8">
                    <?php the_title(); ?>
                </h1>
                
                <div class="flex flex-wrap items-center text-lg space-x-4" style="color: rgb(var(--color-text-secondary));">
                    <time datetime="<?php echo get_the_date('c'); ?>" class="italic">
                        <?php echo get_the_date(); ?>
                    </time>
                    <span>·</span>
                    <span>By <?php the_author(); ?></span>
                    <?php if (has_category()) : ?>
                        <span>·</span>
                        <span><?php the_category(', '); ?></span>
                    <?php endif; ?>
                </div>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="mt-8">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg shadow-sm')); ?>
                    </div>
                <?php endif; ?>
            </header>

            <div class="entry-content prose prose-xl lg:prose-2xl max-w-none prose-headings:font-serif prose-a:no-underline" style="color: rgb(var(--color-text-primary));">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer mt-16 pt-8 border-t" style="border-color: rgb(var(--color-border));">
                <?php if (has_tag()) : ?>
                    <div class="mb-8">
                        <span class="text-lg font-medium mr-3">Tags:</span>
                        <?php the_tags('<span class="inline-block rounded-full px-4 py-2 text-base mr-2 mb-2" style="background-color: rgb(var(--color-bg-hover)); color: rgb(var(--color-text-primary));">', '</span><span class="inline-block rounded-full px-4 py-2 text-base mr-2 mb-2" style="background-color: rgb(var(--color-bg-hover)); color: rgb(var(--color-text-primary));">', '</span>'); ?>
                    </div>
                <?php endif; ?>

                <nav class="post-navigation flex justify-between items-center">
                    <div class="nav-previous">
                        <?php previous_post_link('%link', '<span class="text-lg" style="color: rgb(var(--color-text-secondary));">←</span> <span class="text-xl font-medium">%title</span>'); ?>
                    </div>
                    <div class="nav-next text-right">
                        <?php next_post_link('%link', '<span class="text-xl font-medium">%title</span> <span class="text-lg" style="color: rgb(var(--color-text-secondary));">→</span>'); ?>
                    </div>
                </nav>
            </footer>

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