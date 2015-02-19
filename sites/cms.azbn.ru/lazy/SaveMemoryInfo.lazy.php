<?
// Фреймворк ForEach 3.1

class SaveMemoryInfo extends feRunnable {
	function run(){
		$this->FE->mem_mark('SaveMemoryInfo');
		
		if (count($this->FE->memory)) {
			$fp = fopen($this->FE->config['cache_path'].'/'.$this->FE->config['site'].'/memory_log_'.date("Ymd").'.txt', 'a+');
			
			fwrite($fp, "\n");
			foreach($this->FE->memory as $index=>$arr) {
				fwrite($fp, $index.' - '.$arr['status'].' - '.$arr['title'].''.$arr['memory']."\n");
				}
			fwrite($fp, "\n");
			
			fclose($fp);
			return true;
			} else {
				return false;
				}
		
		//return true;
		}
	}
?>