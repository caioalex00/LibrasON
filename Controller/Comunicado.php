<?php
 /**
 * @project: LibrasON
 * @name: Comunicado
 * @description: Classe que contém as funções da pagina de comnunicado;
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0  - 10/02/2019
 * @métodos buscarInformacoes
 */

class Comunicado {
    
     /**
     * @Descrição: Busca todos os dados de comunicados
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function buscarInformacoes(){
        $Read = new Reader("notificacoes_gerais", "*", null, null);
        $Read->executarQuery();
        return $Read->getResultado();
    }
    
    /**
     * @Descrição: Imprime os Comunicados na Tela
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function imprimirComunicados() {
        $comunicav = $this->buscarInformacoes();
        $comunica = array_reverse($comunicav);
        foreach ($comunica as $value) {
            $date = new DateTime($value->DataCriacao);
            $DataD = date_format($date, 'd/m/Y');
            $DataH = date_format($date, 'H:i:s');
        ?>
            <article class="uk-comment uk-comment-primary comentario-stilo">
              <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                  <img class="uk-comment-avatar uk-border-circle" src="img/ADM.jpg" width="80" height="80" alt="">
                </div>
                <div class="uk-width-expand">
                  <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">A administração</a></h4>
                  <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                    <li>Postado em: <?php echo $DataD ?> ás <?php echo $DataH ?></li>
                  </ul>
                </div>
              </header>
              <div class="uk-comment-body">
                  <p><?php echo $value->Texto ?></p>
              </div>
            </article>
        <?php
        }
    }
}
