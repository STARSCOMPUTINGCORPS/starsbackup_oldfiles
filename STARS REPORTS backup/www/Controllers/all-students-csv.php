<?php
Template::includeModel( 'Student' );

$students = Student::getAll();

if ( isset( $_GET['f'] ) ) {
  $studentFields = explode( ',', $_GET['f'] );
}else {
  $studentFields = range( 0, 11 );
}

if ( ! empty( $students ) ) {
  $rows = array();
  $id = $students[0]->getId();
  $user = new User( $id );
  $map = $user->getFieldMap();
  $fieldMenu = array();
  $itemTemplate = '<input type="checkbox" value="%s" id="field-%s" class="field-menu-item"> %s ';
  $checkedItemTemplate = '<input type="checkbox" value="%s" id="field-%s" class="field-menu-item" checked="true"> %s ';
  while ( list( $k, $v ) = each( $map ) ) {
    list( $title, $fn ) = $map[$k];
    if ( in_array( $k, $studentFields ) ) {
      $item = sprintf( $checkedItemTemplate, $k, $k, $title );
    }else {
      $item = sprintf( $itemTemplate, $k, $k, $title );
    }
    array_push( $fieldMenu, $item );
  }
  $fieldMenu = implode( "\n", $fieldMenu );
  foreach ( $students as $student ) {
    $row = array();
    foreach ( $studentFields as $f ) {
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
header( sprintf( 'Content-disposition: attachment;filename=%s-students.csv', date( CONFIG::$dateFormat ) ) );
