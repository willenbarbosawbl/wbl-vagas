<?php
    namespace App\Db;

    class Pagination{

        /**
         * Número máximo de registros por página
         * Maximum number of records per page
         * @var integer
         */
        private $limit;

        /**
         * Quantidade total de resultados do banco de dados
         * Total number of database results
         * @var integer
         */
        private $results;

        /**
         * Quantidade de páginas
         * Number of pages
         * @var integer
         */
        private $pages;

        /**
         * Página Atual
         * Current page
         * @var integer
         */
        private $currentPage;

        /**
         * Construtor da Class
         * Class constructor.
         * @param integer $results
         * @param integer $currentPage
         * @param integer $limit
         */
        public function __construct($results,$currentPage = 1, $limit = 3){
            $this->results      = $results;
            $this->limit        = $limit;
            $this->currentPage  = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
            $this->calculate();
        }

        /**
         * Método responsável por calcular a páginação
         * Method responsible for calculating the page
         */
        private function calculate(){
            $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;
            //VERIFICA DE SE PÁGINA ATUAL NÃO EXCEDE O NÚMERO DE PÁGINAS
            $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
        }

        /**
         * Método responsável por retornar a cláusula limit da SQL
         * Method responsible for returning the limit clause in SQL
         * @return string
         */
        public function getLimit(){
            $offset = ($this->limit * ($this->currentPage - 1));
            return $offset.','.$this->limit;
        }

        /**
         * Método responsável por retornar as opções de páginas disponíveis
         * Method responsible for returning available page options
         * @return array
         */
        public function getPages(){
            //NÃO RETORNA PÁGINAS
            if ($this->pages == 1) return [];
            //PÁGINAS
            $paginas = [];
            for ($i = 1;$i <= $this->pages;$i++){
                $paginas[] = [
                    'pagina'        => $i,
                    'pagina_atual'  => $i == $this->currentPage
                ];
            }
            return $paginas;
        }


    }