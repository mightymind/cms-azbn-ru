<?
// ГдеДостать
?>

<div class="page-header" >
	<h3>
		Информация о CMS Azbn.ru
	</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		
		<div class="panel panel-primary" >
			<div class="panel-heading" >
				<h3 class="panel-title" >Принципы работы, структура файлов и папок</h3>
			</div>
			<div class="panel-body" >
				Panel content
			</div>
		</div>
		
		
		<div class="panel panel-primary" >
			<div class="panel-heading" >
				<h3 class="panel-title" >Возможности CMS</h3>
			</div>
			<div class="panel-body" >
				Panel content
			</div>
		</div>
		
		
		<div class="panel panel-primary" >
			<div class="panel-heading" >
				<h3 class="panel-title" >Написание плагинов и расширений, их установка</h3>
			</div>
			<div class="panel-body" >
				
				<hr />
				<h4>События запуска плагинов CMS</h4>
				
				<ul>
					
					<li>cms:session_start</li>
					<li>cms:unload</li>
					<li>cms:connect2otherdb</li>
					
				</ul>
				
				<ul>
					
					<li>install:clear:after</li>
					<li>install:main:after</li>
					<li>install:site:after</li>
					
				</ul>
				
				<ul>
					
					<li>admin:stop:before_unset</li>
					<li>admin:upload:after</li>
					<li>admin:create:after</li>
					<li>admin:update:after</li>
					<li>admin:delete:after</li>
					<li>admin:viewer:menu_plugin_list</li>
					<li>admin:viewer:leftcol_widget</li>
					
				</ul>
				
				<ul>
					
					<li>login:start:after_ok</li>
					<li>login:start:after_notok</li>
					<li>login:off:before_unset</li>
					
				</ul>
				
				<ul>
					
					<li>profile:start:after_ok</li>
					<li>profile:start:after_notok</li>
					<li>profile:create:after_ok</li>
					<li>profile:off:before_unset</li>
					
				</ul>
				
			</div>
		</div>
		
		
	</div>
	
</div>