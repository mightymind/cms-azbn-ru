<?
// CMS Azbn.ru ForEach 2.9

// подключение конфига
$host=explode(':',$_SERVER['HTTP_HOST']);
require_once('sites/config/'.strtolower($host[0]).'.php');
$CONFIG['app_path']='sites/'.$CONFIG['site'].'/apps/';

// запуск главного класса фреймворка
require_once($CONFIG['sys_path'].'/mmforeach.class.php');
$FE=new mmForEach($CONFIG);
unset($CONFIG);
$FE->FE=&$FE;

// запуск класса работы с mysql
$FE->load(array('path'=>$FE->config['sys_path'],'class'=>'InterfaceDB','var'=>'DB'));
$FE->DB->_init($FE->config);

// запуск прочих классов
$FE->load(array('path'=>$FE->config['sys_path'],'class'=>'Cache','var'=>'Cache'));
//$FE->load(array('path'=>$FE->config['sys_path'],'class'=>'LiteDB','var'=>'LDB'));
$FE->load(array('path'=>$FE->config['app_path'],'class'=>'CMSAzbn','var'=>'CMS'));
$FE->load(array('path'=>$FE->config['app_path'],'class'=>'Pluginmng','var'=>'PluginMng'));
$FE->CMS->loadPluginMng('cms', true);

session_start();
$FE->CMS->setTimeZone();

$FE->PluginMng->event('cms:session_start', $param);

// запуск нужного класса по данным пользовательского запроса
$req_arr=$FE->CMS->getReqParams();

$FE->genHeaders($req_arr['content_type'],true);
$FE->run_app(array(
	'class'=>$req_arr['class'],
	'function'=>$req_arr['function'],
	'param'=>array(
		'req_arr'=>$req_arr['req_arr'],
		)));

$FE->PluginMng->event('cms:unload', $req_arr);
/*
// выгрузка запущенных классов
$FE->unload('CMS');
//$FE->unload('LDB');
$FE->unload('Cache');
$FE->DB->dbDestroy();
$FE->unload('DB');
$FE->unload('PluginMng');
$FE->destroy();
*/
?>