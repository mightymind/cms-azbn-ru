<?
// Фреймворк ForEach 3.1

class emptyRunnable extends feRunnable {
	function run(){
		$this->FE->mem_mark('emptyRunnable');
		echo 'emptyRunnable<br />';
		return true;
		}
	}
?>