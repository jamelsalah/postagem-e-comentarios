<?php
session_start();
//conexão com o banco de dados//=======================================
$conexao=mysqli_connect("localhost","root","","postagem");

//conexão com o banco de dados//=======================================

$result_posts=mysqli_query($conexao, "SELECT * FROM posts ");

$result_comentarios=mysqli_query($conexao, "SELECT * FROM comentarios ");

$total_registros_pagina="4";//numero de registros por pagina


//Se $página não for especificada $pc=1=========================
if(isset($_GET['pagina'])){
$pagina=$_GET['pagina'];
}
if(!isset($_GET['pagina'])){
    $pagina=1;
}
    $pc=$pagina;


//Se $página não for especificada $pc=1==========================


//=======================================================================







$inicio=$pc - 1;
$inicio=$inicio * $total_registros_pagina;

$limite=mysqli_query($conexao,"SELECT * FROM `posts` ORDER BY `date` DESC LIMIT $inicio,$total_registros_pagina");


$total_de_registros=mysqli_num_rows($result_posts);//total de registros no banco de dados

$total_paginas=$total_de_registros/$total_registros_pagina;//numero total de paginas

$anterior= $pc -1;
$proximo= $pc +1;



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Postagem</title>
</head>
<body>
    <div style=" width:602px;text-align:center;"><h1>postagens</h1></div>
    <div style="width:600px; height:700px;border:1px solid black;margin-top:30px;overflow:auto;">
        <div style="display:flex;justify-content:center;flex-direction:column;margin-left:30px;margin-right:20px;">
            <div>
                <?php
                                while($posts=mysqli_fetch_assoc($limite)){
                                        ?>
                                    <div style=" font-weight: bolder;">    
                                        <?php
                                                echo $posts['nome'] ."<br>" ;
                                        ?>
                                    </div>
                                    </div>
                                    <div style="margin-left:10px;">
                                        <?php
                                                echo "<div style='border: 01px solid black;'>";
                                                echo "<div style='margin: 5px 20px 20px 5px;'>";
                                                echo $posts['post'] . "<br>";
                                                echo "</div>";
                                                echo "</div>";

                                    $id=$posts['id'];
                                    

                                    $comentarios=mysqli_query($conexao,"SELECT * FROM comentarios WHERE post_id = '$id' ORDER BY 'date' DESC LIMIT 0,2 ");
                                   
                                    echo "<div style='margin-left:50px;margin-bottom:10px;'>";
                                     while($comentarios_array=mysqli_fetch_assoc($comentarios)){
                                         echo "<div style='display:flex; flex-direction:row;'>";

                                         
                                            echo "<div style='font-weight:bolder;margin-right:160px;'>";
                                                echo $comentarios_array['nome'];
                                            echo "</div>";


                                            echo "<div style='font-size:12px;margin-top:5px;'>";
                                                echo $comentarios_array['date'];
                                            echo "</div>";

                                         echo "</div>";

                                         echo "<div style='border:1px solid black;margin-left:10px;'>";
                                            echo "<div style='margin: 5px 20px 20px 5px;'>";
                                                echo $comentarios_array['comentario'];
                                            echo "</div>";
                                         echo "</div>";

                                     }

                                    
                                    
                                    echo "</div>";
                                    
                                    
                                    
                                                
                                    unset($id);             
                
                            ?>
                                    
                


            <div style="display:flex; flex-direction:column; text-align:right;margin-right:15px; ">
                <form action="actioncomentar.php" method="post">
                    <div>
                        <div>
                            <input type="text" placeholder="nome" maxlength="20" name="nome" required/>
                        </div>
                        <div>
                            <input type="text" placeholder="escreva uma comentario" maxlength="200" name="comentario" required/> 
                        </div>
                        <div>       
                            <input type="hidden" value="<?php echo $posts['id']; ?>" name="post_id"/>
                            <input type="submit" value="comentar" /> 
                        </div>   
                    </div>
                </form>
            </div>
          
            </div>
            <div>
                        <?php
                            }
                        ?>


            </div>
        </div>
    </div>
    <div style="width:602px;text-align:center;display:flex;flex-direction:row;justify-content:center;">
                    <?php
                    
                        
                        if($pc>1){
                            echo "<a href='?pagina=$anterior'>anterior</a>";
                        } 
                        echo "<div style='font-weight:bolder;margin-left:10px;margin-right:10px;'>";
                        echo "|";
                        echo "</div>";

                        if($pc<$total_paginas){
                            echo "<a href='?pagina=$proximo'>proxima</a>";
                         } ?>

                    
    </div>


    <form method="post" action="actionpost.php">  
        <div style="margin:30px;margin-bottom:5px;">
            <input type="text" size="" maxlength="20" placeholder="escreva seu nome..." name="nome" required/>
        </div >
        <div>    
            <input type="text" size="" name="post" maxlength="200" placeholder="poste algo..." style="width:300px; height:150px;text-align:; " required/>
        </div>
        <div>
            <input type="submit" value="postar"/>
        </div>
    </form>
</body>
</html>