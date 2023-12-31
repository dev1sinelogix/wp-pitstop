<?php
include("calcula_stats_pie.php");

  echo '<script type="text/javascript">';
  echo 'var stopbadbots_pie = [';

  echo '{label: "Blocked by Nickname", data: '.esc_attr($stopbadbots_results10[0]['nick']).', color: "#005CDE" },';
  echo '{label: "Blocked by IP", data: '.esc_attr($stopbadbots_results10[0]['ip']).', color: "#00A36A" },';
  echo '{label: "Bad Referrer", data: '.esc_attr($stopbadbots_results10[0]['referrer']).', color: "#DE000F" },';

  echo '{label: "Brute Force Login", data: '.esc_attr($stopbadbots_results10[0]['brute']).', color: "#992B00" },';
  echo '{label: "User Enumeration", data: '.esc_attr($stopbadbots_results10[0]['enumeration']).', color: "#7D0096" },';

  echo '{label: "PingBack", data: '.esc_attr($stopbadbots_results10[0]['pingback']).', color: "#ED7B00" },';
  echo '{label: "Comment Form", data: '.esc_attr($stopbadbots_results10[0]['comment']).', color: "#C0C0C0" },';
  echo '{label: "Contact Form", data: '.esc_attr($stopbadbots_results10[0]['contact']).', color: "#FFFF00" },';
  echo '{label: "Blank User Agent", data: '.esc_attr($stopbadbots_results10[0]['agent']).', color: "#000000" },';
  echo '{label: "Fake Browser", data: '.esc_attr($stopbadbots_results10[0]['browser']).', color: "#CCCCCC" },';




  if(!empty($stopbadbots_checkversion))
{
  echo '{label: "Firewall", data: '.esc_attr($stopbadbots_results10[0]['firewall']).', color: "#FF00FF" },';
  echo '{label: "False Google & Microsoft", data: '.esc_attr($stopbadbots_results10[0]['false_se']).', color: "#97c4f7" },';


  echo '{label: "Using HTTP Tools", data: '.esc_attr($stopbadbots_results10[0]['httptools']).', color: "#ed9aaf" },';
  echo '{label: "Blocked by Rating", data: '.esc_attr($stopbadbots_results10[0]['rating']).', color: "#90f687" }';

}

else
{
  echo '{label: "Disabled-Firewall", data: '.esc_attr($stopbadbots_results10[0]['firewall']).', color: "#FF00FF" },';
  echo '{label: "Disabled-False Google/MSN", data: '.esc_attr($stopbadbots_results10[0]['false_se']).', color: "#97c4f7" },';

  echo '{label: "Disabled Using HTTP Tools", data: '.esc_attr($stopbadbots_results10[0]['httptools']).', color: "#ed9aaf" },';
  echo '{label: "Disabled Blocked by Rating", data: '.esc_attr($stopbadbots_results10[0]['rating']).', color: "#90f687" }';


} 

echo '];';
?>

function legendFormatter(label, series) {
    return '<div ' + 
           'style="font-size:10pt;text-align:left;padding:0px;line-height:6px;">' +
           label + '</div>';
};

var stopbadbots_pie_options = {
    series: {
        pie: {
            show: true,
            innerRadius: 0.5,
            // radius: 0.8,
            label: {
                show: false,
                formatter: legendFormatter,
            }
        }
    },

                 /*
                              legend: {
                      show: true, 
                      //show or hide legend
                      labelFormatter: null or (fn: string, series object -> string)
                      //formatting your legend label by using custom functions
                      labelBoxBorderColor: color
                      //label border color
                      noColumns: number
                      //number of legend columns
                      position: "ne" or "nw" or "se" or "sw"   
                      //legend position (north east, north west, south east, south west)
                      margin: number of pixels or [x margin, y margin]
                      backgroundColor: null or color
                      backgroundOpacity: number between 0 and 1
                      container: null or jQuery object/DOM element/jQuery expression        
                  }
                  */

  legend: {
     show: true,
     noColumns: 1,
     labelFormatter: legendFormatter
  }
};
jQuery(document).ready(function () {
  jQuery.plot(jQuery("#stopbadbots_flot-placeholder_pie"), stopbadbots_pie, stopbadbots_pie_options);
});

</script>
<div id="stopbadbots_flot-placeholder_pie" style="width:400px;height:140px;margin:-17px 0 auto"></div>
