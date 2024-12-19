<?php
require_once "config.php";

class seguridad {
    private $session;
    private $user;
    private $conexion;
    private $rol;

    public function __construct($conexion) {
        $this->conexion = $conexion;
        $this->session = false;
        $this->user = "";
        $this->rol = "";
        session_start();

        // Comprobamos si hay una sesión activa
        if (isset($_SESSION['user'])) {
            $this->session = true;
            $this->user = $_SESSION['user'];
            $this->rol = $_SESSION['rol'];
        }
    }

    public function login($login, $password) {
        $login = filter_var($login, FILTER_SANITIZE_STRING);

        // Consulta segura con parámetros
        $sql = "select * FROM usuarios WHERE login = :login";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verificamos la contraseña con password_verify
            if (password_verify($password.$user['salt'], $user['password'])) {
                $_SESSION['user'] = $user['login'];
                $_SESSION['rol'] = $user['rol'];
                $this->session = true;
                $this->user = $user['login'];
                $this->rol = $user['rol'];
                return true;
            }
        }
        return false; // Credenciales incorrectas
    }

    public function logout() {
        $this->session = false;
        $this->user = "";
        session_unset();
        session_destroy();
    }

    public function isLogged() {
        return $this->session;
    }

    public function getUser() {
        return $this->user;
    }

    public function getRol() {
        return $this->rol;
    }

    public function secureRol($rol = NULL) {
        if ($rol == NULL) {
            return $this->isLogged();
        }
        
        if (!is_array($rol)) {
            $rol = [$rol];
        }

        if (!in_array($_SESSION['rol'], $rol)) {
            header("Location: ../index.php");
        }
    }
}
?>
