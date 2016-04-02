<?php
Template::includeModel( 'User' );

$users = User::getAll();

if ( isset( $_GET['f'] ) ) {
  $userFields = explode( ',', $_GET['f'] );
}else {
  $userFields = range( 0, 11 );
}

if ( ! empty( $users ) ) {
  $rows = array();
  $id = $users[0]->getId();
  $user = new User( $id );
  $map = $user->getFieldMap();
  $fieldMenu = array();
  $itemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item"> %s </label>';
  $checkedItemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item" checked="true"> %s </label>';
  while ( list( $k, $v ) = each( $map ) ) {
    list( $title, $fn ) = $map[$k];
    if ( in_array( $k, $userFields ) ) {
      $item = sprintf( $checkedItemTemplate, $k, $k, $title );
    }else {
      $item = sprintf( $itemTemplate, $k, $k, $title );
    }
    array_push( $fieldMenu, $item );
  }
  $fieldMenu = implode( "\n", $fieldMenu );
  foreach ( $users as $user ) {
    // TODO Have fetch collect the user type.
    $row = array();
    foreach ( $userFields as $f ) {
      list( $title, $fn ) = $map[$f];
      $value = $user->$fn();
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
header( sprintf( 'Content-disposition: attachment;filename=%s-users.csv', date( CONFIG::$dateFormat ) ) );
