<div class="page-header" >
	
	<?
	$this->FE->Viewer->form('admin/simple_search_form',$param);
	?>
	
	<h3>
		Список пользователей
		<?
		if($_SESSION['user']['right']['change_profile_add']) {
		?>
		<a href="/admin/add/profile/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
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
				<td width="80%">Название</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr class="visible<?=$row['status'];?>" >
				<td><a href="/profile/view/<?=$row['id'];?>/" title="Просмотреть" ><?=$row['view_as'];?> (<?=$row['login'];?>)</a></td>
				<td>
					<a href="/profile/view/<?=$row['id'];?>/"  ><img class="icon" title="Просмотреть" src="/img/cms.azbn.ru/view.png" /></a>
					
					<?
					if($_SESSION['user']['right']['change_profile_edit']) {
					?>
					<a href="/admin/edit/profile/<?=$row['id'];?>"  ><img class="icon" title="Редактировать" src="/img/cms.azbn.ru/edit.png" /></a>
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
			<li><a href="/admin/all/profile/?page=<?=($param['el_list_page']-1);?>">&laquo;</a></li>
			<?
				}
			?>
			
			<?
			if(mysql_num_rows($param['el_list'])==50) {
			?>
			<li><a href="/admin/all/profile/?page=<?=($param['el_list_page']+1);?>">&raquo;</a></li>
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