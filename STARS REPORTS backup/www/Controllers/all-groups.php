<?php
Template::includeModel( 'Group' );

$groups = Group::getAll();

if ( isset( $_GET['f'] ) ) {
  $groupFields = explode( ',', $_GET['f'] );
}else {
  header( 'Location: /index.php?q=all-groups&f=0,1,2,3,4,5' );
}

if ( ! empty( $groups ) ) {
  $rows = array();
  $id = $groups[0]->getId();
  $group = new Group( $id );
  $map = $group->getFieldMap();
  $fieldMenu = array();
  $itemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item"> %s </label>';
  $checkedItemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item" checked="true"> %s </label>';
  $i = 0;
  while ( list( $k, $v ) = each( $map ) ) {
    $i = $i + 1;
    list( $title, $fn ) = $map[$k];
    if ( in_array( $k, $groupFields ) ) {
      $item = sprintf( $checkedItemTemplate, $k, $k, $title );
    }else {
      $item = sprintf( $itemTemplate, $k, $k, $title );
    }
    if ( $i % 8 == 0 ) {
      array_push( $fieldMenu, '<br><br>' );
    }
    array_push( $fieldMenu, $item );
  }
  $fieldMenu = '<div id="field-menu-container">' . implode( "\n", $fieldMenu ) . '</div>';
  foreach ( $groups as $group ) {
    $row = array();
    foreach ( $groupFields as $f ) {
      list( $title, $fn ) = $map[$f];
      $value = $group->$fn();
      if ( count( $groupFields ) > 5 && $title != 'Name' ) {
        $value = Template::ellipses( $value, 10 );
      }
      $row[$title] = $value;
    }
    array_push( $rows, $row );
  }
  Template::set( 'rows', $rows );
  Template::set( 'fieldMenu', $fieldMenu );
}
