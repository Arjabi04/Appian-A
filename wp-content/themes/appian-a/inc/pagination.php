<?php

function render_projects_pagination($query, $current_page) {
    $total_pages = (int) $query->max_num_pages;

    if ($total_pages <= 1) {
        return '';
    }

    $current_page = max(1, (int) $current_page);

    ob_start();
    ?>
    <ul class="pagination our-projects__pagination justify-content-center mb-0 d-flex list-unstyled">
        <li class="page-item<?php echo $current_page <= 1 ? ' disabled' : ''; ?>">
            <a class="page-link our-projects__page-arrow our-projects__page-arrow--prev"
               href="<?php echo $current_page > 1 ? esc_url(add_query_arg('paged', $current_page - 1)) : '#'; ?>"
               aria-label="Previous">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/arrow-down.svg'); ?>" alt="" aria-hidden="true" />
            </a>
        </li>

        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item<?php echo $i === $current_page ? ' active' : ''; ?>"<?php echo $i === $current_page ? ' aria-current="page"' : ''; ?>>
                <a class="page-link our-projects__page-link nav-text" href="<?php echo esc_url(add_query_arg('paged', $i)); ?>">
                    <?php echo (int) $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <li class="page-item<?php echo $current_page >= $total_pages ? ' disabled' : ''; ?>">
            <a class="page-link our-projects__page-arrow our-projects__page-arrow--next"
               href="<?php echo $current_page < $total_pages ? esc_url(add_query_arg('paged', $current_page + 1)) : '#'; ?>"
               aria-label="Next">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/arrow-down.svg'); ?>" alt="" aria-hidden="true" />
            </a>
        </li>
    </ul>
    <?php
    return ob_get_clean();
}