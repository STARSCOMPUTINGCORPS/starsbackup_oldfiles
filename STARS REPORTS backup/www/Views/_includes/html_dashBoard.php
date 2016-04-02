<?php
require('Models/Dashboard.php');
$theDashboard = new Dashboard();

//$theGpa = $theDashboard->getAvgGPA();
//$TotalStu = $theDashboard->getEthnicStu();
//$TotalMembers = $theDashboard->getTotalMembers();
//$theTotals=array();
$theTotals=$theDashboard->getAll();
//$thisTotal=$theTotals['2'];
//$ethnicGendProfileType = $_GET["ethnicGendProfileType"];
//$ethnicGendEthnicity   = $_GET["ethnicGendEthnicity"];

?>

<hr size=7 COLOR="green">  <!--Green line seperating navigation from table-->
</br></br>
<h2>The following is quick information at a glance</h2>

</br></br>
	<table id="dataTable">
    <thead>
      <tr>
        <?php
       
        $format_th = "<th>%s</th>\n";
        while(list($th, $td) = each($theTotals[0])){
          echo sprintf($format_th, $th);
        }
        ?>
      </tr>
	  </thead>
	<tbody>
      <?php
      $format_td = "<td>%s</td>\n";
      foreach($theTotals as $row){
	                                              
        echo "<tr>\n";
        while(list($th,$td) = each($row)){
           echo sprintf( $format_td, htmlentities($td));
         }
         echo "</tr>\n";
      }
      ?>
    </tbody>
</table>
</div>

 
































