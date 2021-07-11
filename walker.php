<?
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {


public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
  if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
    $t = '';
    $n = '';
  } else {
    $t = "\t";
    $n = "\n";
  }
  $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

  $classes = empty( $item->classes ) ? array() : (array) $item->classes;
  $classes[] = 'menu-item-' . $item->ID;

  $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

  $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
  $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

  $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
  $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
  $page_id = 'data-id="'.get_translated_post_ids($item->object_id).'"';
      $image = 'style="background-image: url('.get_the_post_thumbnail_url( $item->object_id, 'full' ).');"';

  $output .= $indent . '<li' . $id . $class_names . $image . $page_id.'>';

  $atts = array();
  $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
  $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
  $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
  $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

  $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

  $attributes = '';
  foreach ( $atts as $attr => $value ) {
    if ( ! empty( $value ) ) {
      $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
      $attributes .= ' ' . $attr . '="' . $value . '"';
    }
  }

  $title = apply_filters( 'the_title', $item->title, $item->ID );
  $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

  $item_output = $args->before;
  $item_output .= '<a'. $attributes .'>';
  $item_output .= $args->link_before . $title . $args->link_after;
  $item_output .= '</a>';
  $item_output .= $args->after;

  $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}



class Mobile_Walker_Nav_Menu extends Walker_Nav_Menu {
public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
  if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
    $t = '';
    $n = '';
  } else {
    $t = "\t";
    $n = "\n";
  }
  $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

  $classes = empty( $item->classes ) ? array() : (array) $item->classes;
  $classes[] = 'menu-item-' . $item->ID;

  $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

  $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
  $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

  $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
  $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
  $page_id = 'data-id="'.get_translated_post_ids($item->object_id).'"';
  $image = 'style="background-image: url('.get_the_post_thumbnail_url( $item->object_id, 'full' ).');"';

  if($depth == 1) {
    $output .= $indent . '<li' . $id . $class_names . $image . $page_id.'>';
}
else {
    $output .= $indent . '<li' . $id . $class_names . $page_id.'>';
}


  $atts = array();
  $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
  $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
  $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
  $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

  $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

  $attributes = '';
  foreach ( $atts as $attr => $value ) {
    if ( ! empty( $value ) ) {
      $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
      $attributes .= ' ' . $attr . '="' . $value . '"';
    }
  }

  $title = apply_filters( 'the_title', $item->title, $item->ID );
  $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

  $item_output = $args->before;
  $item_output .= '<a'. $attributes .'>';
  $item_output .= $args->link_before . $title . $args->link_after;
  $item_output .= '</a>';
  $item_output .= $args->after;

  $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
public function start_lvl( &$output, $depth = 0, $args = null ) {
  if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
    $t = '';
    $n = '';
  } else {
    $t = "\t";
    $n = "\n";
  }
  $indent = str_repeat( $t, $depth );

  // Default class.
  $classes = array( 'sub-menu header__menu_conduct' );

  $class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
  $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

  $output .= "{$n}{$indent}<ul$class_names>{$n}";
}


public function end_lvl( &$output, $depth = 0, $args = null ) {
  if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
    $t = '';
    $n = '';
  } else {
    $t = "\t";
    $n = "\n";
  }
  $indent  = str_repeat( $t, $depth );
  $output .= "$indent</ul>{$n}";
}


}
