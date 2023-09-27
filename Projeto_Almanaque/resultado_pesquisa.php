<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <title>Resultado da Pesquisa</title>
    <style>
        img{
            width: 200px;
        }
    </style>  
</head>
<body>
    <?php include('include/import_menu.php');
    include('include/conexao.php')    ?>

    <br><br><br><br><br>

    <?php
        if (!isset($_GET['busca'])) {
            ?>
        <tr>
            <td colspan="3">Digite algo para pesquisar</td>
        </tr>
        <?php
        } else {
            $pesquisa = $mysqli->real_escape_string($_GET['busca']);
            
            $sql_code = "SELECT * FROM livro WHERE nome_livro LIKE '%$pesquisa%' OR editora_livro LIKE '%$pesquisa%'";
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);

            $sql_code2 = "SELECT * FROM autor WHERE nome_autor LIKE '%$pesquisa%'";
            $sql_query2 = $mysqli->query($sql_code2) or die("ERRO ao consultar! " . $mysqli->error);

            $pesquisa_autor = $sql_query2->num_rows;

            $sql_code3 = "SELECT * FROM genero WHERE nome_genero LIKE '%$pesquisa%'";
            $sql_query3 = $mysqli->query($sql_code3) or die("ERRO ao consultar! " . $mysqli->error);

            $pesquisa_genero = $sql_query3->num_rows;

            if($pesquisa > 0){

                if ($sql_query->num_rows == 0) {
                } else {
                    while ($result = $sql_query->fetch_assoc())

                    {

                        include_once('include/table_pesquisa.php');

                        $id_livro = $result['id_livro'];
                        $nome_livro = $result['nome_livro'];
                        $id_autor = $result['id_autor'];
                        $id_genero = $result['id_genero'];
                        $editora_livro = $result['editora_livro'];
                        $num_edicao_livro = $result['num_edicao_livro'];
                        $estoque_livro = $result['estoque_livro'];
                        $sinopse_livro = $result['sinopse_livro'];
                        $url_imagem_livro = $result['url_imagem_livro'];
        
                        echo "<tr>";
                        echo "<td>".$id_livro."</td>";
                        
                        echo "<td><form method='post' action='livro_aberto.php'>
                                <input name='id_livro' value='".$id_livro."' style='display: none;'>
                                    <button type='submit' name='Submit' style='border: none; background-color: #222327;'>
                                        <img src='imagens/livro_capa/".$url_imagem_livro."'>
                                    </button>
                            </form></td>";
        
                            echo "<td><form method='post' action='livro_aberto.php'>
                            <input name='id_livro' value='".$id_livro."' style='display: none;'>
                                <button type='submit' name='Submit' style='border: none; background-color: #222327;'>
                                    ".$nome_livro."
                                </button>
                            </form></td>";
        
                            $sql2 = "SELECT * FROM autor id_autor WHERE id_autor = '$id_autor'";
                            $resultad2 = $mysqli->query($sql2);
                        
                            while ($row = mysqli_fetch_array($resultad2))
                            { 
                            
                                echo "<td>".$row['nome_autor']."</td>";
                            }
        
                            $sql3 = "SELECT * FROM genero id_genero WHERE id_genero = '$id_genero'";
                            $resultad3 = $mysqli->query($sql3);
                        
                            while ($row = mysqli_fetch_array($resultad3))
                            { 
                            
                                echo "<td>".$row['nome_genero']."</td>";
                            }
                            
                        echo "<td>".$editora_livro."</td>";
                        echo "<td>".$num_edicao_livro."</td>";
                        echo "<td>".$estoque_livro."</td>";
                        echo "<td>".$sinopse_livro."</td>";
                        echo "</tr>";
                    }
                }

                if($pesquisa_autor == 0){
                }
                else{
                    $sql4 = mysqli_query($mysqli, "SELECT  *   FROM  AUTOR where nome_autor like '%$pesquisa%'");
                    while ($result4 = mysqli_fetch_array($sql4))
            
                        {
                            include_once('include/table_pesquisa.php');

                            $id_autor = $result4['id_autor'];
                            
                            $sql5 = mysqli_query($mysqli, "SELECT  *   FROM  livro where id_autor = '$id_autor'");
                            while ($result5 = mysqli_fetch_array($sql5)){
                                
                                $id_livro = $result5['id_livro'];
                                $nome_livro = $result5['nome_livro'];
                                $id_autor = $result5['id_autor'];
                                $id_genero = $result5['id_genero'];
                                $editora_livro = $result5['editora_livro'];
                                $num_edicao_livro = $result5['num_edicao_livro'];
                                $estoque_livro = $result5['estoque_livro'];
                                $sinopse_livro = $result5['sinopse_livro'];
                                $url_imagem_livro = $result5['url_imagem_livro'];
                
                                echo "<tr>";
                                echo "<td>".$id_livro."</td>";
                                
                                echo "<td><form method='post' action='livro_aberto.php'>
                                        <input name='id_livro' value='".$id_livro."' style='display: none;'>
                                            <button type='submit' name='Submit' style='border: none; background-color: #222327;'>
                                                <img src='imagens/livro_capa/".$url_imagem_livro."'>
                                            </button>
                                    </form></td>";
                
                                    echo "<td><form method='post' action='livro_aberto.php'>
                                    <input name='id_livro' value='".$id_livro."' style='display: none;'>
                                        <button type='submit' name='Submit' style='border: none; background-color: #222327;'>
                                            ".$nome_livro."
                                        </button>
                                    </form></td>";
                
                                    $sql6 = "SELECT * FROM autor id_autor WHERE id_autor = '$id_autor'";
                                    $resultad6 = $mysqli->query($sql6);
                                
                                    while ($row = mysqli_fetch_array($resultad6))
                                    { 
                                    
                                        echo "<td>".$row['nome_autor']."</td>";
                                    }
                
                                    $sql3 = "SELECT * FROM genero id_genero WHERE id_genero = '$id_genero'";
                                    $resultad3 = $mysqli->query($sql3);
                                
                                    while ($row = mysqli_fetch_array($resultad3))
                                    { 
                                    
                                        echo "<td>".$row['nome_genero']."</td>";
                                    }
                                    
                                echo "<td>".$editora_livro."</td>";
                                echo "<td>".$num_edicao_livro."</td>";
                                echo "<td>".$estoque_livro."</td>";
                                echo "<td>".$sinopse_livro."</td>";
                                echo "</tr>";


                            }
                        }
                }
                if($pesquisa_genero == 0){
                }
                else{
                    $sql4 = mysqli_query($mysqli, "SELECT  *   FROM  genero where nome_genero like '%$pesquisa%'");
                    while ($result4 = mysqli_fetch_array($sql4))
            
                        {
                            include_once('include/table_pesquisa.php');

                            $id_genero = $result4['id_genero'];
                            
                            $sql5 = mysqli_query($mysqli, "SELECT  *   FROM  livro where id_genero = '$id_genero'");
                            while ($result5 = mysqli_fetch_array($sql5)){
                                
                                $id_livro = $result5['id_livro'];
                                $nome_livro = $result5['nome_livro'];
                                $id_autor = $result5['id_autor'];
                                $id_genero = $result5['id_genero'];
                                $editora_livro = $result5['editora_livro'];
                                $num_edicao_livro = $result5['num_edicao_livro'];
                                $estoque_livro = $result5['estoque_livro'];
                                $sinopse_livro = $result5['sinopse_livro'];
                                $url_imagem_livro = $result5['url_imagem_livro'];
                
                                echo "<tr>";
                                echo "<td>".$id_livro."</td>";
                                
                                echo "<td><form method='post' action='livro_aberto.php'>
                                        <input name='id_livro' value='".$id_livro."' style='display: none;'>
                                            <button type='submit' name='Submit' style='border: none; background-color:#222327;'>
                                                <img src='imagens/livro_capa/".$url_imagem_livro."'>
                                            </button>
                                    </form></td>";
                
                                    echo "<td><form method='post' action='livro_aberto.php'>
                                    <input name='id_livro' value='".$id_livro."' style='display: none;'>
                                        <button type='submit' name='Submit' style='border: none; background-color: #222327;'>
                                            ".$nome_livro."
                                        </button>
                                    </form></td>";
                
                                    $sql6 = "SELECT * FROM autor id_autor WHERE id_autor = '$id_autor'";
                                    $resultad6 = $mysqli->query($sql6);
                                
                                    while ($row = mysqli_fetch_array($resultad6))
                                    { 
                                    
                                        echo "<td>".$row['nome_autor']."</td>";
                                    }
                
                                    $sql3 = "SELECT * FROM genero id_genero WHERE id_genero = '$id_genero'";
                                    $resultad3 = $mysqli->query($sql3);
                                
                                    while ($row = mysqli_fetch_array($resultad3))
                                    { 
                                    
                                        echo "<td>".$row['nome_genero']."</td>";
                                    }
                                    
                                echo "<td>".$editora_livro."</td>";
                                echo "<td>".$num_edicao_livro."</td>";
                                echo "<td>".$estoque_livro."</td>";
                                echo "<td>".$sinopse_livro."</td>";
                                echo "</tr>";


                            }
                        }
                }
            }
            else{
                echo "Nenhum resultado encontrado";
            }
        }
        ?>
    </table>
    
    <br><br><br><br><br><br>


    <?php include('include/import_footer.php'); ?>
</body>
</html>