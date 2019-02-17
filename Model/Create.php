<?php
/**
 * @project: LibrasON
 * @name: Create
 * @description: Classe que realiza A função CREATE do CRUD ou seja inserir dados no banco
 * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0 - 10/02/2019
 * @métodos executarQuery(), prepararQuery(), executar(), setDadosValues
 */
class Create extends Conexao{
    /** @var string $tabela armazena o nome da tabela onde os dados serão lidos */
    private $tabela;
    /** @var string $colunas armazena o nome das colunas a serem inseridos dados */
    private $colunas;
    /** @var string $valores armazena os dados a serem inseridos */
    private $valores;
    /** @var string $query armazena o sql de criação gerado pela classe */
    private $query;
    /** @var int $tabela armazena o ID do ultimo create */
    public $idGerado;
    /** @var string $erro armazena a excessão gerada */
    public $erro;
    /** @var string $erroPDO armazena o erro de banco (Caso Houver)*/
    public $erroPDO;
    
    /**
     * @Descrição: Armazena os valores necessarios na instanciação 
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @param string $tabela armazena o nome da tabela obtido na instanciação
     * @param string $colunas armazena o nome das colunas onde os dados serão inseridos
     * @param string $valores armazena os dados que serão inseridos no banco
     */
    public function __construct($tabela,$colunas,$valores) {  
        parent::__construct();
        $this->tabela = $tabela;
        $this->colunas = $colunas;
        $this->setValores($valores); 
    }
    
    /**
     * @Descrição: Executa os metódos prepararQuery() e executar() um depois do outro
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    public function executarQuery(){
        $this->prepararQuery();
        $this->executar();
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
        $numDeParametros = "";
        
        //Utilizamos o repetidor forech para inserir os "?"  necessarios na query
        foreach ($this->valores as $value){
            $numDeParametros .= "?,";
        }
        //Retiramos a ultima virgula que sobro do repetidor 
        $parametros = substr($numDeParametros,0,-1);
        //Montamos a query com os valores obtidos
        $query = "INSERT INTO " . $this->tabela . "(" . $this->colunas . ") " . "VALUES(" . $parametros . ")";
        //Armazenamos o resultado no atributo $queryFinal 
        $this->query =  $query;
    }
    
    /**
     * @Descrição: Responsavel por executar a query gerada no metodo prepararQuery()
     * e armazenamento do resultado no atributo $resultado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/02/2018
     * @parametros Sem parâmetros
     */
    private function executar() {
        try {
            //Execultamos a conexão com o banco
            $con = $this->conectar();
            //Preparamos a query
            $pdo = $con -> prepare($this->query);
            
            $array = $this->valores;
            $numParam = count($array) + 1;
            //Com um repetido e o array dos dados, execultamos os bindParam necessarios
            for($i = 1,$j = 0;$i < $numParam;$i++,$j++){
                $pdo -> bindParam($i, $array[$j]);
            }
            
            //Execultamos a query
            $pdo -> execute();
            $this->idGerado = $con -> lastInsertId();
            $this->erroPDO =  $pdo->errorInfo();
            
        } catch (Exception $ex) {
            //Imprimos o erro na tela caso ocorra algum problema
            $this->erro =  $ex->getMessage();
        }
    }
    
    /**
     * @Descrição: retorna valor contido no atributo $qtsResultado
     * @copyright (c) 12/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */ 
    private function setValores($Valores) {
        $arrayValores = explode("|\|R", $Valores);
        $this->valores = $arrayValores;
    }
}