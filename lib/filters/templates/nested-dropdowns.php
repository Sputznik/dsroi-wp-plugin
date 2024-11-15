<?php
global $dsroi_search_filter;
$terms      = $dsroi_search_filter->getNestedTerms( $args );
$param      = "tax_" . $args['typeval'];
$name_param = $param . "[]";
$values     = isset( $_GET[ $param ] ) ? $_GET[ $param ] : array();

$parent_param = 'parent_' . $args['typeval'];
$parent_value = isset( $_GET[ $parent_param ] ) ? $_GET[ $parent_param ] : ( is_array( $values ) && count( $values ) ? $values[0] : "" );

$parent_atts = array(
  'label'		=> $args['label'],
  'name'    => $name_param,
  'items'		=> $terms['cats'],
  'value'   => $parent_value
);

$child_value = isset( $_GET[ $parent_param ] ) && is_array( $values ) && count( $values ) ? $values[0] : ( ( is_array( $values ) && count( $values ) > 1 ) ? $values[1] : "" );

$child_atts = array(
  'name'    => $name_param,
  'items'		=> $terms['subcats'],
  'value'   => $child_value
);
?>
<div data-behaviour='dsroi-nested-dropdown'>
  <div class="cats"><?php $args = $parent_atts; include( 'dropdown.php'); ?></div>
  <div class="subcats"><?php $args = $child_atts; include( 'dropdown.php'); ?></div>
</div>
