<?php 
require_once '../loader.php';
if(isset($_SESSION['logado'])){
    if(!$_SESSION['logado']){
        echo "<script>window.location.href = 'Inicio.php?ERRO=7'</script>";
    }
}else{
    echo "<script>window.location.href = 'Inicio.php?ERRO=7'</script>";
}
?>
<!DOCTYPE html>
<html lang=pt-br dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LibrasON - Aprendendo Libras na WEB</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link type="text/css" rel="stylesheet" href="Materializer/css/materialize.css"  media="screen,projection"/>
  </head>
  <body>
    <div>
      <div class="uk-navbar-container uk-margin borda-principal" style="margin: 0" uk-navbar>
        <div class="uk-navbar-left">
          <a class="uk-navbar-item uk-logo" href="Home.php"><img src="img/Logotipo.png" style="height: 60px"></a>
          <ul class="uk-navbar-nav">

              <li class="uk-active">
                  <a href="Home.php">  Início  </a>
              </li>

              <li>
                  <a href="Cursos.php">  Cursos  </a>
              </li>
              
              <li class="">
                  <a href="MeusCursos.php">  Meus Cursos  </a>
              </li>
              
              <li>
                  <a href="Comunidades.php">  Comunidade  </a>
              </li>

              <li>
                  <a href="Comunicados.php">  Comunicados e Novidades  </a>
              </li>

              <li>
                  <a href="#offcanvas-nav-primary" uk-toggle>  <?php echo $_SESSION['nome'] . " " . $_SESSION['sobrenome'] ?>  </a>
              </li>

          </ul>
        </div>
      </div>
    </div>

    <div class="Home">

      <div uk-grid class="Container-Home2">
        <div class="uk-width-expand@m Tamanho-Home-PrimeiraArea">
          <div class="uk-card uk-card-default uk-card-body Tamanho-Home-PrimeiraArea Borda-Card sombraCaixa">
            <div class="uk-text-center" uk-grid>
              <div class="uk-width-1-3@m">
                <h3 class="uk-card-title TituloCard" style="margin-bottom: 0">SEJA BEM VINDO</h3>
                <h5 class="TituloCard" style="margin-top: 0"><?php echo $_SESSION['nome'] . " " . $_SESSION['sobrenome'] ?></h5>
              </div>
              <div class="uk-width-1-6@m" style="height: 30px">
                  <div class="uk-divider-vertical" style="height: 60px"></div>
              </div>
              <div class="uk-width-expand@m">
                <h3 class="uk-card-title TituloCard" style="margin-bottom: 0">Funcionalidades da Plataforma</h3>
                <h5 class="TituloCard" style="margin-top: 0">Todas as funções principais abaixo</h5>
              </div>
            </div>

            <div class="uk-child-width-expand@s Cards-Funcoes" uk-grid>

              <div>
                <a href="Cursos.php" class="RemoverLinkEstiloPadrão">
                  <div class="uk-card uk-card-default uk-card-body uk-card-hover bordaPersonalizada">
                    <h3 class="uk-card-title CorTituloCard"><img src="img/Icones/IC2.png" alt="" width="30"> Cursos</h3>
                    <p>Se increva nos cursos abertos desta época, começando pelo nosso cursos introdutório de LIBRAS para conhecer a segunda Língua Oficial do Brasil</p>
                  </div>
                </a>
              </div>

              <div>
                <a href="MeusCursos.php" class="RemoverLinkEstiloPadrão">
                  <div class="uk-card uk-card-default uk-card-body uk-card-hover  bordaPersonalizada">
                    <h3 class="uk-card-title CorTituloCard"><img src="img/Icones/IC1.png" alt="" width="30"> Meus Cursos</h3>
                    <p>Sessão com os cursos no qual você está se inscreveu, você poderá acompanhar todos os vídeos, tarefas e documentação por aqui.</p>
                  </div>
                </a>
              </div>

              <div>
                <a href="Comunicados.php" class="RemoverLinkEstiloPadrão">
                  <div class="uk-card uk-card-default uk-card-body uk-card-hover  bordaPersonalizada">
                    <h3 class="uk-card-title CorTituloCard"><img src="img/Icones/IC4.png" alt="" width="30"> Comunicados</h3>
                    <p>Área destinada a informar nossos usuário sobre as novidadades na plataforma e eventos marcantes sobre o mundo dos surdos.</p>
                  </div>
                </a>
              </div>

            </div>

            <div class="uk-child-width-expand@s Cards-Funcoes" uk-grid>

              <div>
                <a href="Comunidades.php" class="RemoverLinkEstiloPadrão">
                  <div class="uk-card uk-card-default uk-card-body uk-card-hover  bordaPersonalizada">
                    <h3 class="uk-card-title CorTituloCard"><img src="img/Icones/IC3.png" alt="" width="30"> Comunidade</h3>
                    <p>Espaço destinado para comunicação entre nossos usuários sobre temas distintos, seja sobre a plataforma ou a comunidade</p>
                  </div>
                </a>
              </div>

              <div>
                <a href="Notificacoes.php" class="RemoverLinkEstiloPadrão">
                  <div class="uk-card uk-card-default uk-card-body uk-card-hover bordaPersonalizada">
                    <h3 class="uk-card-title CorTituloCard"><img src="img/Icones/IC5.png" alt="" width="30"> Notificações</h3>
                    <p>Acompanhe suas notificações sobre cursos, sua conta ou novidadades. Aqui você fica informado sobre o que há de novo no curso</p>
                  </div>
                </a>
              </div>

              <div>
                <a href="Configuracoes.php" class="RemoverLinkEstiloPadrão">
                  <div class="uk-card uk-card-default uk-card-body uk-card-hover bordaPersonalizada">
                    <h3 class="uk-card-title CorTituloCard"><img src="img/Icones/IC6.png" alt="" width="30"> Configurações</h3>
                    <p>Configure suas informações de usuário, foto de perfil, dados obrigatorios e sobre o encerramento da sua conta </p>
                  </div>
                </a>
              </div>

            </div>

          </div>
        </div>
      </div>

      <div uk-grid class="Container-Home" style="margin-top: 0px;">
        <div class="uk-width-expand@m Tamanho-Home-PrimeiraArea">
          <div class="uk-card uk-card-default uk-card-body Tamanho-Home-PrimeiraArea Borda-Card sombraCaixa" style="overflow: scroll;">
            <h3 class="uk-card-title TituloCard">Lista de Tarefas</h3>
            <dl class="uk-description-list">
              <dt>Description term</dt>
              <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</dd>
              <dt>Description term</dt>
              <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
              <dt>Description term</dt>
              <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
              <dt>Description term</dt>
              <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
            </dl>
          </div>
        </div>
        <div class="uk-width-1-3@m Tamanho-Home-PrimeiraArea">
          <div class="uk-card uk-card-default uk-card-body Tamanho-Home-PrimeiraArea Borda-Card sombraCaixa">
            <h3 class="uk-card-title TituloCard">Última Notificação</h3>
            <div class="uk-card-header">
              <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                  <img class="uk-border-circle" width="40" height="40" src="img/perfil.jpg">
                </div>
                <div class="uk-width-expand">
                  <h3 class="uk-card-title uk-margin-remove-bottom">Title</h3>
                  <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">April 01, 2016</time></p>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
            <div class="uk-card-footer">
                <a href="#" class="uk-button uk-button-text">Ler Notificações</a>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div id="offcanvas-nav-primary" uk-offcanvas="overlay: true">
      <div class="uk-offcanvas-bar uk-flex uk-flex-column PerfilMenu" >

        <ul class="uk-nav uk-nav-primary uk-nav-defaut uk-margin-auto-vertical">
          <center>
              <img src="../CarregarImagens.php?FotoPerfil" class="PerfilFoto">
            <p class="PerfilNome"><?php echo $_SESSION['nome'] . " " . $_SESSION['sobrenome'] ?></p>
          </center>
          <li class="uk-active PerfilNome"></li>
          <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: bell"></span> Notificações</a></li>
          <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Meus Cursos</a></li>
          <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: users"></span> Contato com ADM</a></li>
          <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: cog"></span> Configurações</a></li>
          <li class="uk-nav-divider"></li>
          <li><a href="../Sair.php"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Sair</a></li>
        </ul>

      </div>
    </div>

    <div class="Rodape">
      <center>
        <img src="img/Logotipo.png" alt="">
      </center>
      <p>Todos os direitos estão reservados ao © LIBRASON 2018 - 2019</p>
      <p>Icones disponibilizados por <a class="uk-button-text" href="https://www.freepik.com/" title="Freepik">Freepik</a> de <a class="uk-button-text" href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> licenciado por <a class="uk-button-text" href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></p>
    </div>

    <div class="Desenvolvedor">
      <p>Essa plataforma foi criada por Micaella Fernandes, Jacileia Nascimento Soares e Caio Alexandre de Sousa Ramos.</p>
      <p>Desenvolvedor e Contato: Caio Alexandre de Sousa Ramos.</p>
      <a class=" uk-animation-toggle uk-animation-shake" href="http://facebook.com/CaioAlex00" target="_blank"><img class="uk-animation-shake" src="img/RS1.png" alt="" width="25px;"></a>
      <a class=" uk-animation-toggle uk-animation-shake" href="https://github.com/caioalex00" target="_blank"><img class="uk-animation-shake" src="img/RS2.png" alt="" width="25px;"></a>
      <a class=" uk-animation-toggle uk-animation-shake" href="https://www.instagram.com/caioalex00/" target="_blank"><img class="uk-animation-shake" src="img/RS3.png" alt="" width="25px;"></a>
      <a class=" uk-animation-toggle uk-animation-shake" href="mailto:caioxandres2000@gmail.com" target="_blank"><img class="uk-animation-shake" src="img/RS4.png" alt="" width="25px;"></a>
    </div>

    <script type="text/javascript">
      UIkit.offcanvas(element, options);
    </script>
    <script type="text/javascript" src="Materializer/js/materialize.min.js"></script>
  </body>
</html>
