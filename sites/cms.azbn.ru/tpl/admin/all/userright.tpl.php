<div class="page-header" >
	<h3>
		Список прав доступа
		<a href="#add_userright" onClick="AdminAPI.call({service:'userright', method:'create', callback:'CreateUserRight', id:prompt('Введите идентификатор (лат.)',''), name:prompt('Введите имя','')});" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
	</h3>
</div>

					<div class="row" >
					
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
<?
// ГдеДостать
if(mysql_num_rows($param['el_list'])) {

?>
	<table class="table table-striped table-bordered table-hover table-condensed" >
		<tbody>
			<tr class="info">
				<td width="30%">Идентификатор</td>
				<td width="50%">Название права доступа</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		?>
			<tr>
				<td>
					<?=$row['right_id'];?>
				</td>
				<td>
					<span id="userright-name-<?=$row['right_id'];?>" ><?=$row['right_name'];?></span>
				</td>
				<td>
					<a href="#userright_change" onClick="AdminAPI.call({service:'userright', method:'change_name', callback:'ChangeUserRightName', id:'<?=$row['right_id'];?>', name:prompt('Введите имя',$('#userright-name-<?=$row['right_id'];?>').html())});" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
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