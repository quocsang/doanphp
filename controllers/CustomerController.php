<?php

include_once  MODEL_DIR . "/Customer.php";
include_once  MODEL_DIR . "/Company.php";
include_once  MODEL_DIR . "/Person.php";
include_once  MODEL_DIR . "/User.php";
/**
* 
*/
class CustomerController extends Controller
{
	
	public  function beforeAction()
    {
        //
        if (! $this->app->isLogin()){
            $this->app->goLogin();

        }

        return true;
    }

    public function indexAction()
    {
    	$mCustomer = new Customer();
    	$allCustomer = $mCustomer->findAll();
                

        $company = isset($_POST["company"])?$_POST["company"]:"";
        $allCustomer = $mCustomer->findAll();
        $companies = $mCustomer->getAllCompany();

        return $this->render("index", [
            'companies' => $companies,
            'company'   => $company,
            'allCustomer' => $allCustomer
        ]);
    }


    public function addAction()
    {
    

        $mCustomer = new Customer();
        $allCustomer = $mCustomer->findAll();

        $company = "";

        // GET -> Show form
        // POST --> Lưu dữ liệu
        $error = "";
        $isPost = $_SERVER["REQUEST_METHOD"] == "POST";

        if ($isPost){

            $data = $_POST;

            $mCustomer->load($data);

            if (! $mCustomer->save()){
                $error = "Lỗi: Không thể lưu."  ;
            }else{
                header("location: /customer/index.html");
            }

        }


        $mUser =  new User();
        $listUser = $mUser->findAll();

        $mCompany =  new Company();
        $listCompany = $mCompany->findAll();

        $mPerson =  new Person();
        $listPerson = $mPerson->findAll();


        return $this->render("add", [
            'listUser' => $listUser,
            'listCompany' => $listCompany,
            'listPerson' =>  $listPerson,
            'error' => $error
        ]);
    }

    public function deleteAction()
    {

        $id = $_GET["id"];

        $m = new Customer();

        $isOK = $m->delete($id);

        if ($isOK){
            header("location: /customer/index.html");
        }


        return $this->render("delete", [

        ]);


    }


}
    

