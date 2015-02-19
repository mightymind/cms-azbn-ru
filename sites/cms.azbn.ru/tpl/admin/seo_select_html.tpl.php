<?
$uniq=$this->FE->randstr(12);
?>
<script>
$(document).ready(function(){
	
	$('#create-seo-for-el-modal-create-<?=$uniq;?>').on('click',function(event){
		var seo=$('#seo-<?=$uniq;?>');
		var title=$('#create-seo-for-el-modal-<?=$uniq;?>-title').val();
		var desc=$('#create-seo-for-el-modal-<?=$uniq;?>-desc').val();
		var kw=$('#create-seo-for-el-modal-<?=$uniq;?>-kw').val();
		
		AdminAPI.callbacks.ReloadSEOSelect_<?=$uniq;?>=function(resp) {
			
			if(resp.response.result.item_list > 0) {
				
				seo.html('');
				
				for(var i=0; i<resp.response.item_list.length; i++) {
					var item=resp.response.item_list[i];
					
					$('<option/>',{
						value:item.id,
						html:item.title,
						}).appendTo(seo);
					
					}
				
				}
			
			if(resp.response.result.item > 0) {
				seo.val(resp.response.item.id);
				}
			
			}
		AdminAPI.call({service:'create', method:'seo', title:title, desc:desc, kw:kw, callback:'ReloadSEOSelect_<?=$uniq;?>'});
	});
	
});
</script>
<div class="form-group">

<div class="row">
	
	<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" >
		
		
			<label for="seo" >SEO-преднастройка</label>
			<select class="form-control" name="seo" id="seo-<?=$uniq;?>" >
				<option value="0" >Без преднастройки</option>
			<?
			$ulist=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_seo']."` ORDER BY title");
			while($row=mysql_fetch_array($ulist)) {
				?>
				<option value="<?=$row['id'];?>" <? if($row['id']==1) {echo 'selected';}?> ><?=$row['title'];?></option>
				<?
				}
				?>
			</select>
		
	</div>
	
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" >
		
			<label for="seo" >&nbsp;</label>
			<a href="#create-seo-for-el" class="btn btn-primary btn-sm create-seo-for-el" data-toggle="modal" data-target="#create-seo-for-el-modal-<?=$uniq;?>" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
		
	</div>
				
</div>

<!-- Modal -->
<div class="modal fade" id="create-seo-for-el-modal-<?=$uniq;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Создание SEO-преднастроек для страницы</h4>
			</div>
		
			<div class="modal-body">
				
				<div class="form-group">
					<label for="title" >Title</label>
					<input class="form-control" type="text" id="create-seo-for-el-modal-<?=$uniq;?>-title" placeholder="Title, заголовок" />
				</div>
				
				<div class="form-group">
					<label for="desc" >Description</label>
					<input class="form-control" type="text" id="create-seo-for-el-modal-<?=$uniq;?>-desc" placeholder="Description, описание страницы" />
				</div>
				
				<div class="form-group">
					<label for="kw" >Keywords</label>
					<input class="form-control" type="text" id="create-seo-for-el-modal-<?=$uniq;?>-kw" placeholder="keywords, of, page, ключевые, слова" />
				</div>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" >Отмена</button>
				<button type="button" id="create-seo-for-el-modal-create-<?=$uniq;?>" class="btn btn-primary" data-dismiss="modal" >Создать</button>
			</div>
			
		</div>
	</div>
</div>

</div>