<?php

	require_once('db.class.php');


	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);

	$ojbDB = new db();
	$link = $ojbDB->conecta_mysql();

	$usuario_existe = false;
	$email_existe = false;

	//verificar se o usuário já existe
	$sql = " SELECT * FROM usuarios WHERE usuario = '$usuario' ";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if (isset($dados_usuario['usuario'])) {
			$usuario_existe = true;
		}

	}else{
		echo 'Erro ao tentar localizar o registro de usuário';
	}

	//verificar se o email já existe
	$sql = " SELECT * FROM usuarios WHERE email = '$email' ";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if (isset($dados_usuario['email'])) {
			$email_existe = true;
		}

	}else{
		echo 'Erro ao tentar localizar o registro de Email';
	}

	if($usuario_existe || $email_existe){

		$retorno_get = '';

		if ($usuario_existe) {
			$retorno_get.= 'erro_usuario=1&';
		}

		if($email_existe){
			$retorno_get.= 'erro_email=1&';
		}

		header('Location: inscrevase.php?'.$retorno_get);
		die();
	}

	$sql = " INSERT INTO usuarios(usuario, email, senha) VALUES ('$usuario', '$email', '$senha') ";

	//executar a query
	//sintaxe: mysqli_query(retorno do BD, comando SQL);
	if(mysqli_query($link, $sql)){
		echo "<script> alert('Usuário registrado com sucesso!'); location.href='index.php'; </script>";
	}else {
		echo "<script> alert('Erro ao registrar o usuário!'); location.href='inscrevase.php?'; </script>";
	}

?>