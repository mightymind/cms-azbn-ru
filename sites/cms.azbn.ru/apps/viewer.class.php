<?
// CMS Azbn.ru Публичная версия

class Viewer
{
public $class_name='viewer';

	function __construct()
	{
		$_SESSION['tmp']['back_url']=$_SERVER['REQUEST_URI'];
		}

	public function form($tpl,&$param)
	{
		require('sites/'.$this->FE->config['site'].'/tpl/'.$tpl.'.tpl.php');
		$this->FE->mem_mark('viewer->form '.$tpl);
		}
	
	public function module($tpl,&$param,$period=900)
	{
		//$this->FE->mem_mark('start module '.$tpl);
		if($param['mdl'][$tpl]) {
			$cache=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_cache']."` WHERE (uid='module_".$param['mdl'][$tpl].'_'.$this->FE->config['zip']."' AND clear_at>'{$this->FE->date}')");
			if($cache['id']) {	
				echo $cache['text'];
				} else {
					$this->FE->Cache->start_caching();
					require('sites/'.$this->FE->config['site'].'/module/'.$param['mdl'][$tpl].'.mdl.php');
					$cache=array(
								'created_at'=>$this->FE->date,
								'clear_at'=>($this->FE->date+$period),
								'uid'=>'module_'.$param['mdl'][$tpl].'_'.$this->FE->config['zip'],
								'text'=>($this->FE->Cache->get_caching_content()) // mysql_escape_string($this->FE->Cache->get_caching_content())
								);
					$this->FE->Cache->finish_caching();
					//$this->FE->DB->dbDelete($this->FE->DB->dbtables['t_cache'],"WHERE uid='".$this->FE->config['zip'].'_module_'.$param['mdl'][$tpl]."'");
					$cache['id']=$this->FE->DB->dbInsert($this->FE->DB->dbtables['t_cache'],$cache);
					echo $cache['text'];
					}
			}
		$this->FE->mem_mark('viewer->module '.$tpl);
		}

	public function module_live($tpl,&$param)
	{
		//$this->FE->mem_mark('start module '.$tpl);
		if($param['mdl'][$tpl]) {
			require('sites/'.$this->FE->config['site'].'/module/'.$param['mdl'][$tpl].'.mdl.php');
			}
		$this->FE->mem_mark('viewer->module_live '.$tpl);
		}
	
	public function startofpage(&$param)
	{
		if(!$param['page_html']['seo']['id']) {
			if($param['item_id']['seo']) {
				$param['page_html']['seo']=$this->FE->CMS->getSEO($param['item_id']['seo'],array(
					'{%title%}'=>$param['item_id']['title'],
					'{%description%}'=>$param['item_id']['preview'],
					'{%keywords%}'=>$param['item_id']['tag'],
					));
			} elseif($param['cat_id']['seo']) {
				$param['page_html']['seo']=$this->FE->CMS->getSEO($param['cat_id']['seo'],array(
					'{%title%}'=>$param['cat_id']['title'],
					'{%description%}'=>$param['cat_id']['preview'],
					'{%keywords%}'=>$param['cat_id']['tag'],
					));
			} else {
				
			}
		}
		
		?><!DOCTYPE html>
<html>
<!--<html manifest="/cache.manifest" >-->
<head>
<title><?=$param['page_html']['seo']['title'].' - '.$this->fe_config['enginetitle'];?></title>
<meta name="revisit" content="20" />
<meta name="document-state" content="Dynamic" />
<meta name="resource-type" content="document" />
<meta name="generator" content="CMS Azbn.ru <?=$this->FE->version['number'];?>" />
<meta HTTP-EQUIV="Cache-Control" content="no-cache" />
<meta name="Copyright" content="Зыбинская Пропаганда" lang="ru" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="<?=$param['page_html']['seo']['desc'];?>" />
<meta name="keywords" content="<?=$param['page_html']['seo']['kw'];?>" />

<link href="/img/cms.azbn.ru/favicon.png" rel="icon" type="image/x-icon" />
<link href="/css/bs3/bootstrap.min.css" rel="stylesheet">
<link href="/css/cms.azbn.ru/base.css?v=201407091621" rel="stylesheet">
<link href="/css/cms.azbn.ru/site.css?v=201501160954" rel="stylesheet">
<link href="/css/cms.azbn.ru/sandbox.css?v=201501221348" rel="stylesheet">

<script src="http://yandex.st/jquery/2.1.3/jquery.min.js"></script>
<script src="/js/bs3/bootstrap.min.js"></script>

<!--<script src="/js/jquery.jqfeFileUploader.js"></script>-->
<!--<script src="/js/jquery.jqfeModal.js"></script>-->
<script src="/js/jquery.jqfeInfoMsg.js"></script>
<!--<script src="/js/jquery.jqfeDropImgOptimizer2.js"></script>-->
<!--<script src="/js/jquery.jqfeDropUploader.js"></script>-->
<!--<script src="/js/jquery.jqfeProgressBarPage.js"></script>-->

<script src="/js/cms.azbn.ru/cmsAPI.js"></script>

<script type="text/javascript" src="/import/cms.azbn.ru/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/import/cms.azbn.ru/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="/import/cms.azbn.ru/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Add Button helper (this is optional) -->
<script type="text/javascript" src="/import/cms.azbn.ru/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<link rel="stylesheet" type="text/css" href="/import/cms.azbn.ru/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<!--
Add Thumbnail helper (this is optional)
<link rel="stylesheet" type="text/css" href="/import/cms.azbn.ru/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="/import/cms.azbn.ru/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
-->
<!--
Add Media helper (this is optional)
<script type="text/javascript" src="/import/cms.azbn.ru/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
-->

<script>

$(document).ready(function() {
	
	//cmsAPI.call({service:'online',method:'check',callback:'CheckOnline'});
	
	cmsAPI.UI.OnReady.FancyboxConfig();
	cmsAPI.UI.OnReady.FTSearchFilterOnClick();
	cmsAPI.UI.OnReady.FaqSessionControl();
	cmsAPI.UI.OnReady.FeedbackSessionControl();
	cmsAPI.UI.OnReady.LiveEditInit();
	
	//$("body").eq(0).jqfeProgressBarPage({});
	
	});

</script>

</head>
<body class="" >

<?=$this->FE->config['metrika_counter'];?>

<!--
<div class="fe-dbg-line-h" style="top:220px;" ></div>
<div class="fe-dbg-line-h" style="top:2200px;" ></div>
<div class="fe-dbg-line-h" style="top:440px;" ></div>
<div class="fe-dbg-line-h" style="top:3108px;" ></div>
-->

<!--
<nav class="navbar navbar-default navbar-fixed-top">
	
	<div class="container">
		
		<div class="navbar-header">
			
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#html-nav-navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
			<a class="navbar-brand" href="/">CMS Azbn.ru</a>
		
		</div>
		
		<div id="html-nav-navbar" class="navbar-collapse collapse">
			
			<ul class="nav navbar-nav">
				
				<li><a href="/page/all/" >Страницы</a></li>
				<li><a href="/post/all/" >Посты</a></li>
				<li><a href="/news/all/" >Новости</a></li>
				
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Связь <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						
						<li><a href="/feedback/all/" >Обратная связь</a></li>
						<li><a href="/faq/all/" >FAQ</a></li>
						
					</ul>
				</li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Профиль <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					
					<?
					if($_SESSION['profile']['id']) {
						?>
						<li><a href="/profile/view/<?=$_SESSION['profile']['id'];?>/" >Мой профиль</a></li>
						<?
						} else {
						?>
						<li><a href="/profile/index/">Вход для пользователей</a></li>
						<li><a href="/profile/registration/">Регистрация</a></li>
						<?
							}
					?>
					
					<?
					if($_SESSION['user']['id']) {
						?>
						
						<li class="divider"></li>
						<li><a href="/admin/page/index/" >Администрирование</a></li>
						
						<?
						} else {
							
							}
					?>
						
					</ul>
				</li>
				
				<li class="hidden-xs">
					<form class="navbar-form" action="/search/fulltext/" role="search" >
						<div class="input-group">
							<div class="form-group">
								<input type="text" class="form-control" name="text" placeholder="Поиск" value="<?=$param['ftsearch']['text'];?>" >
								<span class="input-group-btn">
									<button class="btn btn-success" type="submit" >Найти</button>
								</span>
							</div>
						</div>
					</form>
				</li>
				
			</ul>
		
		</div>
	
	</div>
	
</nav>
-->

<!--
<div class="container">
	
	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
-->
	<?
		
		/*
		$this->view_banner(array(
				'view_at'=>4,
				'tpl'=>'banner/pages_top',
				'limit'=>1,
				'cache_time'=>36000,
				'order_by'=>'rating'
				), $param);
		*/
	
	$this->FE->mem_mark('viewer->startofpage');
		}
	
	public function endofpage(&$param)
	{
		?>
<!--
		</div>
		
	</div>
	
	<div class="clear20" ></div>
	
	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			<p>
				<small class="text-muted" >Сайт создан и управляется с помощью <a href="http://azbn.ru/" target="_blank" >CMS Azbn.ru</a></small>
				<br />
				<small class="text-muted" >© Александр Зыбин, 2012-<?=date("Y");?></small>
			</p>
		</div>
		
	</div>
		
</div>
-->

</body>
</html><?
	
	$this->FE->mem_mark('viewer->endofpage');
		}
	
	public function view_banner($banner=array('view_at'=>999999999, 'tpl'=>'banner/default', 'limit'=>1, 'cache_time'=>3600, 'order_by'=>'rating'),&$param)
	{
		$param['banner_list']=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_banner']."` WHERE view_at='{$banner['view_at']}' ORDER BY {$banner['order_by']} LIMIT {$banner['limit']}");
		$param['mdl']['banner_tpl']=$banner['tpl'];
		$this->module('banner_tpl',$param,$banner['cache_time']);
		}
	
	public function returnStrOrNbsp($str='')
	{
		return (mb_strlen($str)?$str:'&nbsp;');
		}
	
}

?>