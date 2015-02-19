<?
// ЦМС
?>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<hr />
		
		<h2 >FAQ: ответы на ваши вопросы</h2>
		
		<div class="clear10" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
		
		<form action="/faq/create/" method="POST" >
			
			<div class="form-group" data-faq_session_control="<?=$_SESSION['tmp']['faq_session_control'];?>" >
				<label for="title">Введите текст вопроса</label>
				<input type="hidden" name="faq_session_control" value="<?=rand(10000,99999);?>" />
				<textarea class="form-control" name="main_info"></textarea>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success">Отправить</button>
			</div>
			
		</form>
		
		<div class="clear30" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" >
		
		
		<?
		if(mysql_num_rows($param['item_list'])) {
			while($row=mysql_fetch_array($param['item_list'])) {
				$row['param']=unserialize($row['param']);
				?>
				
				<div class="" >
					<small class="label label-info"><?=date("d.m.Y",$row['created_at']);?></small>
					<div class="clear10" ></div>
					<h4><?=$row['main_info'];?></h4>
					<blockquote><?=$row['resp'];?></blockquote>
					<div class="clear20" ></div>
				</div>
				
				<?
				}
			mysql_data_seek($param['item_list'],0);
			}
		?>
		
		<div class="clear20" ></div>
	</div>
	
</div>