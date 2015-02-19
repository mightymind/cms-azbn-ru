<?
if($_SESSION['user']['right']['change_banner']) {
?>
<div class="page-header" >
	<h3>
		Список баннеров сайта
		<a href="/admin/add/banner/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
	</h3>
</div>

					<div class="row" >
					
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
<?
// ГдеДостать
if(mysql_num_rows($param['el_list'])) {

?>
	<table class="table table-bordered table-condensed" >
		<tbody>
			<tr class="info">
				<td width="40%">Изображение</td>
				<td width="40%">Название (подпись), ресурс, переходы</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr class="visible<?=$row['view_at'];?>" >
				<td>
					<img src="<?=$row['img'];?>" />
				</td>
				<td>
					<p><?=$row['title'];?></p>
					<p><a href="<?=$row['url'];?>" target="_blank" ><?=substr($row['url'], 0, 45);?>...</a></p>
					<p>Число переходов: <?=$row['clicked'];?></p>
				</td>
				<td>
					<a href="/admin/edit/banner/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
					<a class="confirm-delete" href="/admin/delete/banner/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/delete.png" /></a>
				</td>
			</tr>
		<?
		}
	?>
		</tbody>
	</table>
	<?
	}
	?>
						
							<div class="clear">&nbsp;</div>
						</div>
						
						<div class="clear">&nbsp;</div>
					</div>
<?
	}
?>