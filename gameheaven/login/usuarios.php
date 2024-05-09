<?php
    require_once("../config.php");
    class Usuario{
        protected $conn;

        public function __construct(){
            try{
                $this->conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
            }catch(PDOException $e){
                die("ERROR " .$e->getMessage());
            }
        }

        public function __destruct(){
            $this->conn = null;
        }

        public function verificar($usuario, $contra){
            $query = "SELECT nombre, contrasena FROM usuarios WHERE nombre =:usuario AND contrasena =:contra";
            $stmt = $this->conn->prepare($query);
           $parametros = [':usuario' =>$usuario, ':contra'=>$contra];
            $stmt->execute($parametros);

            if($stmt->rowCount() > 0){
                session_start();
                $_SESSION["usuario"]=$usuario;
                header("Location: ../index.php");
            }else{
                echo "<div class='mensaje-error'>El usuario o la contraseña son incorrectos.</div>";
            }

            $stmt=null;
        }
    }