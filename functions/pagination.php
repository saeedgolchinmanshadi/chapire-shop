<?php
function pagination($pages = '', $range = 2)
{
    global $paged;
    $current_page = empty($paged) ? 1 : (int) $paged;

    if ($pages == '') {
        global $wp_query;
        $pages = (int) $wp_query->max_num_pages;
    }

    $total_pages = max(1, (int) $pages);
    if ($total_pages <= 1) {
        return;
    }

    $window = max(1, (int) $range);

    $render_page_link = function ($page_number) use ($current_page) {
        $page_number = (int) $page_number;

        if ($page_number === $current_page) {
            echo "<span class=\"page-numbers current persianumber\" aria-current=\"page\">" . esc_html((string) $page_number) . "</span>";
            return;
        }

        echo "<a data-blog='" . esc_url(home_url("blog/page/$page_number")) . "' class='page-numbers persianumber' href='" . esc_url(get_pagenum_link($page_number)) . "'>" . esc_html((string) $page_number) . "</a>";
    };

    echo "<nav class=\"pagination\" aria-label=\"Posts pagination\"><div class=\"nav-links\">";

    if ($current_page > 2) {
        echo "<a data-blog='" . esc_url(home_url('blog/page/1')) . "' class='prev page-numbers' href='" . esc_url(get_pagenum_link(1)) . "' aria-label='First Page'>&laquo;</a>";
    }

    if ($current_page > 1) {
        echo "<a class='prev page-numbers' href='" . esc_url(get_pagenum_link($current_page - 1)) . "' rel='prev' aria-label='Previous Page'>&lsaquo;</a>";
    }

    $start = max(1, $current_page - $window);
    $end = min($total_pages, $current_page + $window);

    if ($start > 1) {
        $render_page_link(1);
        if ($start > 2) {
            echo "<span class='page-numbers dots' aria-hidden='true'>...</span>";
        }
    }

    for ($i = $start; $i <= $end; $i++) {
        $render_page_link($i);
    }

    if ($end < $total_pages) {
        if ($end < $total_pages - 1) {
            echo "<span class='page-numbers dots' aria-hidden='true'>...</span>";
        }
        $render_page_link($total_pages);
    }

    if ($current_page < $total_pages) {
        echo "<a class='next page-numbers' href='" . esc_url(get_pagenum_link($current_page + 1)) . "' rel='next' aria-label='Next Page'>&rsaquo;</a>";
    }

    if ($current_page < $total_pages - 1) {
        echo "<a data-blog='" . esc_url(home_url("blog/page/$total_pages")) . "' class='next page-numbers' href='" . esc_url(get_pagenum_link($total_pages)) . "' aria-label='Last Page'>&raquo;</a>";
    }

    echo "</div></nav>\n";
}
