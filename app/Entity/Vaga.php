<?php
    namespace App\Entity;
    use \App\Db\Database;
    use \PDO;

    //echo "<pre>"; print_r($obDatabase); echo "</pre>"; exit;
    class Vaga{

        /**
         * Unique job identifier
         * Identificador único da vaga
         * @var integer
         */
        public $id;

        /**
         * Job Title
         * Título da Vaga
         * @var string
         */
        public $title;

        /**
         * Job Description
         * Descrição da Vaga
         * @var string
         */
        public $description;

        /**
         * Defines whether the vacancy is active
         * Define se a vaga está ativa
         * @var string(s/n)
         */
        public $active;

        /**
         * Date of publication of the vacancy
         * Data de publicação da vaga
         * @var string
         */
        public $date;

        /**
         * Method responsible for registering a new vacancy in the database
         * Método responsável por cadastrar uma nova vaga no banco de dados
         * @return boolean
         */
        public function register(){
            //DEFINE A DATA
            $this->date = date('Y-m-d H:i:s');
            //INSERIR A VAGA NO BANCO DE DADOS
            $obDatabase = new Database('wbl_vagas');
            $this->id = $obDatabase->insert([
                'title'         => $this->title,
                'description'   => $this->description,
                'active'        => $this->active,
                'date'          => $this->date
            ]);            
        
            //RETORNAR SUCESSO
            return true;
        }

        /**
         * Método responsável por atualizar a vaga no banco de dados
         * Method responsible for updating the vacancy in the database
         * @return boolean
         */
        public function update(){
            return (new Database('wbl_vagas'))->update('id = '.$this->id,[
                'title'         => $this->title,
                'description'   => $this->description,
                'active'        => $this->active,
                'date'          => $this->date
            ]);    
        }

        /**
         * Método responsável por apagar vaga do banco de dados
         * Method responsible for deleting a vacancy in the database
         * @return boolean
         */
        public function delete(){
            return (new Database('wbl_vagas'))->delete('id = '.$this->id);
        }

        /**
         * Método responsável por obter as vagas do banco de dados
         * Method responsible for obtaining vacancies from the database
         * @param string $where
         * @param string $order
         * @param string $limit
         * @return array
         */
        public static function getVagas($where = null, $order = null, $limit = null){
            return (new Database('wbl_vagas'))->select($where,$order,$limit)
                                              ->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        /**
         * Método responsável por obter a quantidade de vagas do banco de dados
         * Method responsible for obtaining the number of vacancies in the database
         * @param string $where
         * @return integer
         */
        public static function getQuantidadeVagas($where = null){
            return (new Database('wbl_vagas'))->select($where, null, null, 'COUNT(*) as qtd')
                                              ->fetchObject()
                                              ->qtd;

        }

        /**
         * Método responsável por buscar uma vaga com base em seu id
         * Method responsible for seeking a vacancy based on your id
         * @param integer $id
         * @return Vaga
         */
        public static function getVaga($id){
            return (new Database('wbl_vagas'))->select('id = '.$id)
                                              ->fetchObject(self::class);
        }

    }// class Vaga