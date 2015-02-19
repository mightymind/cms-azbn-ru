<div class="page-header" >
	<h3>
		Обратная связь
		<?
		if($_SESSION['user']['right']['change_feedback_add']) {
		?>
		<a href="/admin/add/feedback/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
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
				<td width="20%">Дата</td>
				<td width="20%">От кого</td>
				<td width="40%">Текст</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr class="visible<?=$row['visible'];?>" >
				<td><?=date("Y.m.d H:i:s",$row['created_at']);?></td>
				<td>
					<p><?=$row['view_as'];?></p>
					<p><?=$row['phone'];?></p>
					<p><?=$row['email'];?></p>
				</td>
				<td>
					<?=$row['main_info'];?>
				</td>
				<td>
					<?
					if($_SESSION['user']['right']['change_feedback_edit']) {
					?>
					<a href="/admin/edit/feedback/<?=$row['id'];?>/"  ><img class="icon" title="Редактировать" src="/img/cms.azbn.ru/edit.png" /></a>
					<?
						}
					?>
					
					<?
					if($_SESSION['user']['right']['change_feedback_delete']) {
					?>
					<a class="confirm-delete" href="/admin/delete/feedback/<?=$row['id'];?>/"  ><img class="icon" title="Удалить" src="/img/cms.azbn.ru/delete.png" /></a>
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
			<li><a href="/admin/all/feedback/?page=<?=($param['el_list_page']-1);?>">&laquo;</a></li>
			<?
				}
			?>
			
			<?
			if(mysql_num_rows($param['el_list'])==50) {
			?>
			<li><a href="/admin/all/feedback/?page=<?=($param['el_list_page']+1);?>">&raquo;</a></li>
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