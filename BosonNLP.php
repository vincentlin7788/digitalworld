<?php
header("Content-Type:text/html; charset=utf-8");
$API_TOKEN = "Pr2ILbhb.9843.9XDLhlD9DUio";
$SENTIMENT_URL = 'http://api.bosonnlp.com/sentiment/analysis?news';


function __fgetcsv(&$handle, $length = null, $d = ",", $e = '"') {
 $d = preg_quote($d);
 $e = preg_quote($e);
 $_line = "";
 $eof=false;
 while ($eof != true) {
  $_line .= (empty ($length) ? fgets($handle) : fgets($handle, $length));
  $itemcnt = preg_match_all('/' . $e . '/', $_line, $dummy);
  if ($itemcnt % 2 == 0){
   $eof = true;
  }
 }
 $_line = iconv("big5","utf-8//ignore",addslashes($_line));

 $_csv_line = preg_replace('/(?: |[ ])?$/', $d, trim($_line));
 
 $_csv_pattern = '/(' . $e . '[^' . $e . ']*(?:' . $e . $e . '[^' . $e . ']*)*' . $e . '|[^' . $d . ']*)' . $d . '/';
 preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
 $_csv_data = $_csv_matches[1];
 
 for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++) {
  $_csv_data[$_csv_i] = preg_replace("/^" . $e . "(.*)" . $e . "$/s", "$1", $_csv_data[$_csv_i]);
  $_csv_data[$_csv_i] = str_replace($e . $e, $e, $_csv_data[$_csv_i]);
  
 }

 return empty ($_line) ? false : $_csv_data;
}
/*
header("Content-Type:text/html; charset=utf-8");
$row = 1;
if (($handle = fopen("testexcel_N.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
var_dump($data);
*/

/*
$your_file_path = "isentia raw testing.xlsx";

$content = file_get_contents($your_file_path); 
$lines = array_map("rtrim", explode("\n", $content));
var_dump($content);
echo utf8_encode($lines);
*/
$row = 0;
$get_content = [];

if (($handle = fopen("isentia raw testing.csv", "r")) !== FALSE) {
    while (($data = __fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        
        
            $get_content[$row] = (string)$data[18];
        $row++;
    }
    fclose($handle);
}

//var_dump($get_content);
//print_r ($get_content);
/*
$handle = fopen("isentia raw testing.csv", "r");
$data = fgetcsv($handle, 1000, ",");
var_dump($data);
echo ($data[16]);
*/

$data1 = $get_content;
//$data1 = array('这家味道还不错', '這個菜實是太爛了,不能再差了');

print_r ($data1);

$ch = curl_init();
curl_setopt_array($ch, array(
  CURLOPT_URL => $SENTIMENT_URL,
  CURLOPT_HTTPHEADER => array(
   "Accept:application/json",
   "Content-Type: application/json",
   "X-Token: $API_TOKEN",
  ),
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => json_encode($data1, JSON_UNESCAPED_UNICODE),
  CURLOPT_RETURNTRANSFER => true,
));

$result = curl_exec($ch);
var_dump(json_decode($result));

curl_close($ch);






/*
<!DOCTYPE HTML>

<html>
  <head>
<meta charset="utf-8">
 <title>
 Create Google Charts
 </title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="alasql.min.js"></script>
<script src='xlsx.core.min.js'></script>
<script>
    alasql('select * from xlsx("testingexcel1.xlsx",{headers:true, sheetid:"Sheet1", range:"A1:A6"})',
           [],function(data) {
                console.log(data);
    });
	
</script>
	  </head>
  <body>
  
    </body>
</html>

*/
?>