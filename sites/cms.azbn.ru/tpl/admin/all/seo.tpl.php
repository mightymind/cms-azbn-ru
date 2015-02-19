<?
if($_SESSION['user']['right']['change_seo']) {
?>
<div class="page-header" >
	<h3>
		Список SEO-преднастроек
		<a href="/admin/add/seo/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
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
				<td width="80%">Данные</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr class="" >
				<td>
					<p><b><?=$row['title'];?></b></p>
					<p><?=$row['desc'];?></p>
					<p><?=$row['kw'];?></p>
				</td>
				<td>
					<a href="/admin/edit/seo/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
					<a class="confirm-delete" href="/admin/delete/seo/<?=$row['id'];?>/" ><img class="icon" src="/img/cms.azbn.ru/delete.png" /></a>
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