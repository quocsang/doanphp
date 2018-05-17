<?php
/**
 * Created by PhpStorm.
 * User: dangvo
 * Date: 4/21/2018
 * Time: 2:04 PM
 */

include_once MODEL_DIR . "/User.php";
class UserController extends Controller
{

    public function loginAction()
    {

        $error = "";

        if ( $this->app->isLogin()){
            $this->app->goHome();

        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $username = $_POST["username"];
            $password = $_POST['password'];

            $user = (new User())->getUser($username);

            if ($user->authenticate($password)){

                $_SESSION['user']   = serialize($user);
                $this->app->goHome();
            }

            $error = "Invalid username and password.";

        }
        return $this->render("login", ['error' => $error]);
    }



    public function logoutAction()
    {
        unset($_SESSION['user']);
        $this->app->goHome();

    }


}