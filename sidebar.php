<?php
/**
 * Sidebar template
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area lg:w-80 lg:ml-12 mt-12 lg:mt-0">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>