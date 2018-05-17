<?php
/**
 * Created by PhpStorm.
 * User: dangvo
 * Date: 4/20/2018
 * Time: 2:57 PM
 */

include  MODEL_DIR . "/Airport.php";

class AirportController extends Controller
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


        $mAiport = new Airport();
        $mAiport->findOne(" WHERE code ='AAX' ");

        $mUser = new User();
        $mUser->findOne(" WHERE id=1");

        $country = isset($_POST["country"])?$_POST["country"]:"";
        $allAirport = $mAiport->findAll(" WHERE country='". $country ."' ");

        $countries = $mAiport->getAllCountry();

        return $this->render("index", [
            'countries' => $countries,
            'country'   => $country,
            'allAirport' => $allAirport
        ]);

    }

    public function addAction()
    {

        $mAiport = new Airport();
        $countries = $mAiport->getAllCountry();

        $country = "";

        // GET -> Show form
        // POST --> Lưu dữ liệu
        $error = "";
        $isPost = $_SERVER["REQUEST_METHOD"] == "POST";

        if ($isPost){

            $data = $_POST;

            $mAiport->load($data);

            if (! $mAiport->save()){
                $error = "Lỗi: Không thể lưu."	;
            }else{
                header("location: /airport/index.html");
            }

        }

        return $this->render("add", [
            'error' => $error,
            'country'  => $country,
            'countries'    => $countries
        ]);
    }

    public function deleteAction()
    {

        $code = $_GET["id"];

        $m = new Airport();

        $isOK = $m->delete($code);

        if ($isOK){
            header("location: /airport/index.html");
        }


        return $this->render("delete", [

        ]);


    }


}