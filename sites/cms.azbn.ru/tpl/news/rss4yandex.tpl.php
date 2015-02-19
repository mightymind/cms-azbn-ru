<?
// Azbn.ру
?><rss version="2.0">
<channel>
<rss2lj:owner xmlns:rss2lj="http://rss2lj.net/NS">zhazh.ru</rss2lj:owner>
<title><?=$this->FE->config["enginetitle"];?></title>
<link><?=$this->FE->config["base_url"];?></link>
<description><?=$this->FE->config["enginetitle"];?></description>
<copyright><? echo $this->FE->config["base_url"].' - Интернет-ресурс Жажда';?></copyright>
<?
if (mysql_num_rows($param['item_list'])!=0) {
	while ($row=mysql_fetch_array($param['item_list'])) {
		$text=$row['main_info'];
		echo "<item>\r\n";
		echo "<title>{$row['title']}</title>\r\n";
		echo "<link>{$this->FE->config['base_url']}news/view/{$row['id']}</link>\r\n";
		echo "<description>".htmlspecialchars(nl2br($text), ENT_QUOTES)."</description>\r\n";//htmlspecialchars(nl2br($row['text']), ENT_QUOTES)
		echo "<author>Zhazh.ru</author>\r\n";
		//$time_array = spliti(":", $row["time"]);
		echo "<pubDate>" . date('r',$row['date']) . "</pubDate>\r\n";
		echo "<guid>{$this->FE->config['base_url']}news/view/{$row['id']}</guid>\r\n";
		echo "</item>\r\n";
		}
	mysql_data_seek($param['item_list'],0);
	} else {
		echo "<item><title>No news!</title><description>No news!</description></item>";
		}
?>
</channel>
</rss>