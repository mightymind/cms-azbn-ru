<?
// Жажда версии 2.9 на движке ForEach 2.9

while($row=mysql_fetch_array($param['item_list'])) {
	//$this->FE->Viewer->view_card($row,$param['req_arr']['cont']);
	echo '<pre>';
	var_dump($row);
	echo '</pre>';
	}
mysql_data_seek($param['item_list'],0);

/*
		<div class="all-page" >
			
			<div class="all-page-list" >
				
				<div class="all-page-list-header" >
					
					<a class="big-title white" href="#" ></a>
					
				</div>
				
				<?
				while($row=mysql_fetch_array($param['item_list'])) {
					$this->FE->Viewer->view_card($row,$param['req_arr']['cont']);
					}
				mysql_data_seek($param['item_list'],0);
				?>
			
			</div>
			
			<div class="all-page-pages" >
				<?
				$this->FE->Viewer->genPagesBlock($param,$param['req_arr']['cont']);
				?>
			</div>
		</div>
*/