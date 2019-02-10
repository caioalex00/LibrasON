<?php
/**
 * @project: LibrasON
 * @name: finalizar cadastro 
 * @description: codigo responsavel pro trabalhar com o JCrop para o recorte de fotos em
 * tamanho de lados iguais (Foto de perfil)
 * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 */

include_once 'loader.php';
if(isset($_REQUEST['CadastrarUsuario'])){

    $nome = $_REQUEST['userName'];
    $sobrenome = $_REQUEST['userSobrenome'];
    $email = $_REQUEST['userEmail'];
    $senha = $_REQUEST['userSenha'];
    $senhaCompativel = $_REQUEST['userSenhaC'];
    $usuario = $_REQUEST['userNick'];
    $perfil = $_FILES['userFoto'];

    // Congurações de Foto
    $foto = $_FILES['userFoto']['tmp_name'];
    $conteudoF = file_get_contents($foto);
    $_SESSION['tmpFotoCadastro'] = $conteudoF;

    $fotoPerfil = $_FILES['userFoto'];
    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $fotoPerfil["name"], $ext);
    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
    $caminho_imagem = "Temp/". $nome_imagem;
    move_uploaded_file($fotoPerfil["tmp_name"], $caminho_imagem);
    $_SESSION['tmpFotoCadastroCaminho'] = $nome_imagem;

   // O arquivo. Dependendo da configuração do PHP pode ser uma URL.
   $filename = 'Temp/' . $nome_imagem;
   $height = 500;

   // Obtendo o tamanho original
   list($width_orig, $height_orig) = getimagesize($filename);

   // Calculando a proporção
   $ratio_orig = $width_orig/$height_orig;

   $width = $height*$ratio_orig;

   // O resize propriamente dito. Na verdade, estamos gerando uma nova imagem.
   $image_p = imagecreatetruecolor($width, $height);
   $image = imagecreatefromjpeg($filename);
   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

   //Salvando a imagem em arquivo:
   unlink($filename);
   imagejpeg($image_p, $filename, 75);

}

?>

<!DOCTYPE html>
<html lang=pt-br dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LibrasON - Aprendendo Libras na WEB</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="View/css/uikit.min.css" />
    <link rel="stylesheet" href="View/css/style.css" />
    <script src="View/js/uikit.min.js"></script>
    <script src="View/js/uikit-icons.min.js"></script>
    <link href="View/css/jquery.Jcrop.css" rel="stylesheet" type="text/css"/>
  </head>

  <body onbeforeunload="apagarFoto()">

    <div>
      <div class="uk-navbar-container uk-margin borda-principal" style="margin: 0" uk-navbar>
        <div class="uk-navbar-center">
          <a class="uk-navbar-item uk-logo" href="Home.php"><img src="View/img/Logotipo.png" style="height: 60px"></a>
        </div>
      </div>
    </div>

    <div class="Home">

      <div uk-grid class="Container-Home2">
        <div class="uk-width-expand@m Tamanho-Home-PrimeiraArea">
          <div class="uk-card uk-card-default uk-card-body Tamanho-Home-PrimeiraArea Borda-Card sombraCaixa">
            <div class="uk-text-center" uk-grid>
              <div class="uk-width-expand@m">
                <h3 class="uk-card-title TituloCard" style="margin-bottom: 0">Finalizando Cadastro</h3>
                <h5 class="TituloCard" style="margin-top: 0">Recorte sua foto de perfil</h5>
              </div>
            </div>

            <center>
              <figure class="RecorteDeFoto">
                <img src="CarregarImagens.php?FotoPerfilConfig" id="cropbox" alt=""/>
              </figure>
            </center>
            <form action="CadastroDeUsuario.php" method="post" onsubmit="return checkCoords();">
              <input type="hidden" id="Nome" name="userNome" value="<?php echo $nome ?>"/>
              <input type="hidden" id="Sobrenome" name="userSobrenome" value="<?php echo $sobrenome ?>"/>
              <input type="hidden" id="Email" name="userEmail" value="<?php echo $email ?>"/>
              <input type="hidden" id="Senha" name="userSenha" value="<?php echo $senha ?>"/>
              <input type="hidden" id="SenhaC" name="userSenhaC" value="<?php echo $senhaCompativel ?>"/>
              <input type="hidden" id="Usuario" name="userNick" value="<?php echo $usuario ?>"/>
              <input type="hidden" id="x" name="x" />
              <input type="hidden" id="y" name="y" />
              <input type="hidden" id="w" name="w" />
              <input type="hidden" id="h" name="h" />
              <center><button onclick="apagar = false" name="Cadastrar" type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom  btn-color-primeiro" style="width: 500px" value="Crop Image">Finalizar o cadastro</button></center>
            </form>

          </div>
        </div>
      </div>
    </div>

    <div class="Rodape">
      <center>
        <img src="View/img/Logotipo.png" alt="">
      </center>
      <p>Todos os direitos estão reservados ao © LIBRASON 2019</p>
      <p>Icones disponibilizados por <a class="uk-button-text" href="https://www.freepik.com/" title="Freepik">Freepik</a> de <a class="uk-button-text" href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> licenciado por <a class="uk-button-text" href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></p>
    </div>

    <div class="Desenvolvedor">
      <p>Essa plataforma foi criada por Micaella Fernandes, Jacileia Nascimento Soares e Caio Alexandre de Sousa Ramos.</p>
      <p>Desenvolvedor e Contato: Caio Alexandre de Sousa Ramos.</p>
      <a class=" uk-animation-toggle uk-animation-shake" href="http://facebook.com/CaioAlex00" target="_blank"><img class="uk-animation-shake" src="View/img/RS1.png" alt="" width="25px;"></a>
      <a class=" uk-animation-toggle uk-animation-shake" href="https://github.com/caioalex00" target="_blank"><img class="uk-animation-shake" src="View/img/RS2.png" alt="" width="25px;"></a>
      <a class=" uk-animation-toggle uk-animation-shake" href="https://www.instagram.com/caioalex00/" target="_blank"><img class="uk-animation-shake" src="View/img/RS3.png" alt="" width="25px;"></a>
      <a class=" uk-animation-toggle uk-animation-shake" href="mailto:caioxandres2000@gmail.com" target="_blank"><img class="uk-animation-shake" src="View/img/RS4.png" alt="" width="25px;"></a>
    </div>

    <script src="View/js/jquery-3.3.1.min.js"></script>
    <script src="View/js/jquery.Jcrop.js"></script>
    <script src="View/js/jquery.Jcrop.min.js"></script>
    <script language="Javascript">

        $(function(){

            $('#cropbox').Jcrop({
                aspectRatio: 1,
                onSelect: updateCoords,
            });

        });

        function updateCoords(c)
        {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        };

        function checkCoords()
        {
            if (parseInt($('#w').val())) return true;
            alert('Selecione a região para recortar.');
            return false;
        };

    </script>
    <script type="text/javascript">
        
        var apagar = true;
        
        function apagarFoto(){
            if(apagar){
                loadDoc();
            }
        }
        
        function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           document.getElementById("demo").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "Temp.php?LimparPerfil", true);
        xhttp.send();
        }
    </script>
  </body>
</html>
