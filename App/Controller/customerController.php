<?php
namespace Controller;

use App\Customers;
use Models\CustomerModel;
use Models\Database;

class CustomerController
{
    public CustomerModel $customerDB;

    public function __construct()
    {
        $database = new Database();
        $this->customerDB = new CustomerModel($database->connect());
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET"){
            include "Resource/View/Customers/add.php";
        }else{

            $error = [];
            $fields = ["name","email","address"];

            foreach ($fields as $field){
                if (empty($_POST[$field])){
                    $error[$field] = "khong duoc de trong";
                }
            }

            if (empty($error)){
                $name = $_POST["name"];
                $email = $_POST["email"];
                $address = $_POST["address"];

                $data = [
                    "name" => $name,
                    "email" => $email,
                    "address" => $address
                ];

                $customer = new Customers($data);
                $this->customerDB->create($customer);
                header("Location: index.php");
            }else{
                include "Resource/View/Customers/add.php";
            }

        }


    }

    public function index()
    {
        $customers = $this->customerDB->getAll();
        include 'Resource/View/Customers/list.php';
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->customerDB->delete($id);
        header('Location: index.php');
    }


}