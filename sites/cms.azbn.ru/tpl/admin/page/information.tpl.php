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
					<li>cms:item_id:after_select</li>
					<li>cms:cat_id:after_select</li>
					<li>cms:all:after_select</li>
					
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
					<li>admin:viewer:head:after</li>
					<li>admin:viewer:body:after</li>
					<li>admin:viewer:before_create_btn</li>
					<li>admin:viewer:before_update_btn</li>
					
				</ul>
				
				<ul>
					
					<li>api:call:before_echo</li>
					<li>api:admin:before_echo</li>
					
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
				
				<ul>
					
					<li>faq:create:after</li>
					
				</ul>
				
				<ul>
					
					<li>feedback:create:after</li>
					
				</ul>
				
				<ul>
					
					<li>search:fulltext:after</li>
					
				</ul>
				
				<ul>
					
					<li>viewer:head:after</li>
					<li>viewer:body:after</li>
					
				</ul>
				
			</div>
		</div>
		
		
	</div>
	
</div>