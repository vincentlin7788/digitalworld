<?PHP
$content='<?xml version="1.0" encoding="UTF-8"?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';
$data_array=array(
    array(
		'loc'=>'https://vincentlin7788.github.io/digitalworld/',
		'priority'=>'1.0',
		'lastmod'=>'2012-06-03T04:20:32-08:00',
		'changefreq'=>'always'
    ),
    array(
		'loc'=>'https://vincentlin7788.github.io/digitalworld/main/',
		'priority'=>'0.5',
		'lastmod'=>'2012-06-03T04:20:32-08:00',
		'changefreq'=>'daily'
    )
);
foreach($data_array as $data){
	$content.=create_item($data);
}
$content.='</urlset>';
$fp=fopen('sitemap.xml','w+');
fwrite($fp,$content);
fclose($fp);

function create_item($data){
    $item="<url>\n";
    $item.="<loc>".$data['loc']."</loc>\n";
    $item.="<priority>".$data['priority']."</priority>\n";
    $item.="<lastmod>".$data['lastmod']."</lastmod>\n";
	$item.="<changefreq>".$data['changefreq']."</changefreq>\n";
    $item.="</url>\n";
    return $item;
}