<?
// Azbn.ру
?><rss version="2.0">
<channel>
<title><?=$this->FE->config["enginetitle"];?></title>
<link><?=$this->FE->config["base_url"];?></link>
<description><?=$this->FE->config["enginetitle"];?></description>
<copyright><? echo $this->FE->config["base_url"].' - Личный проект Александра Зыбина';?></copyright>
<?
if (mysql_num_rows($param['item_list'])!=0) {
	while ($row=mysql_fetch_array($param['item_list'])) {
		$text=$row['preview'];
		echo "<item>\r\n";
		echo "<title><![CDATA[\r\n{$row['title']}\r\n]]></title>\r\n";
		echo "<link>{$this->FE->config['base_url']}news/view/{$row['id']}</link>\r\n";
		echo "<description><![CDATA[\r\n".htmlspecialchars(nl2br($text), ENT_QUOTES)."\r\n]]></description>\r\n";//htmlspecialchars(nl2br($row['text']), ENT_QUOTES)
		echo "<author>Azbn.ru</author>\r\n";
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