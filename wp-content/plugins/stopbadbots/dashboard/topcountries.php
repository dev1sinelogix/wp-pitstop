<?php /**
 * @author William Sergio Minossi
 * @copyright 2018
 */
 
/*
 CREATE TABLE `wp_sbb_badips` (
  `id` mediumint(9) NOT NULL,
  `botip` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `botobs` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `botstate` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `botblocked` mediumint(9) NOT NULL,
  `botdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `botflag` varchar(1) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

  `botcountry` varchar(2) NOT NULL,

*/

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $wpdb;
$table_name = $wpdb->prefix . "sbb_badips";
$table_name2 = $wpdb->prefix . "sbb_blacklist";

$query = "SELECT * FROM " . $table_name . " WHERE botblocked > 0 group by botcountry order by botblocked DESC limit 10";
//$query = "SELECT botcountry, SUM(botblocked) as amount FROM " . $table_name . " UNION SELECT *  " .$table_name2 ." group by botcountry order by amount DESC";

//$query = "SELECT botcountry, botblocked FROM " . $table_name . " UNION SELECT botcountry, botblocked FROM " .$table_name2 ."  order by botcountry DESC ";




$results9 = $wpdb->get_results($query);
if($wpdb->num_rows < 1)
{
    echo 'No bots blocked by IP. Please, try again tomorrow';
    return;
}

 $image_flags = '1';
foreach($results9 as $bot){
        $country = strtolower($bot->botcountry.'.png');
        $file = STOPBADBOTSPATH.'assets/images/flags/'.$country;
        if(!file_exists($file))
          $image_flags = '0';    

}
// $image_flags = '0';

echo '<table class="greyGridTable">';
echo '<thead>';
if($image_flags)
   echo "<tr><th>Bot <br> Country</th> <th>Num <br />Blocked</th></tr>";
else
   echo "<tr><th>Bot <br />COUNTRY</th>  <th>Num <br />Blocked</th></tr>";

echo '</thead>';
$count = 0;
foreach($results9 as $bot){
    if( $count > 0 )
       echo "</tr>";
            
    echo "<tr>";  
    if($image_flags)
    {
        echo "<td>";
            $country = strtolower(esc_attr($bot->botcountry).'.png');
            $file = STOPBADBOTSURL.'assets/images/flags/'.$country;
            echo '<img class="stopbadbots_flags" src="'.esc_attr($file).'" alt="'.esc_attr($bot->botcountry).'"  width="19px" />';
    
        // echo $bot->botcountry;
        
        echo "</td>";
    }  
    else
    {
        echo "<td>";
        echo esc_attr($bot->botcountry);
        echo "</td>";
    } 
       
    
    echo "<td>";
    echo esc_attr($bot->botblocked);
    echo "</td>";    
    echo "</tr>";
       $count++;
       
    if($count > 9)
       break;
       
}
echo "</table>";  