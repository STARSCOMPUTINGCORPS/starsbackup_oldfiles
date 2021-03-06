<?php
Template::includeModel( 'Alumnus' );

$alumni = Alumnus::getAll();

if ( isset( $_GET['f'] ) ) {
  $alumnusFields = explode( ',', $_GET['f'] );
}else {
  header( 'Location: /index.php?q=all-alumni&f=0,1,2,3,4,5,6,8,9' );
}

if ( ! empty( $alumni ) ) {
  $rows = array();
  $id = $alumni[0]->getId();
  $user = new Alumnus( $id );
  $map = $user->getFieldMap();
  $fieldMenu = array();
  $itemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item"> %s </label>';
  $checkedItemTemplate = '<label><input type="checkbox" value="%s" id="field-%s" class="field-menu-item" checked="true"> %s </label>';
  $i = 0;
  while ( list( $k, $v ) = each( $map ) ) {
    $i = $i + 1;
    list( $title, $fn ) = $map[$k];
    if ( in_array( $k, $alumnusFields ) ) {
      $item = sprintf( $checkedItemTemplate, $k, $k, $title );
    }else {
      $item = sprintf( $itemTemplate, $k, $k, $title );
    }
    if ( $i % 8 == 0) {
      array_push($fieldMenu, '<br><br>' );
    }
    array_push( $fieldMenu, $item );
  }
  $fieldMenu = '<div id="field-menu-container">' . implode( "\n", $fieldMenu ) . '</div>';
  foreach ( $alumni as $alumnus ) {
    $row = array();
    foreach ( $alumnusFields as $f ) {
      list( $title, $fn ) = $map[$f];
      $value = $alumnus->$fn();
      if ( count( $alumnusFields ) > 5 ) {
        $value = Template::ellipses( $value, 10 );
      }
      $row[$title] = $value;
    }
    array_push( $rows, $row );
  }
  Template::set( 'rows', $rows );
  Template::set( 'fieldMenu', $fieldMenu );
}
