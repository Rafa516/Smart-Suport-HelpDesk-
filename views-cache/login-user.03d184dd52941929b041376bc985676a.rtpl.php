<?php if(!class_exists('Rain\Tpl')){exit;}?>	<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Smart Suport</title>
	<link href="/res/user/img/icon.png" rel="icon">
	<link rel="stylesheet" href="/res/user/css/login_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>

	<!--form area start-->

	<center><img src="res/user/img/logo.png" class="logo"  alt=""></center>

	<div class="form">
		<form class="login-form" action="/login" method="post">

			


		

			<input    class="user-login" type="email" name="login" placeholder="Email" required>
			<input class="user-login" type="password" name="despassword" placeholder="Senha" required>
			
			
			<input class="btn" type="submit" name="" value="Acessar">
			<div class="options-02">
				<p>Não é registrado? <a href="#">Crie uma conta</a></p>
			</div>
		</form>

		
		<!--login form end-->
		<!--signup form start-->

		<form class="signup-form" action="/register" method="post"><br>


			<i style="font-size: 40px;color: #0B173B" class="fas fa-user-plus"></i><br>
			Nome
			<input class="user-input" id="person"type="text" name="person" placeholder="Digite seu nome" required>
			Email
			<input class="user-input" id="email"type="email" name="email" placeholder="Digite um e-mail válido " required>

			Gênero
			<select class="user-input" name="genre" id="genre">
				<option value="1">Masculino</option>
				<option value="2">Feminino</option>
				<option value="3">Outros</option>
			</select>

			Empresa
			<select class="user-input" name="store" id="store">
	
			<option value="Empresa 1">Empresa 1</option>
            <option value="Empresa 2">Empresa 2</option>
            <option value="Empresa 3">Empresa 3</option>
			</select>

			Cargo
			<select class="user-input" name="desfunction" id="desfunction">
		    <option value="Recursos Humanos">Recursos Humanos</option>
            <option value="Contabilidade">Contabilidade</option>
            <option value="Financeiro">Financeiro</option>
            <option value="Telemarketing">Telemarketing</option>
            <option value="Marketing">Marketing</option>
            <option value="Gerente">Gerente</option>
            <option value="Vendendor">Vendendor</option>
            <option value="Caixa">Caixa</option>
            <option value="Estoque">Estoque</option>
            <option value="Motorista">Motorista</option>
			</select>

			Senha
			<input class="user-input"  id="despassword"type="password" name="despassword" placeholder="Digite uma senha" required>
			
			<input class="btn" type="submit" name="" value="Registrar">

			<div class="options-02">
				<p> <a href="#">Voltar</a></p>
			</div>
		</form>
		<!--signup form end-->
	</div>
	<!--form area end-->

	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<script src="/res/user/js/functions.js"></script>

	<script type="text/javascript">
		$('.options-02 a').click(function () {
			$('form').animate({
				height: "toggle", opacity: "toggle"
			}, "slow");
		});
	</script>

</body>

</html>