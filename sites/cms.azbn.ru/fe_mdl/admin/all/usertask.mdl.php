<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
$table=$this->FE->DB->dbtables['t_'.$type];
$param['html_tpl']='admin/all/'.$type;

$status=isset($_GET['status'])?$this->FE->c_s($_GET['status']):'0,2';

if(
	isset($_GET['user2'])
	&&
		(
		$_SESSION['user']['right']['view_all_usertask']
		||
		$_SESSION['user']['id']==$this->FE->as_int($_GET['user2'])
		)
	) {
	$user2_str=" AND user2='".$this->FE->as_int($_GET['user2'])."'";
	} else {
		$user2_str=" AND user2='{$_SESSION['user']['id']}'";
		}

if(
	isset($_GET['user'])
	&&
		(
		$_SESSION['user']['right']['view_all_usertask']
		||
		$_SESSION['user']['id']==$this->FE->as_int($_GET['user'])
		)
	) {
	$user_str=" AND user='".$this->FE->as_int($_GET['user'])."'";
	$user2_str='';
	} else {
		//$user_str='';
		}

$param['el_list']=$this->FE->DB->dbSelect("SELECT * FROM `$table` WHERE status IN ($status) $user_str $user2_str ORDER BY id DESC LIMIT 50");
?>