<?
if($_SESSION['user']['right']['change_order_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="status"]').val(<?=$param['edit_el']['status'];?>);
	});
</script>
<div class="page-header" >
	<h3>Редактирование заказа #<?=$param['edit_el']['id'];?></h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/update/order/<?=$param['edit_el']['id'];?>/" method="POST" >
			
			<div class="form-group">
				<label for="status" >Статус</label>
				<select class="form-control" name="status" >
					<option value="1" >незакрытый заказ</option>
					<option value="0" >закрытый заказ</option>
				</select>
			</div>
			
<?
if(mysql_num_rows($param['edit_el']['item_list'])) {
?>

	<table class="table table-striped table-bordered table-hover table-condensed" >
		<tbody>
			<tr class="info">
				<td width="50%">Товар</td>
				<td width="15%">Кол-во</td>
				<td width="15%">По цене</td>
				<td width="20%">Функции</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['edit_el']['item_list'])) {
		?>
			<tr class="" >
				<td>
					<a href="/product/view/<?=$row['product_id'];?>/" target="_blank" ><?=$row['title'];?></a>
				</td>
				<td><?=$row['amount'];?></td>
				<td><?=$row['at_cost'];?></td>
				<td></td>
			</tr>
		<?
		}
	?>
		</tbody>
	</table>
	
	<?
	}
?>
			
			<?
			$this->FE->PluginMng->event('admin:viewer:before_update_btn', $param);
			?>
			
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>