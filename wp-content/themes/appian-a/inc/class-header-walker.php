<?php

class Header_Walker extends Walker_Nav_Menu {
  var $last_parent = '';

  function start_lvl( &$output, $depth = 0, $args = null ) {
    $indent = str_repeat( "\t", $depth );
    $lbl = 'submenu';
    if(!empty($this->last_parent)) {
        $lbl = $this->last_parent . ' submenu';
    }
    $output .= "\n$indent<ul class=\"site-header__dropdown\" aria-label=\"" . esc_attr( $lbl ) . "\">\n";
  }

  function end_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
  }

  function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$t = apply_filters('the_title', $item->title, $item->ID);
		
		$has_kids = $this->has_children || (!empty($item->classes) && in_array('menu-item-has-children', $item->classes));

		if ($depth == 0) {
			if ($has_kids) {
				$this->last_parent = $t;

				$output .= $indent . '<li class="site-header__menu-item site-header__menu-item--dropdown">';
				$output .= '<button type="button" class="site-header__menu-button" aria-expanded="false" aria-label="' . esc_attr($t) . ' submenu">';
				$output .= '<span>' . esc_html($t) . '</span>';
				$output .= '<span class="site-header__menu-icon">';
				
				$svg = function_exists('appian_get_svg_icon') ? appian_get_svg_icon('arrow-down') : '';
				if (empty($svg)) {
					$svg = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="square"/></svg>';
				}
				$output .= $svg;
				$output .= '</span>';
				$output .= '</button>';
			} else {
				$curr = '';
				if (!empty($item->current) || (!empty($item->classes) && in_array('current-menu-item', $item->classes))) {
					$curr = ' aria-current="page"';
				}

				$output .= $indent . '<li class="site-header__menu-item">';
				$output .= '<a class="site-header__menu-link" href="' . esc_url($item->url) . '"' . $curr . '>';
				$output .= esc_html($t);
				$output .= '</a>';
			}
		} elseif ($depth == 1) {
			$curr = '';
			if (!empty($item->current) || (!empty($item->classes) && in_array('current-menu-item', $item->classes))) {
				$curr = ' aria-current="page"';
			}

			$output .= $indent . '<li class="site-header__dropdown-item">';
			$output .= '<a class="site-header__dropdown-link" href="' . esc_url($item->url) . '"' . $curr . '>';
			$output .= esc_html($t);
			$output .= '</a>';
		}
  }

  function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= "</li>\n";
  }
}
