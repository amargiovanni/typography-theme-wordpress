<form role="search" method="get" class="search-form mt-8" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="block">
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'typography-theme'); ?></span>
        <div class="relative">
            <input type="search" 
                   class="search-field w-full px-6 py-4 text-xl border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent" 
                   placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'typography-theme'); ?>" 
                   value="<?php echo get_search_query(); ?>" 
                   name="s" />
            <button type="submit" 
                    class="search-submit absolute right-2 top-1/2 transform -translate-y-1/2 px-6 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-700 transition-colors duration-300">
                <?php echo esc_attr_x('Search', 'submit button', 'typography-theme'); ?>
            </button>
        </div>
    </label>
</form>