<?php
session_start();
include('../../php/protect.php');
    
if($_SESSION['id_sessao'] == 2) {
    
include('../../include/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/menu_gerenciar.css">
    <link rel="stylesheet" href="../../css/livro-aberto.css">
    <link rel="shortcut icon" href="../../imagens/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <title>Usuario Lista</title>
    <style>
        .book-info-container {
        margin: auto;
        padding: 5px;  
        display: flex;
        text-align: center;
        margin: 10px;
        background-color: transparent;
        border-radius: 10px;
    }
    .book-info {
        color: #fff;
        padding: 5px;
        text-align: left;
    }
    </style>
</head>
<body>
    <?php include('../../include/import_menu_gerenciar.php'); 
    include('../../include/conexao.php'); ?>

    <br><br><br><br><br>

    <?php include('../../include/import_menu_usuario_gerenciar.php'); ?>
    
    <br>

    <?php

        $resultado = mysqli_query($mysqli, "SELECT * FROM usuario");
        while ($row = mysqli_fetch_assoc($resultado)) {

            $id_usuario = $row['id_usuario'];
            $nome_usuario = $row['nome_usuario'];
            $email_usuario = $row['email_usuario'];
            $cpf_usuario = $row['cpf_usuario'];
            $data_usuario = $row['data_usuario'];
            $endereco_usuario = $row['endereco_usuario'];
            $telefone_usuario = $row['telefone_usuario'];

            echo    "<div class='book-info-container'>
            <div class='book-info'>
                <div class='info-aberto'>
                    <span class='info-conteudo'><span class='info-destaque'>Nome: </span>".$nome_usuario."</span>
                    <span class='info-conteudo'><span class='info-destaque'>Emaill: </span>".$email_usuario."</span>
                    <span class='info-conteudo'><span class='info-destaque'>Nascimento: </span>".$data_usuario."</span>
                    <span class='info-conteudo'><span class='info-destaque'>CPF: </span>".$cpf_usuario."</span>
                    <span class='info-conteudo'><span class='info-destaque'>Endereço: </span>".$endereco_usuario."</span>
                    <span class='info-conteudo'><span class='info-destaque'>Telefone: </span>".$telefone_usuario."</span>
                    <span class='info-conteudo'><span class='info-destaque'>ID: </span>".$id_usuario."</span>
                </div>
            </div>
        </div><hr>";
        }
    ?>

    <br><br><br>

    <?php include('../../include/import_footer_gerenciar.php');
    include('../../include/acessibilidade.php') ?>
    <a id="link-up" href="#"><i class="ri-arrow-up-double-line"></i></a>
</body>
</html>
<?php
}
else {
    echo "Você não pode acessar essa página, sua permissão é inválida";
}
?>