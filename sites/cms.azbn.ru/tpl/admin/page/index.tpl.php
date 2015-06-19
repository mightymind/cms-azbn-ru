<?
// ГдеДостать
?>

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<div class="input-group">
			<input type="text" class="form-control" id="search_query" placeholder="Поиск..." value="" >
			<span class="input-group-btn">
				<input type="button" class="form-control btn btn-primary" onClick="AdminAPI.call({service:'search', method:'fulltext', query:$('#search_query').val(), callback:'ShowFTSearchResultAtIndex'});" value="Найти" />
			</span>
		</div>
	
	</div>
	
</div>

<div class="row" id="Div4SearchResult" >
	<!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ></div>-->
</div>

</div>

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >

<?

if($_SESSION['user']['right']['access_usertask']) {
	
	$param['usertask4working']=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_usertask']."` WHERE status IN (0,2) AND user2='".$_SESSION['user']['id']."' ORDER BY id LIMIT 7");
	
	if(mysql_num_rows($param['usertask4working'])) {
	?>
	<div class="row " id="Usertask4Working" >
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			<label>У Вас имеются невыполненные задания!</label>
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well well-sm" >
		<?
		while($row=mysql_fetch_array($param['usertask4working'])) {
			if($row['status']) {
				?>
				<div class="alert alert-warning" ><a href="/admin/page/view_usertask/<?=$row['id'];?>" ><?=$row['title'];?></a></div>
				<?
				} else {
					?>
					<div class="alert alert-danger" ><a href="/admin/page/view_usertask/<?=$row['id'];?>" ><?=$row['title'];?></a></div>
					<?
					}
			}
		mysql_data_seek($param['usertask4working'],0);
		?>
		</div>
		
	</div>
	<?
		} else {
			?>
		<div class="row " id="Usertask4Working" >
		
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well well-sm" >
				<p class="" >Все в порядке! У Вас нет невыполненных заданий</p>
			</div>
		
		</div>
			<?
			}
	}
?>

</div>