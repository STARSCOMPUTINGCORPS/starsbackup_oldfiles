<?php
Template::includeModel( 'Group' );

$groups = Group::getAll();

if ( isset( $_GET['f'] ) ) {
  $groupFields = explode( ',', $_GET['f'] );
}else {
  header('Location: /index.php?q=all-groups-csv&f=0,1,2,3,4,5');
}

if ( ! empty( $groups ) ) {
  $rows = array();
  $id = $groups[0]->getId();
  $group = new Group( $id );
  $map = $group->getFieldMap();
  $fieldMenu = array();
  $itemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item"> %s </label>';
  $checkedItemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item" checked="true"> %s </label>';
  while ( list( $k, $v ) = each( $map ) ) {
    list( $title, $fn ) = $map[$k];
    if ( in_array( $k, $groupFields ) ) {
      $item = sprintf( $checkedItemTemplate, $k, $k, $title );
    }else {
      $item = sprintf( $itemTemplate, $k, $k, $title );
    }
    array_push( $fieldMenu, $item );
  }
  $fieldMenu = implode( "\n", $fieldMenu );
  foreach ( $groups as $group ) {
    $row = array();
    foreach ( $groupFields as $f ) {
      list( $title, $fn ) = $map[$f];
      $value = $group->$fn();
      // Safe for CSV format
      $row[$title] = '"' . $value . '"';
    }
    array_push( $rows, $row );
  }
  Template::set( 'rows', $rows );
  Template::set( 'fieldMenu', $fieldMenu );
}

// Force download of a CSV file
header( 'Content-type: text/csv; charset=utf-8' );
header( sprintf( 'Content-disposition: attachment;filename=%s-groups.csv', date( CONFIG::$dateFormat ) ) );