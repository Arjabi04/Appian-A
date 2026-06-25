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

$dom = new DOMDocument('1.0', 'UTF-8');
libxml_use_internal_errors(true);
$dom->loadHTML(
    '<?xml encoding="utf-8" ?><div id="gi-root">' . $content . '</div>',
    LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
);
libxml_clear_errors();

$root = $dom->getElementsByTagName('div')->item(0);
if (! $root) {
    echo $content;
    return;
}

$children = [];
foreach ($root->childNodes as $node) {
    $children[] = $node;
}

$output = '';
$i = 0;
$count = count($children);

while ($i < $count) {
    $node = $children[$i];

    if ($node->nodeType === XML_TEXT_NODE && trim($node->nodeValue) === '') {
        $i++;
        continue;
    }

    $tag = strtolower($node->nodeName);

    if (in_array($tag, ['h2', 'h3', 'h4'])) {
        // Get heading text content
        $heading_text = $node->textContent;

        // Build heading with original classes
        $wrapper_inner = '<h4 class="content-information__title h4 m-0">'
            . esc_html($heading_text)
            . '</h4>';
        $i++;

        while ($i < $count) {
            $next = $children[$i];

            if ($next->nodeType === XML_TEXT_NODE && trim($next->nodeValue) === '') {
                $i++;
                continue;
            }

            if (strtolower($next->nodeName) === 'p') {
                // Get inner HTML of p to preserve <br> tags
                $p_inner = '';
                foreach ($next->childNodes as $child) {
                    $p_inner .= $dom->saveHTML($child);
                }
                $wrapper_inner .= '<p class="content-information__description body-large">'
                    . $p_inner
                    . '</p>';
                $i++;
            } else {
                break;
            }
        }

        $output .= '<div class="content-information__text-content d-flex flex-column">'
            . $wrapper_inner
            . '</div>';
        continue;
    }

    if ($tag === 'figure') {
        $imgs = $node->getElementsByTagName('img');
        if ($imgs->length > 0) {
            $img_node = $imgs->item(0);
            $img_node->removeAttribute('width');
            $img_node->removeAttribute('height');
            $img_node->removeAttribute('sizes');
            $img_node->removeAttribute('srcset');
            $img_node->setAttribute('class', trim($img_node->getAttribute('class') . ' js-animate-image'));
            $img_node->setAttribute('loading', 'lazy');
            $output .= $dom->saveHTML($img_node);
        }
        $i++;
        continue;
    }

    if ($tag === 'img') {
        $node->setAttribute('class', trim($node->getAttribute('class') . ' js-animate-image'));
        $node->setAttribute('loading', 'lazy');
        $output .= $dom->saveHTML($node);
        $i++;
        continue;
    }

    $output .= $dom->saveHTML($node);
    $i++;
}
?>
<section class="content-information">
    <div class="content-information__wrapper grid-container grid-row">
        <div class="content-information__content">
            <?php echo $output; ?>
        </div>
    </div>
</section>
