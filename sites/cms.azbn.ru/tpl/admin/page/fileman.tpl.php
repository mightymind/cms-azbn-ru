<?
// ГдеДостать
?>
<script>
$(document).ready(function(){
	AdminAPI.call({service:'fileman', method:'listing', dir:'.', callback:'DirListing'});
	});
</script>
<div class="page-header" >
	<h3>Файловый менеджер</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fileman" >
		
		<div class="listing" data-path="." ></div>
		
	</div>
	
</div>