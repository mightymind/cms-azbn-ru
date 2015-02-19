<?
// ЦМС
?>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<hr />
		
		<small ><a href="<?=$this->FE->CMS->genLink($param['cat_id'],'postcat',true,true);?>" ><?=$param['cat_id']['title'];?></a></small>
		<div class="clear10" ></div>
		<h2 data-liveedit="post:<?=$param['item_id']['id'];?>:title" ><?=$param['item_id']['title'];?></h2>
		
		<div class="clear10" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
		<div ><img class="center-block" src="<?=$param['item_id']['img'];?>" /></div>
		
		<hr />
		
		<small class="label label-success" title="<?=date("H:i", $param['item_id']['created_at']);?>" >Создано <?=date("d.m.Y", $param['item_id']['created_at']);?></small>
		
		<div class="clear10" ></div>
		
		<div >
		<?
		$tag=explode(',', $param['item_id']['tag']);
		if(count($tag)) {
			foreach($tag as $i=>$t) {
				$t=trim($t);
				$tag[$i]='<a href="/search/fulltext/?text='.$t.'" class="label label-warning" title="Найти '.$t.' на сайте" >'.$t.'</a>';
			}
			echo implode(' ',$tag);
		}
		?>
		</div>
		
		<div class="clear30" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" >
		
		<div class="" data-liveedit="post:<?=$param['item_id']['id'];?>:preview" ><?=$param['item_id']['preview'];?></div>
		
		<hr />
		
		<div class="" data-liveedit="post:<?=$param['item_id']['id'];?>:main_info" ><?=$param['item_id']['main_info'];?></div>
		
		<?
		if(strlen($param['item_id']['param']['yt_video'])) {
		?>
		<div class="embed-responsive embed-responsive-16by9"> <!-- -4by3 -16by9 -->
			<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/<?=$param['item_id']['param']['yt_video'];?>" frameborder="0" allowfullscreen="" ></iframe>
		</div>
		<?
		}
		?>
		
		<div class="clear20" ></div>
	</div>
	
</div>