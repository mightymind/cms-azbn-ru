<?
// ЦМС
?>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<hr />
		
		<h2 data-liveedit="pagecat:<?=$param['cat_id']['id'];?>:title" ><?=$param['cat_id']['title'];?></h2>
		
		<div class="clear10" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
		<div ><img class="center-block" src="<?=$param['cat_id']['img'];?>" /></div>
		
		<hr />
		
		<small ><?=$param['cat_id']['preview'];?></small>
		
		<div class="clear20" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" >
		
		<?
		if(mysql_num_rows($param['item_list'])) {
			while($row=mysql_fetch_array($param['item_list'])) {
				$row['param']=unserialize($row['param']);
				?>
				
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><?=date("d.m.Y H:i",$row['created_at']);?></a></h3>
					</div>
					<div class="panel-body row">
						
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h4 class=""><a href="<?=$this->FE->CMS->genLink($row,'page',true);?>" ><?=$row['title'];?></a></h4>
							<?if(isset($row['preview']) && $row['preview']!=''){?><p><?=$row['preview'];?></p><?}?>
							<?
							if(strlen($row['param']['yt_video'])) {
							?>
							<div class="embed-responsive embed-responsive-16by9"> <!-- -4by3 -16by9 -->
								<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/<?=$row['param']['yt_video'];?>" frameborder="0" allowfullscreen="" ></iframe>
							</div>
							<?
								}
							?>
						</div>
						
					</div>
				</div>
				
				<?
				}
			mysql_data_seek($param['item_list'],0);
			}
		?>
		
		<div class="clear20" ></div>
	</div>
	
</div>