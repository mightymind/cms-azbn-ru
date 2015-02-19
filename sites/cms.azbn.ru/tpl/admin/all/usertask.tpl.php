<div class="page-header" >
	
		<div class="pull-right" >
			
			<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
					Задания
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li role="presentation"><a role="menuitem" href="/admin/all/usertask/?user2=<?=$_SESSION['user']['id'];?>&status=0,2">Текущие задания</a></li>
					<li role="presentation"><a role="menuitem" href="/admin/all/usertask/?user2=<?=$_SESSION['user']['id'];?>&status=3">Выполненные задания</a></li>
					<li role="presentation"><a role="menuitem" href="/admin/all/usertask/?user2=<?=$_SESSION['user']['id'];?>&status=1">Не могу выполнить</a></li>
					<li class="divider" ></li>
					<li role="presentation"><a role="menuitem" href="/admin/all/usertask/?user=<?=$_SESSION['user']['id'];?>&status=0,2">Невыполненные мои задания</a></li>
					<li role="presentation"><a role="menuitem" href="/admin/all/usertask/?user=<?=$_SESSION['user']['id'];?>&status=3">Мои выполненные задания</a></li>
					<li role="presentation"><a role="menuitem" href="/admin/all/usertask/?user=<?=$_SESSION['user']['id'];?>&status=1">Не смогли выполнить</a></li>
				</ul>
			</div>
			
		</div>
	
	<h3>
		Список заданий
		<?
		if($_SESSION['user']['right']['create_usertask']) {
		?>
		<a href="/admin/add/usertask/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
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
	<table class="table table-bordered table-hover table-condensed" >
		<tbody>
			<tr class="info">
				<td width="20%">Дата</td>
				<td width="60%">Название</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr class="status<?=$row['status'];?>" >
				<td><?=date("Y/m/d H:i:s",$row['created_at']);?></td>
				<td><a href="/admin/page/view_usertask/<?=$row['id'];?>/" title="Просмотреть" ><?=$row['title'];?></a></td>
				<td>
					<a href="/admin/page/view_usertask/<?=$row['id'];?>/" title="Просмотреть" ><img class="icon" src="/img/cms.azbn.ru/view.png" /></a>
					<?
					if($_SESSION['user']['id']==$row['user']) {
					?>
					<a href="/admin/edit/usertask/<?=$row['id'];?>" title="Редактировать" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
					<?
						}
					?>
					<?
					if($_SESSION['user']['right']['delete_usertask']) {
					?>
					<a class="confirm-delete" href="/admin/delete/usertask/<?=$row['id'];?>" title="Удалить" ><img class="icon" src="/img/cms.azbn.ru/delete.png" /></a>
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