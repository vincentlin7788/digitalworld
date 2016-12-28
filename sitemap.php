<?php
header('Content-type: application/xml; charset="GB2312"',true);
?>
<?php
$website = "https://vincentlin7788.github.io"; /* 将此http://www.grzz.com.cn改成你的域名 */ 
$page_root = "/digitalworld/"; /*更改成你网站的目录地址*/
/* changefreq可自行设置 */
$changefreq = "weekly"; //"always", "hourly", "daily", "weekly", "monthly", "yearly" and "never".
/* 修改时间 */
$last_modification = date("Y-m-d\TH:i:s") . substr(date("O"),0,3) . ":" . substr(date("O"),3);

/* 需要生成的目录 */
$allow_dir[] = "main";

/* 需要过滤的目录(不列在SiteMap里面) */
$disallow_dir[] = "admin";
$disallow_dir[] = "_notes";

/* 设置列表的文件名,扩展名不在其中的话SiteMap则不会收录该扩展名的文件 */
$disallow_file[] = ".inc";
$disallow_file[] = ".old";
$disallow_file[] = ".save";
$disallow_file[] = ".txt";
$disallow_file[] = ".js";
$disallow_file[] = "~";
$disallow_file[] = ".LCK";
$disallow_file[] = ".zip";
$disallow_file[] = ".ZIP";
$disallow_file[] = ".CSV";
$disallow_file[] = ".csv";
$disallow_file[] = ".css";
$disallow_file[] = ".class";
$disallow_file[] = ".jar";
$disallow_file[] = ".mno";
$disallow_file[] = ".bak";
$disallow_file[] = ".lck";
$disallow_file[] = ".BAK";

/* simple compare function: equals */
function ar_contains($key, $array) {
　　foreach ($array as $val) {
　　　　if ($key == $val) {
　　　　　　return true;
　　　　}
　　}
return false;
}

/* better compare function: contains */
function fl_contains($key, $array) {
　　foreach ($array as $val) {
　　　　$pos = strpos($key, $val);
　　　　if ($pos === FALSE) continue;
　　　　　　return true;
　　　　}
　　return false;
}

/* this function changes a substring($old_offset) of each array element to $offset */
function changeOffset($array, $old_offset, $offset) {
　　$res = array();
　　foreach ($array as $val) {
　　　　$res[] = str_replace($old_offset, $offset, $val);
　　}
　　return $res;
}

/* this walks recursivly through all directories starting at page_root and
adds all files that fits the filter criterias */
// taken from Lasse Dalegaard, 
function getFiles($directory, $directory_orig = "", $directory_offset="") {
global $disallow_dir, $disallow_file, $allow_dir;

if ($directory_orig == "") $directory_orig = $directory;

if($dir = opendir($directory)) {
// Create an array for all files found
$tmp = Array();

// Add the files
while($file = readdir($dir)) {
// Make sure the file exists
if($file != "." && $file != ".." && $file[0] != '.' ) {
　　// If it's a directiry, list all files within it
　　//echo "point1<br>";
　　if(is_dir($directory . "/" . $file)) {
　　//echo "point2<br>";
　　$disallowed_abs = fl_contains($directory."/".$file, $disallow_dir); // handle directories with pathes
　　$disallowed = ar_contains($file, $disallow_dir); // handle directories only without pathes
　　$allowed_abs = fl_contains($directory."/".$file, $allow_dir);
　　$allowed = ar_contains($file, $allow_dir);
　　if ($disallowed || $disallowed_abs) continue;
　　　　if ($allowed_abs || $allowed){
　　　　　　$tmp2 = changeOffset(getFiles($directory . "/" . $file, $directory_orig, $directory_offset), $directory_orig, $directory_offset);
　　　　　　if(is_array($tmp2)) {
　　　　　　　　$tmp = array_merge($tmp, $tmp2);
　　　　　　}
　　　　}
　　} else { // files
　　　　if (fl_contains($file, $disallow_file)) continue;
　　　　　　array_push($tmp, str_replace($directory_orig, $directory_offset, $directory."/".$file));
　　　　}
　　}
}
　　// Finish off the function
　　closedir($dir);
　　return $tmp;
　　}
}

$a = getFiles($page_root);

echo '<?xml version="1.0″ encoding="UTF-8″?>';
?>
<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9′>
<?　　foreach ($a as $file) { ?>
　　　　<url>
　　　　<loc><? echo utf8_encode($website.$file); ?></loc>
　　　　<lastmod><? echo utf8_encode(date("Y-m-d\TH:i:s", filectime($page_root.$file)). substr(date("O"),0,3) . ":" . substr(date("O"),3));?></lastmod>
　　　　<changefreq><? echo utf8_encode($changefreq); ?></changefreq>
　　　　</url>
<?}?>
</urlset>