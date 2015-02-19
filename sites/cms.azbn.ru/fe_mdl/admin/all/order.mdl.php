<?
$type=$this->FE->c_s($param['req_arr']['param_1']);
$table=$this->FE->DB->dbtables['t_'.$type];
$param['html_tpl']='admin/all/'.$type;
$param['el_list']=$this->FE->DB->dbSelect("SELECT
	".$this->FE->DB->dbtables['t_'.$type].".*,
	".$this->FE->DB->dbtables['t_profile'].".view_as
	FROM
	`".$this->FE->DB->dbtables['t_'.$type]."`,
	`".$this->FE->DB->dbtables['t_profile']."`
	WHERE (
		".$this->FE->DB->dbtables['t_'.$type].".profile=".$this->FE->DB->dbtables['t_profile'].".id
		)
	ORDER BY id DESC");
?>