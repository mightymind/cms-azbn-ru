<?
// ЦМС
?>
<style type="text/css">

.form-signin-login {
	max-width:300px;
	margin: 0 auto;
	}

</style>
<div class="container">

	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
			<form class="form-signin-login" action="/login/start/" method="POST" >
				
				<center>
					
					<h4>Вход на сайт</h4>
					
					<input type="text" name="login" class="form-control text-input" placeholder="Логин" autofocus />
					<div class="clear10" ></div>
					
					<input type="password" name="pass" class="form-control text-input" placeholder="Пароль" />
					<div class="clear10" ></div>
					
					<input class="btn btn-primary" type="submit" value="Войти" />
					
				</center>
				
			</form>
			
		</div>

		<div class="clear" ></div>

	</div>

</div>