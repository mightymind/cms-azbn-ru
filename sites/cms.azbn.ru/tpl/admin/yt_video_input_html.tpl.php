<div class="form-group">
	<label for="param[yt_video]" >Ссылка на страницу видео на YouTube</label>
	<input class="form-control" type="text" name="param[yt_video]" value="http://www.youtube.com/watch?v=<?=$param['edit_el']['param']['yt_video'];?>" />
	
	<?
	if($param['edit_el']['param']['yt_video']) {
	?>
	<p>
		<center>
			<a href="http://www.youtube.com/watch?v=<?=$param['edit_el']['param']['yt_video'];?>" target="_blank" ><img src="<?=$param['edit_el']['param']['yt_img'];?>" /></a>
		</center>
	</p>
	<?
	}
	?>
</div>