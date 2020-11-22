<?php
    namespace App\Db;
    use \PDO;
    use \PDOException;

    class Database{
        /**
         * Host de Conexão com o banco de dados
         * Database Connection Host
         */
        const HOST = 'localhost';

        /**
         * Nome do banco de dados
         * Database name
         */
        const NAME = 'wbl_vagas';

        /**
         * Usuário do banco de dados
         * Database User
         */
        const USER = 'wbl_vagas';

        /**
         * Senha do banco de dados
         * Database Pass
         */
        const PASS = '1vV1$$SHzp0N';

        /**
         * Nome da tabela do banco de dados a ser manipulada
         * Name of the database table to be manipulated
         * @var string
         */
        private $table;

        /**
         * Instancia de conexão com o banco de dados
         * Instance of connection with the database
         * @var PDO
         */
        private $connection;

        /**
         * Define a tabela e instancia a conexao com o banco de dados
         * Defines the table and instantiates the connection to the database
         * @param string $table
         */
        public function __construct($table = null){
            $this->table = $table;
            $this->setConnection();                        
        }

        /**
         * Método responsável por criar uma conexão com o banco de dados
         * Method responsible for creating a connection to the database
         */
        private function setConnection(){
            try {
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        /**
         * Método responsável por executar queries dentro do banco de dados
         * Method responsible for executing queries within the database
         * @param string $query
         * @param array $params
         * @return PDOStatement
         */
        public function execute($query, $params = []){
            try {
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;
            } catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        /**
         * Método responsável por inserir dados do banco de dados
         * Method responsible for entering data from the database
         * @param array $values [ field => value ]
         * @return integer
         */
        public function insert($values){
            //DADOS DA QUERY
            $fields = array_keys($values);
            $binds  = array_pad([], count($fields), '?');
            //MONTA QUERY
            $query  = 'INSERT INTO '.$this->table.'('.implode(',',$fields).') VALUES('.implode(',',$binds).')';
            //EXECUTA O INSERT
            $this->execute($query, array_values($values));
            //RETORNA O ID INSERIDO
            return $this->connection->lastInsertId();   
        }
        
        /**
         * Método responsável por executar uma consulta no banco de dados
         * Method responsible for executing a query in the database
         * @param string $where
         * @param string $order
         * @param string $limit
         * @return PDOStatement
         */
        public function select($where = null, $order = null, $limit = null, $fields = '*'){
            //DADOS DA QEURY
            $where = strlen($where) ? ' WHERE '.$where : '';
            $order = strlen($order) ? ' ORDER BY '.$order : '';
            $limit = strlen($limit) ? ' LIMIT '.$limit : '';
            //MONTA QUERY
            $query = 'SELECT '.$fields.' FROM '.$this->table.$where.$order.$limit;
            //EXECUTA A QUERY
            return $this->execute($query);
        }

        /**
         * Método responsável por executar uma consulta no banco de dados
         * Method responsible for executing a query in the database
         * @param string $where
         * @param string $values [field => value]
         * @return boolean
         */
        public function update($where, $values){
            //DADOS DA QUERY
            $fields = array_keys($values);            
            //MONTA QUERY
            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
            //EXECUTAR A QUERY
            $this->execute($query, array_values($values));
            //RETORNA SUCESSO
            return true;
        }

        /**
         * Método responsável por deletar dado do banco de dados
         * Method responsible for deleting data from the database
         * @param string $where
         * @return boolean
         */
        public function delete($where){
            //MONTA QUERY
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
            //EXECUTAR A QUERY
            $this->execute($query);
            //RETORNA SUCESSO
            return true;
        }

    }// end class Database