<?
// Фреймворк ForEach 3.3

class ShowMemoryInfoInAdmin extends feRunnable {
	function run(){
		$this->FE->mem_mark('startLazy ShowMemoryInfoInAdmin',1);
		/*
		function makeStr($item) {
			return "$item\n";
		}
		*/
		
		if (count($this->FE->memory)) {
			
			$save_log=false;
			
			switch($this->param['class']) {
				
				case 'admin':{
					
					if($this->param['function']=='create' || $this->param['function']=='update') {
						$save_log=true;
					}
					
				}
				break;
				
				case 'api':{
					
				}
				break;
				
				default:{
					$save_log=true;
				}
				break;
				
			}
			
			if($save_log) {
				$_SESSION['tmp']['ShowMemoryInfoInAdmin']=$this->FE->memory;//array_map("makeStr", $this->FE->memory);
			}
			
			}
		
		return true;
		
		}
	}
?>