<?php
require_once '../loader.php';
if(isset($_SESSION['logado'])){
    if($_SESSION['logado']){
        echo "<script>window.location.href = 'Home.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang=pt-br dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LibrasON - Aprendendo Libras na WEB</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link type="text/css" rel="stylesheet" href="Materializer/css/materialize.css"  media="screen,projection"/>
  </head>
  <body>
    <!-- Navbar -->
    <div class="uk-navbar-container uk-margin borda-principal" style="margin: 0" uk-navbar>
      <div class="uk-navbar-left">
        <a class="uk-navbar-item uk-logo" href="Inicio.php"><img src="img/Logotipo.png" style="height: 60px"></a>
        <ul class="uk-navbar-nav">

            <li class="uk-active">
                <a href="Inicio.php">  Início  </a>
            </li>

            <li>
                <a href="#modal-login" uk-toggle>  Entrar  </a>
            </li>

            <li>
                <a href="#modal-cadastro" uk-toggle>  Cadastro  </a>
            </li>

        </ul>
      </div>
    </div>

    <!-- Carrosel -->
    <div class="uk-position-relative uk-visible-toggle uk-light borda-principal" tabindex="-1" uk-slideshow="ratio: 12:3; animation: scale; autoplay: true; autoplay-interval: 5000">
      <ul class="uk-slideshow-items">
          <li>
              <img src="img/B1.png" alt="" uk-cover>
              <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                 <h3 class="uk-margin-remove">Seja Bem Vindo!</h3>
                 <p class="uk-margin-remove">O LibrasON é uma plataforma que conta com um ambiente virtual de aprendizagem.</p>
              </div>
          </li>
          <li>
            <img src="img/B2.png" alt="" uk-cover>
            <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
               <h3 class="uk-margin-remove">Aprenda Libras!</h3>
               <p class="uk-margin-remove">Com nosso ava você ira se introduzir no mundo da Libras.</p>
            </div>
          </li>
          <li>
              <img src="img/B3.png" alt="" uk-cover>
              <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                 <h3 class="uk-margin-remove">Surdos</h3>
                 <p class="uk-margin-remove">O website se dedica ao ouvinte expandir seus conhecimentos do mundo dos surdos.</p>
              </div>
          </li>
      </ul>

      <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
      <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
    </div>

    <!-- Apresentações -->
    <div class="uk-height-large uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top" style="background-image: url('img/apresentacao1.png');">
        <div class="uk-text-center uk-margin-auto uk-margin-auto-vertical" style="width: 80%">
            <h1 class="Titulos"> NOSSOS OBJETIVOS</h1>
            <p>O Librason tem como objetivo apresentar ao usuário o surdo e sua língua. Para realizar tal ato é disponibilizado conteúdo sobre a cultura surda. A plataforma tambem conta com um AVA (Ambiente virtual de aprendizagem) para realizar a introdução a 2° língua oficial do Brasil: a LIBRAS (Língua brasileira de sinais) e incentivar que os usuários busquem se aprofundar na mesma. Como objetivo final, esperamos oportunizar a interação entre os ouvintes e a comunidade surda.</p>
        </div>
    </div>

    <div class="InformacoesTelaPrincipal SombraAoRedor">
      <center>
        <img src="img/Logo.png" width="250" alt="Logo oficial LibraON">
        <p class="Chamada">CONHEÇA A BAIXO A NOSSA PLATAFORMA E SE CADASTRE PARA ACESSO AS FUNCIONALIDADES</p>
      </center>
      <div class="uk-container uk-container-small">
        <button uk-toggle="target: #modal-cadastro" class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom CustomButtomPrimary ">Cadastro no Ambiente Virtual de Aprendizagem</button>
      </div>
    </div>

    <div class="uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top" style="background-image: url('img/Apresentacao2.png'); height: 800px">
        <div class="uk-text-center uk-margin-auto uk-margin-auto-vertical" style="width: 80%">
            <h1 style="margin-bottom: 40px;" class="Titulos"> O QUE OFEFERECEMOS </h1>
            <div uk-parallax="opacity: 0,1; y: 100,0; scale: 0.5,1; viewport: 0.5;" lass="uk-container uk-container-large">
              <div class="uk-child-width-expand@s uk-text-center" uk-grid>

                <div>
                  <div class="uk-card uk-card-default CorrecaoDeTamanho">
                    <div class="uk-card-media-top">
                        <img src="images/light.jpg" alt="">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title fonteTimmana">Aprendizado</h3>
                        <p>Um ambiente virtual de aprendizagem (AVA) vem integrado ao nosso website, nele é possível realizar um curso de introdução a Língua Brasileira de Sinais, a libras é a segunda língua oficial do Brasil, sendo usada para comunicação pela comunidade surda.</p>
                    </div>
                  </div>
                </div>

                <div>
                  <div class="uk-card uk-card-default CorrecaoDeTamanho">
                    <div class="uk-card-media-top">
                        <img src="images/light.jpg" alt="">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title fonteTimmana">Envolvimento</h3>
                        <p>Com nosso conjunto de informações e nosso AVA, garantimos que cada vez mais pessoas conheçam melhor os surdos e garantimos que nossos usuários busquem e aprendam sobre os surdos, principalmente sobre como ter uma comunicação melhor com eles.</p>
                    </div>
                  </div>
                </div>

                <div>
                  <div class="uk-card uk-card-default CorrecaoDeTamanho">
                    <div class="uk-card-media-top">
                        <img src="images/light.jpg" alt="">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title fonteTimmana">Conhecimento</h3>
                        <p>A busca pelo conhecimento é algo necessário. No LibrasON você encontra diversas informações sobre os surdos. Aqui as informações possuem fontes seguras como artigos científicos e livros, garantindo uma confiabilidade do que é lido.</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
        </div>
    </div>

    <div class="InformacoesTelaPrincipal SombraAoRedor">
      <center>
        <img src="img/Logo.png" width="250" alt="Logo oficial LibraON">
        <p class="Chamada">CONHEÇA O AVA E COMO FUNCIONA LOGO ABAIXO</p>
      </center>
      <div class="uk-container uk-container-small">
        <button uk-toggle="target: #modal-cadastro" class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom CustomButtomPrimary ">Cadastro no Ambiente Virtual de Aprendizagem</button>
      </div>
    </div>

    <div class="uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top borda-principal" style="background-image: url('img/Apresentacao3.png'); height: 1200px">
        <div class="uk-text-center uk-margin-auto uk-margin-auto-vertical" style="width: 80%">

            <h1 style="margin-bottom: 10px;" class="Titulos"> AMBIENTE VIRTUAL DE APRENDIZAGEM </h1>
            <p>Aprendizado Virtual em Diversas Tipos de Dispositivos</p>

            <hr class="uk-divider-icon">

            <div  uk-slider="autoplay: true; autoplay-interval: 1400" class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>

                <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid" style="width: 675px">
                  <li>
                      <div class="uk-panel">
                          <img src="img/SSC1.png" alt="">
                      </div>
                  </li>
                  <li>
                      <div class="uk-panel">
                          <img src="img/SSC2.png" alt="">
                      </div>
                  </li>
                  <li>
                      <div class="uk-panel">
                          <img src="img/SSC3.png" alt="">
                      </div>
                  </li>
                  <li>
                      <div class="uk-panel">
                          <img src="img/SSC4.png" alt="">
                      </div>
                  </li>
                  <li>
                      <div class="uk-panel">
                          <img src="img/SSC5.png" alt="">
                      </div>
                  </li>
                  <li>
                      <div class="uk-panel">
                          <img src="img/SSC6.png" alt="">
                      </div>
                  </li>
                </ul>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

            </div>

            <hr class="uk-divider-icon">

            <div uk-parallax="opacity: 0,1,1; y: 100,0,0; x: -400,-400,0; scale: 0.5,1,1; viewport: 0.5;">
              <div class="uk-card uk-card-default uk-card-hover uk-card-body" style="text-align: left">
                <h3 class="uk-card-title">Porque utilizar um AVA?</h3>
                <p>O uso das tecnologias como facilitadores do ensino trouxe resultados positivos, com o advento da internet nas últimas décadas a procura por um método de ensino capaz de atingir um público maior com mais facilidade tem crescido, explicitando também a necessidade de um instrumento de ensino simples porem completo. Os ambientes virtuais de Ensino e aprendizagem se mostram um caminho muito eficiente de ensino, pois, dá ao aluno autonomia no ensino e usa elementos multididáticos no ensino</p>
              </div>
            </div>

            <div uk-parallax="opacity: 0,1,1; y: 100,0,0; x: -400,-400,0; scale: 0.5,1,1; viewport: 0.5;">
              <div class="uk-card uk-card-default uk-card-hover uk-card-body" style="text-align: left; margin-top: 20px;">
                <h3 class="uk-card-title">O que será ensinado no AVA?</h3>
                <p>O AVA em função de melhorar a inclusão dos surdos, tem como principal foco o ensino da LIBRAS. A língua brasileira de sinais (Libras) é a língua natural das comunidades surdas brasileiras e esta utiliza o canal visuo-espacial, fazendo uso de sinais, expressões faciais e corporais para se expressar e comunicar, diferenciando-se, dessa forma, das línguas oral-auditivas como é o caso da língua portuguesa em sua modalidade oral onde se faz uso da voz. A língua de sinais possui status de língua pois, é formada pelos aspectos: fonológico, morfológico, sintático e semântico, não sendo apenas meros sinais ou o português sinalizado como é comumente dito</p>
              </div>
            </div>

        </div>
    </div>

    <!-- Rodapé -->

    <div class="Rodape">
      <center>
        <img src="img/Logotipo.png" alt="">
      </center>
      <p>Todos os direitos estão reservados ao © LIBRASON 2018 - 2019</p>
      <p>Icones disponibilizados por <a class="uk-button-text" href="https://www.freepik.com/" title="Freepik">Freepik</a> de <a class="uk-button-text" href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> licenciado por <a class="uk-button-text" href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></p>
    </div>

    <div class="Desenvolvedor">
      <p>Essa plataforma foi criada por Micaella Fernandes, Jacileia Nascimento Soares e Caio Alexandre de Sousa Ramos.</p>
      <p>Desenvolvedor e Contato: Caio Alexandre de Sousa Ramos.

      </p>
      <a class=" uk-animation-toggle uk-animation-shake" href="http://facebook.com/CaioAlex00" target="_blank"><img class="uk-animation-shake" src="img/RS1.png" alt="" width="25px;"></a>
      <a class=" uk-animation-toggle uk-animation-shake" href="https://github.com/caioalex00" target="_blank"><img class="uk-animation-shake" src="img/RS2.png" alt="" width="25px;"></a>
      <a class=" uk-animation-toggle uk-animation-shake" href="https://www.instagram.com/caioalex00/" target="_blank"><img class="uk-animation-shake" src="img/RS3.png" alt="" width="25px;"></a>
      <a class=" uk-animation-toggle uk-animation-shake" href="mailto:caioxandres2000@gmail.com" target="_blank"><img class="uk-animation-shake" src="img/RS4.png" alt="" width="25px;"></a>
    </div>

    <!-- Modal de Login -->

    <div id="modal-login" uk-modal>
      <div class="uk-modal-dialog" style="width: 450px;">
        <button class="uk-modal-close-default btn-none-pers" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title TituloModal">Entrar no <span style="color:#3269c4">LIBRAS</span><span style="color:#ff3229">ON</span></h2>
        </div>
        <div class="uk-modal-body">
          <form method="post" action="../loginDeUsuario.php">
              <div>
                <div class="input-field">
                  <i class="material-icons prefix">account_circle</i>
                  <input name="userNick" id="user_librason" type="text" class="validate">
                  <label for="user_librason">Usuário</label>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">lock_outline</i>
                  <input name="userSenha" id="pass_librason" type="password" class="validate">
                  <label for="pass_librason">Senha</label>
                </div>
              </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
          <button class="uk-button uk-button-default uk-modal-close btn-color-secundario" type="button">Sair</button>
          <button name="logarusuario" class="uk-button uk-button-primary btn-color-primeiro" type="submit">Login</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal de Cadastro -->

    <div id="modal-cadastro" class="uk-modal-full" uk-modal>
      <div class="uk-modal-dialog">
          <button class="uk-modal-close-full uk-close-large btn-none-pers" type="button" uk-close></button>
          <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
              <div class="uk-background-cover" style="background-image: url('img/Cadastro.png');" uk-height-viewport></div>
              <div class="uk-padding-large">
                  <h1 style="font-family: 'Timmana', sans-serif; margin-top: 0">Cadastro para acesso ao <span style="color:#3269c4">LIBRAS</span><span style="color:#ff3229">ON</span></h1>
                  <div class="row" style="overflow: hidden">
                      <form class="col s12" method="post" action="../finalizarCadastro.php" enctype="multipart/form-data">
                      <div class="row">
                        <div class="input-field col s6">
                          <input name="userName" id="Primeiro_Nome" type="text" class="validate" minlength="2" maxlength="50" required>
                          <label for="Primeiro_Nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                          <input name="userSobrenome" id="Ultimo_Nome" type="text" class="validate" minlength="2" maxlength="50" required>
                          <label for="Ultimo_Nome">Sobrenome</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s6">
                          <input name="userEmail" id="Email" type="email" class="validate" required>
                          <label for="Email">Email</label>
                        </div>
                        <div class="input-field col s6">
                          <input name="userNick" id="User" type="text" class="validate" required>
                          <label for="User">Usuário</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s6">
                          <input name="userSenha" id="Senha" type="password" class="validate" minlength="8" maxlength="30" required>
                          <label for="Senha">Senha</label>
                        </div>
                        <div class="input-field col s6">
                          <input name="userSenhaC" id="Confirmar_Senha" type="password" class="validate" minlength="8" maxlength="30" required>
                          <label for="Confirmar_Senha">Confirmar Senha</label>
                        </div>
                      </div>
                      <div class="file-field input-field">
                        <div class="btn btn-color-primeiro">
                          <span>Foto de Perfil</span>
                          <input name="userFoto" type="file" class="btn-color-primeiro"  accept="image/jpeg" required>
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text">
                        </div>
                      </div>

                      <button name="CadastrarUsuario"class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom  btn-color-primeiro">Cadastrar</button>

                    </form>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <!-- Modal de Sucesso no Cadastro -->

    <div id="modal-sucesso" uk-modal>
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title">Sucesso no cadastro</h2>
        </div>
        <div class="uk-modal-body">
          <p style="color: #000">Você acaba de realizar o cadastro no LibrasON! Aproveite do nosso curso de introdução a Língua brasileira de sinais (LIBRAS). Faça o login com seu usuário e senha registrado.</p>
        </div>
        <div class="uk-modal-footer uk-text-right">
          <button class="uk-button uk-button-default uk-modal-close btn-color-primeiro" type="button">OK, Obrigado!</button>
        </div>
      </div>
    </div>

    <!-- Modal de Erro no Cadastro -->

    <div id="modal-ERRO" uk-modal>
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title">Erro no Cadastro</h2>
        </div>
        <div class="uk-modal-body">
          <p style="color: #000">
            <?php
              if(isset($_REQUEST['ERROCADASTRO'])){
                if($_REQUEST['ERROCADASTRO'] == 1){
                  echo "As suas senhas digitadas são incompatíveis, tente novamente";
                }else if($_REQUEST['ERROCADASTRO'] == 2){
                  echo "O seu nome de usuário está com um problema de formatação, evite usar espaço, simbolos ou caracteres especiais e tente novamente;";
                }else if($_REQUEST['ERROCADASTRO'] == 3){
                  echo "O seu nome de usuário já consta em nossa base, por favor tente novamente com um usuário diferente";
                }else if($_REQUEST['ERROCADASTRO'] == 4){
                  echo "A sua senha precisa de no minímo 8 caracteres, tente novamente";
                }
              };
            ?>
          </p>
        </div>
        <div class="uk-modal-footer uk-text-right">
          <button class="uk-button uk-button-default uk-modal-close btn-color-primeiro" type="button">OK, Obrigado!</button>
        </div>
      </div>
    </div>

    <!-- Modal de Erro no Login -->

    <div id="modal-ERROL" uk-modal>
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title">Erro no Login</h2>
        </div>
        <div class="uk-modal-body">
          <p style="color: #000">
            <?php
              if(isset($_REQUEST['ERRO'])){
                if($_REQUEST['ERRO'] == 5){
                  echo "Esse nome de Usuário não consta na base do LibrasON";
                }else if($_REQUEST['ERRO'] == 6){
                  echo "Nome ou senha incorretos, tente novamente";
                }else if($_REQUEST['ERRO'] == 7){
                  echo "Acesso Negado!<br><br>Tente novamente, caso o erro persista é porque você não autorização para acessar essa pagina!";
                }
              };
            ?>
          </p>
        </div>
        <div class="uk-modal-footer uk-text-right">
          <button class="uk-button uk-button-default uk-modal-close btn-color-primeiro" type="button">OK, Obrigado!</button>
        </div>
      </div>
    </div>

    <!-- Codigo para exibir modals de acordo com retornos da URL via GET -->

    <?php  if(isset($_REQUEST['SucessoNoCadastro'])){?>
      <script type="text/javascript">
        UIkit.modal('#modal-sucesso').show();
      </script>
    <?php } ?>

    <?php  if(isset($_REQUEST['ERROCADASTRO'])){?>
      <script type="text/javascript">
        UIkit.modal('#modal-ERRO').show();
      </script>
    <?php } ?>

    <?php  if(isset($_REQUEST['ERRO'])){?>
      <script type="text/javascript">
        UIkit.modal('#modal-ERROL').show();
      </script>
    <?php } ?>

    <script type="text/javascript" src="Materializer/js/materialize.min.js"></script>
  </body>
</html>
