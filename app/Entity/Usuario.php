<?php
    namespace App\Entity;
    use \App\Db\Database;
    use \PDO;

    class Usuario{

        /**
         * Identificador único do usuário
         * Unique user identifier
         * @var integer
         */
        public $id;

        /**
         * Nome do Usuário
         * Username
         * @var string
         */
        public $name;

        /**
         * E-mail do Usuário
         * User Email
         * @var string
         */
        public $email;

        /**
         * Hash da senha do usuário
         * User password hash
         * @var string
         */
        public $senha;

        /**
         * Método responsável por cadastrar um novo usuário no banco de dados
         * Method responsible for registering a new user in the database
         * @return boolean
         */
        public function register(){
            //DATABASE
            $obDatabase = new Database('usuarios');
            $this->id = $obDatabase->insert([
                'name' => $this->name,
                'email' => $this->email,
                'senha' => $this->senha
            ]);
            return true;
        }

        /**
         * Método responsável por retornar uma instância de usuário com base em seu e-mail
         * Method responsible for returning a user instance based on your email
         * @param string $email
         * @return Usuario
         */
        public static function getUserForEmail($email){
            return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
        }

    }