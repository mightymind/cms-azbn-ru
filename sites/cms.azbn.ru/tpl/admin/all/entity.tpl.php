<?
if($_SESSION['user']['right']['access_entity']) {
?>
<div class="page-header" >
	<h3>
		Дополнительные сущности сайта
		<?
		if($_SESSION['user']['right']['change_entity_add']) {
		?>
		<a href="/admin/add/entity/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
		<?
		}
		?>
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
				<td width="80%">Название, уникальный url</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr class="" >
				<td>
					<p><?=$row['title'];?></p>
					<p><?=$row['url'];?></p>
				</td>
				<td>
					<?
					if($_SESSION['user']['right']['change_entity_edit']) {
					?>
					<a href="/admin/edit/entity/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
					<?
					}
					?>
					
					<?
					if($_SESSION['user']['right']['change_entity_delete']) {
					?>
					<a class="confirm-delete" href="/admin/delete/entity/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/delete.png" /></a>
					<?
					}
					?>
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