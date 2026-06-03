<?php

class Header_Walker extends Walker_Nav_Menu {
  var $last_parent = '';

  private function get_item_classes( $item ) {
		return ! empty( $item->classes ) && is_array( $item->classes ) ? $item->classes : [];
	}

  private function is_current_item( $item ) {
		if ( ! $item ) {
			return false;
		}

		if ( ! empty( $item->current ) ) {
			return true;
		}

		$classes = $this->get_item_classes( $item );
		return in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true );
	}

  private function is_active_trail( $item ) {
		if ( $this->is_current_item( $item ) ) {
			return true;
		}

		$classes = $this->get_item_classes( $item );
		$active_classes = [
			'current-menu-ancestor',
			'current-menu-parent',
			'current_page_parent',
			'current_page_ancestor',
		];

		foreach ( $active_classes as $active_class ) {
			if ( in_array( $active_class, $classes, true ) ) {
				return true;
			}
		}

		return false;
	}

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
		
		$classes = $this->get_item_classes( $item );
		$has_kids = $this->has_children || (!empty($classes) && in_array('menu-item-has-children', $classes, true));
		$is_current = $this->is_current_item( $item );
		$is_active = $this->is_active_trail( $item );

		if ($depth == 0) {
			if ($has_kids) {
				$this->last_parent = $t;
				$curr = $is_current ? ' aria-current="page"' : '';

				$item_class = 'site-header__menu-item site-header__menu-item--dropdown';
				if ( $is_active ) {
					$item_class .= ' site-header__menu-item--active';
				}

				$output .= $indent . '<li class="' . esc_attr( $item_class ) . '">';
				$output .= '<button type="button" class="site-header__menu-button" aria-expanded="false" aria-label="' . esc_attr($t) . ' submenu"' . $curr . '>';
				$output .= '<span>' . esc_html($t) . '</span>';
				$output .= '<span class="site-header__menu-icon">';
				$output .= '<img src="' . esc_url( get_template_directory_uri() . '/resources/images/svgs/header-bottom-arrow.svg' ) . '" alt="" aria-hidden="true" width="11" height="6">';
				$output .= '</span>';
				$output .= '</button>';
			} else {
				$curr = '';
				if ($is_current) {
					$curr = ' aria-current="page"';
				}

				$item_class = 'site-header__menu-item';
				if ( $is_active ) {
					$item_class .= ' site-header__menu-item--active';
				}

				$output .= $indent . '<li class="' . esc_attr( $item_class ) . '">';
				$output .= '<a class="site-header__menu-link" href="' . esc_url($item->url) . '"' . $curr . '>';
				$output .= esc_html($t);
				$output .= '</a>';
			}
		} elseif ($depth == 1) {
			$curr = '';
			if ($is_current) {
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
