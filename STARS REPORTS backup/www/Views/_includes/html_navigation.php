<?php
include_once 'Models/User.php';

$anchorTemplate = '<a href="/?q=%s" class="%s" title="">%s</a>';
$currentAnchorTemplate = '<font size="5" color="#990000"><a href="/?q=%s" class="%s" title="">%s</a></font>';
$menuItems = array();
$menuItems['Homepage'] = 'homepage';
$menuItems['All Students'] = 'all-students';
$menuItems['All Faculty'] = 'all-faculty';
$menuItems['All Alumni'] = 'all-alumni';
//$menuItems['All Groups'] = 'all-groups';
//$menuItems['All Discussions'] = 'all-discussions';
//$menuItems['All Documents'] = 'all-documents';
//$menuItems['All Events'] = 'all-events';
//$menuItems['All Albums'] = 'all-albums';
$menuItems['All Users'] = 'all-users';
//ksort($menuItems);                            //  will sort the navigation buttons alphabetically
$menuItems['<b>Log out</b>'] = 'logout';

$disabled = array();
array_push($disabled, 'all-discussions');
array_push($disabled, 'all-documents');
array_push($disabled, 'all-events');
array_push($disabled, 'all-albums');

$updated=User::lastUpdated();
   
$navigation = '';
$a = null;
while (list($k, $v) = each($menuItems)){
  $class = '';
  if(in_array($v, $disabled)){
    $class = 'disabled';
  }

  if(isset($_GET['q']) && $_GET['q'] != $v){
      $a = sprintf($anchorTemplate . ' - ', $v, $class, $k);
    }else{
        $a = sprintf($currentAnchorTemplate . ' - ', $v, $class, $k);
    }

  $navigation  = $navigation . $a;
}
echo '<b>LAST UPDATED ON </b>'.$updated;
echo $navigation = '<div id="navigation">'.'<!-- <a href="dataBase/index.php"> --><a class="disabled">Update Database </a>- '. trim($navigation, ' -') . '</div>'.'<br><div id="navigation">'.'<a href="viz/vis_Ethnicity.html"> STARS Ethnicity Visualization </a> '.'</div>';

