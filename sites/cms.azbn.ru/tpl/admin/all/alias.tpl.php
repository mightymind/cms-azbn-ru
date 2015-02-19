<?
if($_SESSION['user']['right']['change_alias']) {
?>
<div class="page-header" >
	<h3>
		Список перенаправлений сайта
		<a href="/admin/add/alias/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
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
				<td width="30%">Перенаправить с</td>
				<td width="30%">Перенаправить на</td>
				<td width="20%">Тип контента</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr class="" >
				<td><?=$row['req'];?></td>
				<td><?=$row['to'];?></td>
				<td><?=$row['type'];?></td>
				<td>
					<a href="/admin/edit/alias/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
					<a class="confirm-delete" href="/admin/delete/alias/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/delete.png" /></a>
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