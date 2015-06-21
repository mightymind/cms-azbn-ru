<?
// CMS Azbn.ru Публичная версия

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