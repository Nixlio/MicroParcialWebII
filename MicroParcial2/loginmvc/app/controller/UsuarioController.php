<?php
require_once('../model/UsuarioModel.php');

class UsuarioController {
    public function login($email, $password) {
        $model = new UsuarioModel();
        $usuario = $model->login($email, $password);
        if ($usuario) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: ../view/bienvenido.php");
            exit();
        } else {
            echo "Usuario no registrado o contraseña incorrecta";
            header("refresh:1;url=../view/login.php");
        }
    }
}

session_start();

if (isset($_POST['action'])) {
    require_once('UsuarioController.php');
    $controller = new UsuarioController();

    if ($_POST['action'] === 'login') {
        $controller->login($_POST['email'], $_POST['password']);
    } elseif ($_POST['action'] === 'registrar') {
        $controller->registrar($_POST['email'], $_POST['password'], $_POST['confirm_password']);
    }
}
?>