<?php
$project_id = get_query_var('detail_project_id');

if (empty($project_id)) {
    return;
}

$raw_content = get_post_field('post_content', $project_id);

if (empty(trim($raw_content))) {
    return;
}

$content = apply_filters('the_content', $raw_content);

if (empty(trim(wp_strip_all_tags($content)))) {
    return;
}
?>
<section class="content-information">
    <div class="content-information__wrapper grid-container grid-row">
        <div class="content-information__content">
            <?php echo $content; ?>
        </div>
    </div>
</section>
