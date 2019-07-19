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
$idCurso = $_REQUEST['idCurso'];
$idTarefa = $_REQUEST['idProposta'];

$Painel = new PainelCursos($idCurso, $usuario);
$Tarefa = new Tarefa($idTarefa, $idCurso, $usuario);

if(!$Painel->verificarPermissao()){
    echo "<script>window.location.href = 'MeusCursos.php?ERRO=7'</script>";
}

$Curso = $Painel->retornarInfCurso();
$Informacoes = $Tarefa->buscarInformacoes();

$date = new DateTime($Informacoes->DataCriacao);
$DataD = date_format($date, 'd-m-Y');
$DataH = date_format($date, 'H:i:s');
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
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
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

                        <li>
                            <a href="Cursos.php">  Cursos  </a>
                        </li>

                        <li class="uk-active">
                            <a href="MeusCursos.php">  Meus Cursos  </a>
                        </li>

                        <li>
                            <a href="Comunidades.php">  Comunidade  </a>
                        </li>

                        <li>
                            <a href="Comunicados.php">  Comunicados e Novidades  </a>
                        </li>

                        <li>
                            <a href="#offcanvas-nav-primary" uk-toggle>  <?php echo $_SESSION['nome']; ?>  </a>
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
                            <div title="dd" class="uk-width-expand@m">
                                <h3 class="uk-card-title TituloCard" style="margin-bottom: 0"><?php echo $Informacoes->Proposta?></h3>
                                <h5 class="TituloCard" style="margin-top: 0"><?php echo $Curso->Nome?></h5>
                            </div>
                        </div>
                        
                        <hr class="uk-divider-icon">
                        
                        <div style="width: 80%; margin: 0 auto;">
                            
                            <!-- codigo de segurança -->
                            <script>var qtdQ = 0;</script>
                            <!-- Inicio da Atividade -->
                            
                            <?php $Tarefa->imprimirquestoes()?>
                            
                            <!-- Tratamento de dados -->
                            <script>
                                
                                //Ness codigo Js, os dados são tratados, pegando todos os dados de um
                                //formulario que aparece para o usuario e jogando os dados tratados em
                                // um formulario oculto, que será este a ser enviado.
                                
                                var form = document.getElementById("form_tarefa");
                                
                                function atualizarForm(){
                                    for (var i = 0; i < qtdQ; i++) {
                                        var top = i + 1;
                                        var ver1 = document.getElementById("questao_" + top);
                                        var ver2 = ver1.getAttribute('title');
                                        
                                        if(ver2 === 'DropDown'){
                                            registrarCLEDD(top);
                                        }else if(ver2 === 'Formulario'){
                                            registrarF(top);
                                        }else if(ver2 === 'Coluna'){
                                            registrarCLEDD(top);
                                        }else if(ver2 === 'Aberta'){
                                            registrarA(top);
                                        }
                                    }
                                    
                                    document.getElementById("form_final").submit();
                                }
                                
                                function registrarF(numQ){
                                    var form1 = document.getElementById("questao_" + numQ);
                                    var respQ = 'not';
                                    var questaoHTML = form1.getElementsByTagName('input');
                                    var tam = questaoHTML.length;
                                    
                                    for(var i=0; i<tam; i++) {
                                        if(questaoHTML[i].checked){
                                            var la =questaoHTML[i].value;
                                            respQ = la;
                                        }
                                    }
                                    
                                    document.getElementById('qFinal_' + numQ).value = respQ;
                                }
                                
                                function registrarCLEDD(numQ){
                                    var form1 = document.getElementById("questao_" + numQ);
                                    var respQ = '';
                                    var questaoHTML = form1.getElementsByTagName('input');
                                    var tam = questaoHTML.length;
                                    
                                    for(var i=0; i<tam; i++) {
                                        respQ += questaoHTML[i].value;
                                    }
                                    
                                    document.getElementById('qFinal_' + numQ).value = respQ;
                                }
                                
                                function registrarA(numQ){
                                    var form1 = document.getElementById("questao_" + numQ);
                                    var questaoHTML = form1.getElementsByTagName('input');
                                    
                                    if(questaoHTML[0].value === ''){
                                        var respQ = 'not';
                                    }else{
                                        var respQ = questaoHTML[0].value;
                                    }
                                    
                                    
                                    document.getElementById('qFinal_' + numQ).value = respQ;
                                }
                                
                            </script>
                        </div>
                        
                        <hr class="uk-divider-icon">

                        <article class="uk-article" style="width: 80%; margin: 20px auto;">
                            <p class="uk-article-meta">Escrito por LibrasON | Tarefa disponível desde  <?php echo "$DataD e $DataH"?>.
                            <p class="uk-text-lead">Algumas coisas sobre as tarefas dos cursos</p>
                            <p style="text-align: justify">As tarefas são um meio de avaliação do LibrasON, a tarefa só ira se dar por completa quando todas as perguntas estiverem certas. Lembrando que o LibrasON não mostra as respostas corretas a cada tentativa. Sendo assim as tarefas só serão completas se você dominar o assunto. Assista os vídeos! </p>
                            <p style="text-align: justify; color: red">Para um melhor aproveitamento, é necessario que haja uma conexão estável e boa com a internet </p>

                             <div class="uk-grid-small uk-child-width-auto" uk-grid>
                                <div>
                                    <a class="uk-button uk-button-text" href="Cursos.php">Para mais informações consulte o regulamento deste curso na pagina dos cursos</a>
                                </div>
                            </div>
                        </article>
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

        <div class="Rodape" style="height: 160px">
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
                    <li><a href="Cursos.php"><span class="uk-margin-small-right" uk-icon="icon: grid"></span> Cursos</a></li>
                    <li class="uk-active"><a href="MeusCursos.php"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Meus Cursos</a></li>
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
        
        <script type="text/javascript" src="Materializer/js/materialize.min.js"></script>
    </body>
</html>
