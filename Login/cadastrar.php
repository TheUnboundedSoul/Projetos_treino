<?php
if(isset($_POST['email'])) {
    include('conexao.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $mysqli->query("INSERT INTO usuarios (nome, email, senha) VALUES('$nome', '$email', '$senha')");

    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar</title>
</head>
<body>
    <H1>Regista-te</H1>
    <form action="" method="POST">
        <p>
            <label>Nome</label>
            <input type="text" name="nome">
        </p>
        <p>
            <label>Email</label>
            <input type="text" name="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="text" name="senha">
        </p>
        <p>
            <button type="submit">Cadastrar</button>
        </p>
    </form>
    <a href="login.php">Login</a>
</body>
</html>