<div class="page-header" >
	
	<?
	$this->FE->Viewer->form('admin/simple_search_form',$param);
	?>
	
	<h3>
		Загруженные на сервер файлы
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
				<td width="20%">Дата</td>
				<td width="20%">Размер (kB) / Загрузил</td>
				<td width="40%">Файл</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr class="visible<?=$row['visible'];?>" >
				<td><?=date("Y.m.d H:i:s",$row['created_at']);?></td>
				<td><?=round($row['size']/1024);?> / <?=$row['user_view_as'];?></td>
				<td>
					<p><a href="<?=$row['url'];?>" ><?=$row['title'];?></a></p>
					<p>Скачиваний файла: <?=$row['clicked'];?></p>
				</td>
				<td>
					
					<?
					if($_SESSION['user']['right']['change_uplfile_delete']) {
					?>
					<a class="confirm-delete" href="/admin/delete/uplfile/<?=$row['id'];?>/"  ><img class="icon" title="Удалить" src="/img/cms.azbn.ru/delete.png" /></a>
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
	
	<div class="pull-right" >
		<ul class="pagination">
			<?
			if($param['el_list_page']) {
			?>
			<li><a href="/admin/all/uplfile/?page=<?=($param['el_list_page']-1);?>">&laquo;</a></li>
			<?
				}
			?>
			
			<?
			if(mysql_num_rows($param['el_list'])==50) {
			?>
			<li><a href="/admin/all/uplfile/?page=<?=($param['el_list_page']+1);?>">&raquo;</a></li>
			<?
				}
			?>
		</ul>
	</div>
	<?
	}
	?>
						
							<div class="clear">&nbsp;</div>
						</div>
						
						<div class="clear">&nbsp;</div>
					</div>