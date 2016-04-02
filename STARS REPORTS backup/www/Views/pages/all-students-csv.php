<?php
$rows = Template::get( 'rows' );
$format = '%s, ';
$header_row = array();
while ( list( $header, $value ) = each( $rows[0] ) ) {
  array_push( $header_row, $header );
}
$header_row = join( $header_row, ', ' ) . "\n";
echo $header_row;
foreach ( $rows as $row ) {
  $data_row = array();
  while ( list( $header, $value ) = each( $row ) ) {
    array_push( $data_row, $value );
  }
  $data_row = join( $data_row, ', ' ) . "\n";
  echo $data_row;
}
