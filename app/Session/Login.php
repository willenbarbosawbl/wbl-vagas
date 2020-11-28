<?php
    namespace App\Session;

    class Login{

        /**
         * Método responsável por iniciar a sessão
         * Method responsible for starting the session
         */
        private static function init(){
            if (session_status() !== PHP_SESSION_ACTIVE){
                session_start();
            }
        }

        /**
         * Método responsável por logar o usuario
         * Method responsible for logging the user
         * @param Usuario
         */
        public static function login($obUsuario){
            //INICIA A SESSÃO
            self::init();
            $_SESSION['usuario'] = [
                'id' => $obUsuario->id,
                'name' => $obUsuario->name,
                'email' => $obUsuario->email
            ];

            //REDIRECIONA USUÁRIO PARA INDEX
            header('location: index.php');
            exit;
        }

        /**
         * Método responsável por verficar se o usuário está logado.
         * Method responsible for verifying that the user is logged.
         * @return boolean
         */
        public static function isLogged(){
            //INICIA A SESSÃO
            self::init();            
            return isset($_SESSION['usuario']['id']);
        }
        
        /**
         * Método responsável por obrigar o usuário a estar logado para acessar
         * Method responsible for compelling the user to be logged in to access
         */
        public static function requireLogin(){
            if (!self::isLogged()){
                header('location: login.php');
                exit;
            }
        }

        /**
         * Método responsável por obrigar o usuário a estar deslogado do sistema
         * Method responsible for compelling the user to be disconnected from the system
         */
        public static function requireLogout(){
            if (self::isLogged()){
                header('location: index.php');
                exit;
            }
        }

        /** 
         * Método responsável por retornar os dados do usuário logado
         * Method responsible for returning the logged user data
         * @return array
        */
        public static function getUserForLogged(){
            //INICIA A SESSÃO
            self::init();
            //RETORNA DADOS DO USUÁRIO
            return self::isLogged() ? $_SESSION['usuario'] : null;
        }

        /**
         * Método responsável por deslogar usuario
         * Method responsible for logging out user
         */
        public static function logout(){
            //INICIA A SESSÃO
            self::init();
            //REMOVE A SESSÃO DO USUÁRIO
            unset($_SESSION['usuario']);
            //REDIRECIONA USUARIO PARA LOGIN
            header('location: login.php');
            exit;
        }


    }