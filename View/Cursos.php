<?php
require_once '../loader.php';
if(isset($_SESSION['logado'])){
    if(!$_SESSION['logado']){
        echo "<script>window.location.href = 'Inicio.php?ERRO=7'</script>";
    }
}else{
    echo "<script>window.location.href = 'Inicio.php?ERRO=7'</script>";
}

$usuario = $_SESSION['usuario'];
$idCurso = null;

$cursos = new Curso($idCurso, $usuario);

?>
<!DOCTYPE html>
<html lang=pt-br dir="ltr" style="font-size: 15px; ">
    <head>
        <meta charset="utf-8">
        <title>LibrasON - Aprendendo Libras na WEB</title>
        <link rel="icon" href="../favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/uikit.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
    </head>
    <body>
        <div>
            <div class="uk-navbar-container uk-margin borda-principal" style="margin: 0" uk-navbar>
                <div class="uk-navbar-left">
                    <a class="uk-navbar-item uk-logo" href="Home.php"><img src="img/Logotipo.png" style="height: 60px"></a>
                    <ul class="uk-navbar-nav display-none">

                        <li>
                            <a href="Home.php">  Início  </a>
                        </li>

                        <li class="uk-active">
                            <a href="Cursos.php">  Cursos  </a>
                        </li>

                        <li>
                            <a href="MeusCursos.php">  Meus Cursos  </a>
                        </li>

                        <li>
                            <a href="Comunidades.php">  Comunidade  </a>
                        </li>

                        <li>
                            <a href="Comunicados.php">  Comunicados e Novidades  </a>
                        </li>

                        <li>
                            <a href="#offcanvas-nav-primary" uk-toggle>  <?php echo $_SESSION['nome'] ?>  </a>
                        </li>

                    </ul>
                </div>
                
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav" id="navbarMobile">
                        <a class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #offcanvas-push"></a>
                    </ul>
                </div>
            </div>
        </div>

    <div class="Home">

      <div class="Container-Home2">
        <div class="uk-width-expand@m Tamanho-Home-PrimeiraArea">
          <div class="uk-card uk-card-default uk-card-body Tamanho-Home-PrimeiraArea Borda-Card sombraCaixa">
            <div class="uk-text-center" uk-grid>
              <div class="uk-width-expand@m">
                <h3 class="uk-card-title TituloCard" style="margin-bottom: 0">Cursos Atualmente Abertos na Plataforma</h3>
                <h5 class="TituloCard" style="margin-top: 0">Explore as possibilidades</h5>
              </div>
            </div>

            <?php $cursos->exibirCursos() ?>

          </div>
        </div>
      </div>

      <div uk-grid class="Container-Home" style="margin-top: 0px;">
        <div class="uk-width-expand@m Tamanho-Home-PrimeiraArea" style="padding-left: 0">
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
          
        <div class="uk-width-1-3@m Tamanho-Home-PrimeiraArea display-none">
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
          <li><a href="Notificacoes.php"><span class="uk-margin-small-right" uk-icon="icon: bell"></span> Notificações</a></li>
          <li><a href="MeusCursos.php"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Meus Cursos</a></li>
          <li><a href="ADMContato.php"><span class="uk-margin-small-right" uk-icon="icon: users"></span> Contato com ADM</a></li>
          <li><a href="Configuracoes.php"><span class="uk-margin-small-right" uk-icon="icon: cog"></span> Configurações</a></li>
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

    <div id="InformacoesModal" uk-modal>
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title">Informações em falta</h2>
        </div>
        <div class="uk-modal-body">Se você recebeu essa mensagem ao se inscrever em algum curso e porque seus dados se encontram incompletos. Os dados iniciais de cadastro não são tudo que exigimos para as incrições em nossos cursos.</div>
        <div class="uk-modal-footer uk-text-right">
          <form method="post" action="Configuracoes.php" style="display: inline-block">
            <button class="uk-button uk-button-secondary btn-color-secundario" type="submit">Completar Cadastro</button>
          </form>
          <button class="uk-button uk-button-primary uk-modal-close btn-color-primeiro" type="button">Fechar</button>
        </div>
      </div>
    </div>

    <div id="modalRC" uk-modal>
      <div class="uk-modal-dialog">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h2 id="tituloRC" class="uk-modal-title">
              Regulamento do curso
            </h2>
        </div>

        <div id="bodyModalRC" class="uk-modal-body" uk-overflow-auto>

        </div>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close btn-color-primeiro" type="button">OK, Eu Concordo</button>
        </div>

      </div>
    </div>

    <div id="modalIncricoesOnline" uk-modal>
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title">Inscrição no curso</h2>
        </div>
        <div class="uk-modal-body">
          <p>Você está preste a se inscrever em um curso online, antes siga algumas instruções</p>
          <ul class="uk-list uk-list-bullet">
            <li>Leia o Regulamento </li>
            <li>Confira se suas informações pessoais em <strong>configurações</strong> estão completas</li>
            <li>Lembre-se que nem todo curso ofertado oferece um certificado, confira isso na pagina do curso</li>
          </ul>
        </div>
        <div id="footerModalOnline" class="uk-modal-footer uk-text-right">
          Houve algum erro
        </div>
      </div>
    </div>

    <div id="modalIncricoesPresencial" uk-modal>
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title">Inscrição no curso</h2>
        </div>
        <div class="uk-modal-body">
          <p>Você está preste a se inscrever em um curso presencial, antes siga algumas instruções</p>
          <ul class="uk-list uk-list-bullet">
            <li>Leia o Regulamento </li>
            <li>Confira se suas informações pessoais em <strong>configurações</strong> estão completas</li>
            <li>Os certificados de cursos presenciai são gerados pela instituição</li>
            <li>O LibrasON atua como auxiliar nas aulas, para se cadastrar insira a chave de acesso, caso não tenha solicite ao professor do curso</li>
            
            <form method="post" action="../Inscricoes.php" class="uk-grid-small formadpt" uk-grid style="margin: 10px auto">
                <div class="formadptlep" style="width: 40%;">
                  <input name="codigoAcesso" class="uk-input" type="password" placeholder="Chave de acesso" style="border: 1px solid #3269c4;" required="">
              </div>
              <div id="footerModalPresencial" class="uk-width-1-2@s">
                  Inscrição Impossibilitada
              </div>
            </form>
            
          </ul>
          
        </div>
        <div class="uk-modal-footer uk-text-right">
          <button class="uk-button uk-button-primary uk-modal-close btn-color-primeiro" type="button">Fechar</button>
        </div>
      </div>
    </div>
      
    <div id="InscricaoFeita" uk-modal>
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title">Inscrição no curso</h2>
        </div>
        <div class="uk-modal-body">
            <?php 
            if(isset($_GET['MSGINSCRICAO'])){
                if($_GET['MSGINSCRICAO'] == 3){
                     echo "Codigo de inscrição está incorreto, por favor tente novamente inserido a chave de acesso correta.";
                }else if($_GET['MSGINSCRICAO'] == 4){
                   echo "Não há vagas disponiveis neste curso, mas não fique triste, cursos são abertos mensalmente no LibrasON";
       
                }else if($_GET['MSGINSCRICAO'] == 5){
                   echo "Você já se inscreveu nesse curso, por favor caso queira se inscrever em mais cursos, confira as opções com numero de inscrições restantes menor que um.";
        
                }else if($_GET['MSGINSCRICAO'] == 6){
                   echo "A inscrição para esse curso não é feita por aqui, por favor caso insista em realizar esse tipo de ação, sua conta no LibrasON será excluída sem qualquer tipo de apelação";
        
                }else if($_GET['MSGINSCRICAO'] == 7){
                   echo "Parabéns, sua inscrição foi realizada com sucesso, volte ao menu principal e acesse a área <strong>Meus Cursos</strong> para iniciar suas aulas";
        
                }else if($_GET['MSGINSCRICAO'] == 8){
                   echo "Erro não identificado, caso tenha recebido essa mesagem faça contato com a administração pelo menu do usuário( Clikando no seu nome na barra de menu)";
        
                }
            } 
            ?>
        </div>
        <div class="uk-modal-footer uk-text-right">
          <button class="uk-button uk-button-primary uk-modal-close btn-color-primeiro" type="button">Fechar</button>
        </div>
      </div>
    </div>
        
        <!-- Menu Mobile -->
        <div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
            <div class="uk-offcanvas-bar">
                <ul class="uk-nav uk-nav-default">
                    <center>
                        <img src="../CarregarImagens.php?FotoPerfil" class="PerfilFoto">
                        <p class="PerfilNome"><?php echo $_SESSION['nome'] . " " . $_SESSION['sobrenome'] ?></p>
                    </center>
                    <li class="uk-nav-header">Menu Principal</li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="Home.php"><span class="uk-margin-small-right" uk-icon="icon: home"></span>Início</a></li>
                    <li class="uk-active"><a href="Cursos.php"><span class="uk-margin-small-right" uk-icon="icon: grid"></span> Cursos</a></li>
                    <li><a href="MeusCursos.php"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Meus Cursos</a></li>
                    <li><a href="Comunidades.php"><span class="uk-margin-small-right" uk-icon="icon: users"></span> Comunidade</a></li>
                    <li><a href="Comunicados.php"><span class="uk-margin-small-right" uk-icon="icon: comments"></span> Comunicados</a></li>
                    <li class="uk-nav-header">Opções do Usuário</li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="Notificacoes.php"><span class="uk-margin-small-right" uk-icon="icon: bell"></span> Notificações</a></li>
                    <li><a href="ADMContato.php"><span class="uk-margin-small-right" uk-icon="icon: user"></span> Contato com ADM</a></li>
                    <li><a href="Configuracoes.php"><span class="uk-margin-small-right" uk-icon="icon: cog"></span> Configurações</a></li>
                    <li><a href="../Sair.php"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Sair</a></li>
                    <li class="uk-nav-divider"></li>
                </ul>
            </div>
        </div>
      
    <?php if(isset($_GET['MSGINSCRICAO'])){ ?>
      <script>
        UIkit.modal("#InscricaoFeita").show();
      </script>
    <?php } ?>

    <script type="text/javascript">

        function modalInscricaoOnline(idCurso){
          document.getElementById("footerModalOnline").innerHTML = '<form method="post" action="../Inscricoes.php?inscreverCurso=' + idCurso +'" style="display: inline-block"><button class="uk-button uk-button-secondary btn-color-secundario" type="submit">Completar Inscrição</button></form><button class="uk-button uk-button-primary uk-modal-close btn-color-primeiro" style="margin-left: 5px" type="button">Fechar</button>';
          UIkit.modal("#modalIncricoesOnline").show();
        }

        function modalInscricaoPresencial(idCurso){
          document.getElementById("footerModalPresencial").innerHTML = '<button name="inscricaoPresencial" value="'+ idCurso +'" class="uk-button uk-button-secondary btn-color-secundario" type="submit">Completar Inscrição</button>';
          UIkit.modal("#modalIncricoesPresencial").show();
        }

        function exibirRegulamento(idCurso){
          var pagina = "../Inscricoes.php?gerarRegulamento=" + idCurso;
          document.getElementById("tituloRC").innerHTML = "Regulamento do Curso";
          loadDoc(pagina);
          UIkit.modal("#modalRC").show();
        }

        function exibirCertificadoR(idCurso){
          var pagina = "../Inscricoes.php?gerarCertificado=" + idCurso;
          document.getElementById("tituloRC").innerHTML = "Certificado";
          loadDoc(pagina);
          UIkit.modal("#modalRC").show();
        }

        function loadDoc(pagina) {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             document.getElementById("bodyModalRC").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", pagina, true);
          xhttp.send();
        }
    </script>

    <script type="text/javascript" src="Materializer/js/materialize.min.js"></script>
  </body>
</html>
