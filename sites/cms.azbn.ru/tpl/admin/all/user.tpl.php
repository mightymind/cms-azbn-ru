<div class="page-header" >
	<h3>
		Список администраторов
		<?
		if($_SESSION['user']['right']['change_user']) {
		?>
		<a href="/admin/add/user/" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
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
				<table class="table table-striped table-bordered table-hover table-condensed" >
					<tbody>
		<tr class="info">
			<td >&nbsp;</td>
			<td >Логин, имя</td>
			<td >Функции</td>
		</tr>
				<?
				while($row=mysql_fetch_array($param['el_list'])) {
					//$row['param']=unserialize($row['param']);
					?>
		<tr>
			<td align="center" >
				<img class="user-img" src="<?=$row['img'];?>" />
			</td>
			<td>
				<p><?=$row['login'];?></p>
				<p><?=$row['view_as'];?></p>
			</td>
			<td>
				<a href="/admin/edit/user/<?=$row['id'];?>" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
				<a href="/admin/page/lastactions/?user=<?=$row['id'];?>&count=75" ><img class="icon" src="/img/cms.azbn.ru/lastactions.png" /></a>
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