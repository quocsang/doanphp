<?php
/**
 * Created by PhpStorm.
 * User: dangvo
 * Date: 4/21/2018
 * Time: 2:04 PM
 */

include_once MODEL_DIR . "/User.php";
include_once MODEL_DIR . "/Customer.php";
include_once MODEL_DIR . "/Employee.php";
include_once MODEL_DIR . "/Person.php";
include_once MODEL_DIR . "/Company.php";
include_once MODEL_DIR . "/Address.php";


class UserController extends Controller
{
    public function indexAction(){
        if (! $this->app->isLogin()){
            $this->app->goLogin();

        }

        // Kiem tra loai tai khoan
        $user = unserialize($_SESSION['user']);

        $customer = (new Customer())->getCustomer($user->id);

        if (empty($customer->id)) { //La Nhan vien
            $employee = (new Employee())->getEmployee($user->id);
            $person = (new Person())->getPerson($employee->person_id);
            $address = (new Address())->getAddressWhithPersion($employee->person_id);

            return $this->render("index", [
                                            'user' => $user,
                                            'employee'   => $employee,
                                            'person' => $person,
                                            'address' => $address

                                        ]);
        }
        else { //la nguoi dung
            $person = (new Person())->getPerson($customer->person_id);
            $company = (new Company())->getCompany($customer->company_id);
            $address = (new Address())->getAddressWhithPersion($customer->person_id);
            $addresscompany = (new Address())->getAddressWhithId($company->address_id);

            return $this->render("index", [
                                            'user' => $user,
                                            'customer' => $customer,
                                            'person'   => $person,
                                            'address' => $address,
                                            'company' => $company,
                                            'addresscompany' => $addresscompany

                                        ]);
        }
    }

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

    public function editPersonAction(){

        if (! $this->app->isLogin()){
            $this->app->goLogin();

        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $person = new Person();
            $person->load($_POST);
            
            if (empty($person->id)) {

                if (! $person->createPerson()){
                    $error = "Lỗi: Không thể lưu."  ;
                }else{
                    header("location: /user/index.html");
                }


            } else {
                if (! $person->updatePerson()){
                    $error = "Lỗi: Không thể lưu."  ;
                }else{
                    header("location: /user/index.html");
                }
            }
            
        }
        header("location: /user/index.html");
    }


    public function changePassAction()
    {
        if (! $this->app->isLogin()){
            $this->app->goLogin();

        }
        $error = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $oldpass = $_POST["oldpass"];
            $newpass = $_POST["newpass"];
            $confirmpass = $_POST["confirmpass"];
            $user = new User();
            //Phai load thu cong, vi no khong nhan het gia tri
            $user->id = unserialize($_SESSION['user'])->id;
            $user->username = unserialize($_SESSION['user'])->username;
            $user->password_hash = unserialize($_SESSION['user'])->password_hash;
            $user->group = unserialize($_SESSION['user'])->group;
            
            if (!$user->authenticate($oldpass)) {
                $error = "Mat khau cu khong chinh sat";
            }   elseif ($newpass == $oldpass) {
                    $error = "Mat khau moi phai khac mat khau cu";
                } elseif ($newpass != $confirmpass){
                       $error = "Xac nhan mat khau khong dung";
                    } else{
                       $success = "Thay doi thanh cong";
                       $user->updatePass($newpass);
                       $_SESSION['user'] = serialize($user); #cap nhat lai User cua session
                    }
            
        }

        return $this->render("change-pass", ['error' => $error,
                                            'success' => $success]);
    }

    public function forgotPassAction(){
        $error = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $newpass = $_POST["newpass"];
            $confirmpass = $_POST["confirmpass"];

            $user = (new User())->getUser($username);

            if (empty($user->id)) {
                $error = "Username khong ton tai";
            } elseif ($newpass == $confirmpass) {
                $user->updatePass($newpass);
                $success = "Thay doi thanh cong";
                } else {
                    $error = "Xac nhan mat khau khong dung";
                }
            

        }

        return $this->render("forgot-pass", ['error' => $error,
                                            'success' => $success]);
    }
}