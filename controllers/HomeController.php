<?php
/**
 * Created by PhpStorm.
 * User: dangvo
 * Date: 4/21/2018
 * Time: 2:50 PM
 */

class HomeController extends Controller
{
    public function indexAction()
    {
<<<<<<< HEAD
        // echo password_hash("1234", PASSWORD_DEFAULT);
=======
<<<<<<< HEAD
        // echo password_hash("1234", PASSWORD_DEFAULT);
=======
        //echo password_hash("1234", PASSWORD_DEFAULT);
>>>>>>> doanphp/master
>>>>>>> origin/master
       // echo $this->app->getUser()->username;

        return $this->render("index");

    }

    public function ajaxTestAction()
    {

        if ( $this->app->isPost()){
            $username =$this->app->post("username", "unknown");

            $status = "NO";
            $msg = "Error!";
            if ($username == "admin"){
                $status = "OK";
                $msg = "Success";
            }

            $result = [
                'status'    => $status,
                'message'   => $msg
            ];

            echo  json_encode($result);
        }
    }

}