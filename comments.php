<?php
/**
 * Comments template
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area mt-24 pt-12 border-t border-gray-200">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title text-3xl md:text-4xl font-serif mb-8">
            <?php
            $comment_count = get_comments_number();
            if ($comment_count === '1') {
                printf(esc_html__('One thought on &ldquo;%1$s&rdquo;', 'typography-theme'), get_the_title());
            } else {
                printf(
                    esc_html(_n('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'typography-theme')),
                    number_format_i18n($comment_count),
                    get_the_title()
                );
            }
            ?>
        </h2>

        <ol class="comment-list space-y-8">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'typography_theme_comment',
            ));
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments text-lg text-gray-600 mt-8"><?php esc_html_e('Comments are closed.', 'typography-theme'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    $comment_args = array(
        'class_form'           => 'comment-form prose prose-lg max-w-none',
        'title_reply'          => '<span class="text-3xl md:text-4xl font-serif">' . __('Leave a Reply', 'typography-theme') . '</span>',
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title mb-6">',
        'title_reply_after'    => '</h3>',
        'comment_notes_before' => '<p class="comment-notes text-lg text-gray-600 mb-6">' . __('Your email address will not be published.', 'typography-theme') . '</p>',
        'fields'               => array(
            'author' => '<p class="comment-form-author mb-4"><label for="author" class="block text-lg font-medium mb-2">' . __('Name', 'typography-theme') . ' <span class="required">*</span></label> ' .
                '<input id="author" name="author" type="text" class="w-full px-4 py-3 text-lg border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400" size="30" required /></p>',
            'email'  => '<p class="comment-form-email mb-4"><label for="email" class="block text-lg font-medium mb-2">' . __('Email', 'typography-theme') . ' <span class="required">*</span></label> ' .
                '<input id="email" name="email" type="email" class="w-full px-4 py-3 text-lg border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400" size="30" required /></p>',
            'url'    => '<p class="comment-form-url mb-4"><label for="url" class="block text-lg font-medium mb-2">' . __('Website', 'typography-theme') . '</label> ' .
                '<input id="url" name="url" type="url" class="w-full px-4 py-3 text-lg border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400" size="30" /></p>',
        ),
        'comment_field'        => '<p class="comment-form-comment mb-4"><label for="comment" class="block text-lg font-medium mb-2">' . __('Comment', 'typography-theme') . ' <span class="required">*</span></label> ' .
            '<textarea id="comment" name="comment" class="w-full px-4 py-3 text-lg border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400" cols="45" rows="8" required></textarea></p>',
        'class_submit'         => 'submit bg-gray-900 text-white px-8 py-3 rounded-md text-lg font-medium hover:bg-gray-700 transition-colors duration-300 cursor-pointer',
    );
    comment_form($comment_args);
    ?>
</div>

<?php
/**
 * Custom comment callback
 */
function typography_theme_comment($comment, $args, $depth) {
    ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class('mb-8'); ?>>
        <article class="comment-body">
            <footer class="comment-meta mb-4">
                <div class="comment-author vcard flex items-center">
                    <?php echo get_avatar($comment, 60, '', '', array('class' => 'rounded-full mr-4')); ?>
                    <div>
                        <b class="fn text-xl"><?php echo get_comment_author_link(); ?></b>
                        <div class="comment-metadata text-gray-600">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php printf(__('%1$s at %2$s', 'typography-theme'), get_comment_date(), get_comment_time()); ?>
                            </time>
                        </div>
                    </div>
                </div>
            </footer>

            <div class="comment-content prose prose-lg max-w-none mb-4">
                <?php comment_text(); ?>
            </div>

            <?php if ($comment->comment_approved == '0') : ?>
                <p class="comment-awaiting-moderation text-lg text-orange-600 mb-4"><?php _e('Your comment is awaiting moderation.', 'typography-theme'); ?></p>
            <?php endif; ?>

            <div class="reply">
                <?php
                comment_reply_link(array_merge($args, array(
                    'depth'      => $depth,
                    'max_depth'  => $args['max_depth'],
                    'reply_text' => __('Reply', 'typography-theme'),
                    'before'     => '<span class="text-lg font-medium text-gray-900 hover:text-gray-600 transition-colors duration-300">',
                    'after'      => '</span>',
                )));
                ?>
            </div>
        </article>
    </li>
    <?php
}