<?php
Template::includeModel( 'Alumnus' );

$alumni = Alumnus::getAll();

if ( isset( $_GET['f'] ) ) {
  $alumnusFields = explode( ',', $_GET['f'] );
}else {
  $alumnusFields = range( 0, 11 );
}

if ( ! empty( $alumni ) ) {
  $rows = array();
  $id = $alumni[0]->getId();
  $user = new Alumnus( $id );
  $map = $user->getFieldMap();
  $fieldMenu = array();
  $itemTemplate = '<input type="checkbox" value="%s" id="field-%s" class="field-menu-item"> %s ';
  $checkedItemTemplate = '<input type="checkbox" value="%s" id="field-%s" class="field-menu-item" checked="true"> %s ';
  while ( list( $k, $v ) = each( $map ) ) {
    list( $title, $fn ) = $map[$k];
    if ( in_array( $k, $alumnusFields ) ) {
      $item = sprintf( $checkedItemTemplate, $k, $k, $title );
    }else {
      $item = sprintf( $itemTemplate, $k, $k, $title );
    }
    array_push( $fieldMenu, $item );
  }
  $fieldMenu = implode( "\n", $fieldMenu );
  foreach ( $alumni as $alumnus ) {
    $row = array();
    foreach ( $alumnusFields as $f ) {
      list( $title, $fn ) = $map[$f];
      $value = $alumnus->$fn();
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
header( sprintf( 'Content-disposition: attachment;filename=%s-alumni.csv', date( CONFIG::$dateFormat ) ) );
