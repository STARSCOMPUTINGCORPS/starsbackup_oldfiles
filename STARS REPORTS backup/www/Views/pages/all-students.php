<?php Template::includeTemplate('html_header.php'); ?>
<div role="main" id="main">
  <?php Template::includeTemplate( 'html_navigation.php' ); ?><br>
  <br>
  <?= Template::get('fieldMenu') ?><br>
  <br>
  <a href="" id="update-table">Update Table</a> - <a href="" id="csv-download-anchor">Download CSV file</a><br>
  <br>
  <table id="dataTable">
    <thead>
      <tr>
        <?php
        $rows = Template::get( 'rows' );
        $format_th = "<th>%s</th>\n";
        while(list($th, $td) = each($rows[0])){
          echo sprintf($format_th, $th);
        }
        ?>
      </tr>
    </thead>
	
    <tbody>
      <?php
      $format_td = "<td>%s</td>\n";
      foreach($rows as $row){
        echo "<tr>\n";
        while(list($th, $td) = each($row)){
           echo sprintf( $format_td, htmlentities($td));
         }
         echo "</tr>\n";
      }
      ?>
    </tbody>
  </table>
</div>
<?php Template::includeTemplate( 'html_footer.php' ); ?>
