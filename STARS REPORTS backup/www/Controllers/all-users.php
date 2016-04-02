<?php
Template::includeModel( 'User' );

$users = User::getAll();

if ( isset( $_GET['f'] ) ) {
  $userFields = explode( ',', $_GET['f'] );
}else {
  header( 'Location: /index.php?q=all-users&f=0,1,2,3,4,5,6,7,8,9,10,11' );
}

if ( ! empty( $users ) ) {
  $rows = array();
  $id = $users[0]->getId();
  $user = new User( $id );
  $map = $user->getFieldMap();
  $fieldMenu = array();
  $itemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item"> %s </label>';
  $checkedItemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item" checked="true"> %s </label>';
  $i = 0;
  while ( list( $k, $v ) = each( $map ) ) {
    $i = $i + 1;
    list( $title, $fn ) = $map[$k];
    if ( in_array( $k, $userFields ) ) {
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
  foreach ( $users as $user ) {
    $row = array();
    foreach ( $userFields as $f ) {
      list( $title, $fn ) = $map[$f];
      $value = $user->$fn();
      if ( count( $userFields ) > 5 ) {
        $value = Template::ellipses( $value, 10 );
      }
      $row[$title] = $value;
    }
    array_push( $rows, $row );
  }
  Template::set( 'rows', $rows );
  Template::set( 'fieldMenu', $fieldMenu );
}
