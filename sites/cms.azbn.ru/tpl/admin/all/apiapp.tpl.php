<div class="page-header" >
	<h3>
		Список приложений
		<a href="/admin/add/apiapp/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
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
				<td width="80%">Имя</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr>
				<td><?=$row['login'];?></td>
				<td>
					<a href="/admin/edit/apiapp/<?=$row['id']?>/"><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
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