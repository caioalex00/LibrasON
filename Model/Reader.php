<?php
/**
 * @project: LibrasON
 * @name: Read
 * @description: Classe que realiza A função READ do CRUD ou seja ler o dados 
 * contidos no banco
 * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0 - 10/02/2019
 * @métodos executarQuery(), prepararQuery(), executar(), getResultado(), getQtsResultado()
 */
class Reader extends Conexao{
    /** @var string $tabela armazena o nome da tabela onde os dados serão lidos */
    private $tabela;
    /** @var string $counas armazena as colunas desejadas */
    private $colunas;
    /** @var string $where armazena as colunas que serão utilizadas no WHERE */
    private $where;
    /** @var string $condicao armazena os valores que serão utilizados como condicão no WHERE */
    private $condicao;
    /** @var string $query armazena o nome da tabela onde os dados serão lidos */
    private $query;
    /** @var string $resultado armazena as linhas retornadas do banco na pesquisa */
    private $resultado;
    /** @var int $numLinhas armazena o numero de linhas retornado do banco */
    private $numLinhas;
    
    
    /**
     * @Descrição: Armazena os valores necessarios na instanciação e executa o 
     * metodo construct da Classe herdada Conexao
     * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param string $tabela armazena o nome da tabela obtido na instanciação
     * @param string $colunas armazena o nome das colunas onde os dados serão lidos
     * @param string $where armazena os dados que serão usados para indicar a linha a ser lida
     * @param string $condicao armazena os dados que serão usados para indicar a linha a ser lida
     */
    public function __construct($tabela, $colunas, $where, $condicao) {
        parent::__construct();
        $this -> tabela = $tabela;
        $this -> colunas = $colunas;
        $this -> where = $where;
        $this -> condicao = $condicao;
        $this -> resultado = "Resultado não disponivel!"; 
    }
    
    /**
     * @Descrição: Executa os metódos prepararQuery() e executar() um depois do outro
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    public function executarQuery() {
        $this->prepararQuery();
        return $this->executar();
    }
    
    /**
     * @Descrição: Esse metódo e responsavel por gerar a query que ira ler os 
     * dados armazenados no banco e por fim armazenar a query gerada no atributo
     * $query
     * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function prepararQuery() {
        $query = "SELECT " . $this->colunas . " FROM " . $this -> tabela;
        //Separamos os nomes das conunas do banco em um array
        $arrayColunas = explode(",", $this -> where);
        
        //Aqui preparamos o WHERE da query, para indentificarmos quais informações devem ser lidas
        if(!empty($this->where)){
            //Montamos a variavel com o WHERE
            $query .= " WHERE ";
            
            //Nesse repetidor montamos a query adicionando as colunas necessarias mais o "=?" e o AND quando necessario
            for ($i = 0;$i < count($arrayColunas);$i++){
                if($i != 0 ){
                    $query .= " AND ";
                }
                
                $query .= $arrayColunas[$i] . " = ?";
            }
        }
        //Armazenamos a qlizuery gerada para utilização futura
        $this -> query = $query;
    }
    
    /**
     * @Descrição: Responsavel por executar a query gerada no metodo prepararQuery()
     * e armazenamento do resultado no atributo $resultado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/02/2018
     * @parametros Sem parâmetros
     */ 
    private function executar(){
        try {
            //Realizamos conexao com o banco
            $con = $this->conectar();
            //Preparamos a query
            $pdo = $con -> prepare($this->query);
            //Separamos os dados em um array
            $array = explode(",", $this->condicao);
            $numParam = count($array);
            
            //Inserimos os dados no bindParam por meio de um repetidor
            for($i = 1, $j = 0;$j < $numParam;$i++,$j++){
                $pdo -> bindParam($i, $array[$j]);
            }
            //Executamos a query
            $pdo -> execute();
            //Armazenamos a quantidade e resultados obtidos
            $this->numLinhas = $pdo->rowCount();
            
            if($this->numLinhas >= 1){
                $resultado = $pdo->fetchAll(PDO::FETCH_OBJ);
            }else{
                $resultado = NULL;
            }  
            
        } catch (Exception $ex) {
            //Imprimos o erro caso haja
            $resultado = $ex -> getMessage(); 
        }
        
        //Armazenamos o resultado
        $this->resultado =  $resultado;
    }
    
    
    /**
     * @Descrição: Responsavel por executar Funções contidas no SGBD
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 20/02/2018
     * @parametros Sem parâmetros
     */ 
    public function chamarFuncao() {
        try {
            //Preparando Select de Função que foi inserido na variavel tabela 
            $select = $this->tabela;
            $select = "SELECT " . $this->tabela . "( " . $this->colunas . ");";
            //Realizamos conexao com o banco
            $con = $this->conectar();
            //Preparamos a query
            $pdo = $con -> prepare($select);
            //Executamos a query
            $pdo -> execute();
            
            //Armazena resultado e retornando
            $resultado = $pdo->fetchAll(PDO::FETCH_NUM);
            $this->resultado = $resultado;
            
            return $resultado[0][0];
            
        } catch (Exception $ex) {
            //Imprimimos o erro caso haja
            $resultado = $ex -> getMessage(); 
        }
        
        //Armazenamos o resultado e retornando
        return $this->resultado =  $resultado;
    }
    
    /**
     * @Descrição: retorna valor contido no atributo $resultado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    public function getResultado() {
        return $this->resultado;
    }
    
    /**
     * @Descrição: retorna valor contido no atributo $numLinhas
     * @copyright (c) 12/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    public function getnumLinhas() {
        return $this->numLinhas;
    }

}