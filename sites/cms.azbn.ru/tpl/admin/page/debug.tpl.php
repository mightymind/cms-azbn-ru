<?
// ГдеДостать
?>

<div class="page-header" >
	<h3>
		Последняя отладочная информация
	</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		
		<?
		if(count($_SESSION['tmp']['ShowMemoryInfoInAdmin'])) {
		$status_arr=array(
			0=>'default',
			//1=>'active',
			1=>'info',
			2=>'success',
			3=>'warning',
			4=>'danger',
			);
		?>
		
		<table class="table table-bordered table-condensed" >
			<tbody>
				<tr class="info">
					<td width="15%">Время</td>
					<td width="10%">Статус</td>
					<td width="65%">Информация</td>
					<td width="10%">Память</td>
				</tr>
		
			<?
			$start_at=$_SESSION['tmp']['ShowMemoryInfoInAdmin'][0]['created_at'];
			
			foreach($_SESSION['tmp']['ShowMemoryInfoInAdmin'] as $index=>$arr) {
				$stop_at=($arr['created_at']>$stop_at)?$arr['created_at']:$stop_at;
				?>
				
				<tr class="<?=$status_arr[$arr['status']];?>" >
					<td ><?=$arr['created_at'];?></td>
					<td ><?=$status_arr[$arr['status']];?></td>
					<td ><?=$arr['title'];?></td>
					<td ><?=round($arr['memory']/1024);?>kB</td>
				</tr>
				
				<?
			}
			?>
			</tbody>
		</table>
		
		<div>Время выполнения <b><?=round($stop_at-$start_at,6);?></b> c</div>
			<?
		}
		?>
		
		
	</div>
	
</div>