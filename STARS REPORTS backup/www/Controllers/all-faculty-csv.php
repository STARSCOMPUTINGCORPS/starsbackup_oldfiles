<?php
Template::includeModel( 'Faculty' );

$faculty = Faculty::getAll();

if ( isset( $_GET['f'] ) ) {
  $facultyFields = explode( ',', $_GET['f'] );
}else {
  $facultyFields = range( 0, 11 );
}

if ( ! empty( $faculty ) ) {
  $rows = array();
  $id = $faculty[0]->getId();
  $user = new User( $id );
  $map = $user->getFieldMap();
  $fieldMenu = array();
  $itemTemplate = '<input type="checkbox" value="%s" id="field-%s" class="field-menu-item"> %s ';
  $checkedItemTemplate = '<input type="checkbox" value="%s" id="field-%s" class="field-menu-item" checked="true"> %s ';
  while ( list( $k, $v ) = each( $map ) ) {
    list( $title, $fn ) = $map[$k];
    if ( in_array( $k, $facultyFields ) ) {
      $item = sprintf( $checkedItemTemplate, $k, $k, $title );
    }else {
      $item = sprintf( $itemTemplate, $k, $k, $title );
    }
    array_push( $fieldMenu, $item );
  }
  $fieldMenu = implode( "\n", $fieldMenu );
  foreach ( $faculty as $student ) {
    $row = array();
    foreach ( $facultyFields as $f ) {
      list( $title, $fn ) = $map[$f];
      $value = $student->$fn();
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
header( sprintf( 'Content-disposition: attachment;filename=%s-faculty.csv', date( CONFIG::$dateFormat ) ) );
