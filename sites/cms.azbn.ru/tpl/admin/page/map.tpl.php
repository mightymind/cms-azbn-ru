<?
$param['map_form']=array(
	'center'=>array(
		'lat'=>52.965679,
		'lng'=>36.079818,
		'zoom'=>15,
		),
	'point'=>array(
		'lat'=>52.965679,
		'lng'=>36.079818,
		'title'=>'Метка',
		'preview'=>'Подробно о метке',
		),
	);
$this->FE->Viewer->form('admin/geopoint_creator_html',$param);
?>