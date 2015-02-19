<?
// ГдеДостать
echo '<?xml';
?> version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?

while($row=mysql_fetch_array($param['news_list'])) {
?>
<url>
<loc><?=$this->FE->config['base_url'];?>news/view/<?=$row['id'];?></loc>
<lastmod><?=date("Y-m-d",($row['date']));?></lastmod>
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
<?
	}

while($row=mysql_fetch_array($param['post_list'])) {
?>
<url>
<loc><?=$this->FE->config['base_url'];?>post/view/<?=$row['id'];?></loc>
<lastmod><?=date("Y-m-d",($row['created_at']));?></lastmod>
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
<?
	}

while($row=mysql_fetch_array($param['page_list'])) {
?>
<url>
<loc><?=$this->FE->config['base_url'];?>page/view/<?=$row['id'];?></loc>
<lastmod><?=date("Y-m-d",($row['created_at']));?></lastmod>
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
<?
	}

?>
</urlset>