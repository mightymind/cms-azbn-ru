<div class="page-header" >
	
	<?
	$this->FE->Viewer->form('admin/simple_search_form',$param);
	?>
	
	<h3>
		Список установленных плагинов
		<?
		if($_SESSION['user']['right']['access_plugin']) {
		?>
		<a href="/admin/add/plugin/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
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
				<td width="80%">Название, описание</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr class="visible<?=$row['status'];?>" >
				<td>
					<h4><?=$row['title'];?></h4>
					<p><?=$row['preview'];?></p>
				</td>
				<td>
					<?
					if($_SESSION['user']['right']['access_plugin']) {
					?>
					<a href="/admin/edit/plugin/<?=$row['id'];?>/"  ><img class="icon" title="Редактировать" src="/img/cms.azbn.ru/edit.png" /></a>
					<?
						}
					?>
					
					<?
					if($_SESSION['user']['right']['access_plugin']) {
					?>
					<a class="confirm-delete" href="/admin/delete/plugin/<?=$row['id'];?>/"  ><img class="icon" title="Удалить" src="/img/cms.azbn.ru/delete.png" /></a>
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
			<li><a href="/admin/all/access_plugin/?page=<?=($param['el_list_page']-1);?>">&laquo;</a></li>
			<?
				}
			?>
			
			<?
			if(mysql_num_rows($param['el_list'])==50) {
			?>
			<li><a href="/admin/all/access_plugin/?page=<?=($param['el_list_page']+1);?>">&raquo;</a></li>
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