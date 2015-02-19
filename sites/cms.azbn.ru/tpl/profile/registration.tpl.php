<?
// ЦМС
?>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<hr />
		
		<h2 >Регистрация на сайте</h2>
		
		<div class="clear10" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
		
		
		
		<div class="clear30" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" >
		
		<form action="/profile/create/" method="POST" >

			<div class="form-group">
				<label for="login" >Логин</label>
				<input type="text" class="form-control" name="login" value="" />
			</div>
			
			<div class="form-group">
				<label for="view_as" >Отображать как</label>
				<input type="text" class="form-control" name="view_as" value="" />
			</div>
			
			<div class="form-group">
				<label for="pass" >Пароль</label>
				<input type="password" class="form-control" name="pass" value="" />
			</div>
			
			<div class="form-group">
				<label for="pass" >Повторите ввод пароля</label>
				<input type="password" class="form-control" name="pass2" value="" />
			</div>
			
			<div class="form-group">
				<label for="url" >URL</label>
				<input type="text" class="form-control" name="url" placeholder="Например: http://azbn.ru/" />
			</div>
			
			<div class="form-group">
				<label for="vk_url" >Ссылка на профиль ВК</label>
				<input type="text" class="form-control" name="vk_url" placeholder="Например: http://vk.com/azbn_ru" />
			</div>
			
			<div class="form-group">
				<label for="twitter_url" >Ссылка на профиль Twitter</label>
				<input type="text" class="form-control" name="twitter_url" placeholder="Например: http://twitter.com/azbn_ru" />
			</div>
			
			<div class="form-group">
				<label for="email" >E-mail</label>
				<input type="text" class="form-control" name="email" placeholder="Например: your@email.com" />
			</div>
			
			<div class="form-group">
				<label for="adr" >Адрес</label>
				<input type="text" class="form-control" name="adr" placeholder="Например: Орел, ул.Вашего Адреса, д.1" />
			</div>
			
			<div class="form-group">
				<label for="phone" >Телефон</label>
				<input type="text" class="form-control" name="phone" placeholder="Например: 79876543210" />
			</div>
			
			<div class="form-group">
				<label for="timezone" >Временная зона</label>
				<input type="text" class="form-control" name="timezone" placeholder="Например: Europe/Moscow" value="Europe/Moscow" />
			</div>
			
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Создать" />
			</div>

		</form>
		
		<div class="clear20" ></div>
	</div>
	
</div>