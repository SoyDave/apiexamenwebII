<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        echo "Index User Controller";
    }

    #url base http://localhost/api/index.php/User/

    ################################################################	

    #endpoint /adduser - agrega usuarios
    public function addUser()

    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST') {
            $jsonuser = file_get_contents('php://input');
            $datauser = json_decode($jsonuser);
            //validación de campos no vacios User    
            if ($datauser->name == "" || $datauser->lastname == "" || $datauser->email == "" || $datauser->type_id == "" || $datauser->identification == "" || $datauser->password == "") {
                $response = array("success" => false, 'response' => 'all camps is required!', "code" => 400);
                echo json_encode($response);
                //validación de simbolos para que el nombre y apellido solo contengra letras    
            } else if (!preg_match("/^[a-zA-Z ]*$/", $datauser->name) || !preg_match("/^[a-zA-Z ]*$/", $datauser->lastname)) {
                $response = array("success" => false, "success" => false, 'response' => 'the name and last name must only contain letters!', "code" => 400);
                echo json_encode($response);
                //validación de cantidad de caracteres para que el nombre y apellido no mayor a 40
            } else if (strlen($datauser->name) > 40 || strlen($datauser->lastname) > 40) {
                $response = array("success" => false, 'response' => 'name and lastname must contain maximum 40 characters!', "code" => 400);
                echo json_encode($response);
                //validación de que sea un email correcto
            } else if (!filter_var($datauser->email, FILTER_VALIDATE_EMAIL)) {
                $response = array("success" => false, 'response' => 'email format is invalid!', "code" => 400);
                echo json_encode($response);
                //validación para que solo sea posible ingresar cc o pas
            } else if ($datauser->type_id != "cc" && $datauser->type_id != "pas") {
                $response = array("success" => false, 'response' => 'only accepted cc or pas!', "code" => 400);
                echo json_encode($response);
                //validación para que la identificaciòn contenga números
            } else if (!preg_match("/^[0-9]*$/", $datauser->identification)) {
                $response = array("success" => false, 'response' => 'the document must be numeric!', "code" => 400);
                echo json_encode($response);
                //validación de cantidad de caracteres para la identificación no meno a 10
            } else if (strlen($datauser->identification) < 10) {
                $response = array("success" => false, 'response' => 'identification must contain manimum 10 characters!', "code" => 400);
                echo json_encode($response);
                //validación de cantidad de caracteres para el password no menor a 10 ni mayor a 16
            } else if (strlen($datauser->password) < 10 || strlen($datauser->password) > 16) {
                $response = array("success" => false, 'response' => 'password must contain manimum 10 characters and maximun 16 characters!', "code" => 400);
                echo json_encode($response);
            } else {
                $this->user_model->addUser($datauser);
                header('content-type: application/json');
                $response = array("success" => true, 'response' => 'User added successfully', "code" => 200);
                echo json_encode($response);
            }
        } else {
            header('content-type: application/json');
            $response = array("success" => false, 'response' => 'bad request', "code" => 400);
            echo json_encode($response);
        }
    }

    #endpoint /getuser - obtiene todas los usuarios
    public function getUser()
    {
        header("Access-Control-Allow_Origin: *");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') {
            $users = $this->user_model->getUser();
            header('content-type: application/json');
            $response = array("status" => true, 'users' => $users, "code" => 200);
            echo json_encode($response);
        } else {
            header('content-type: application/json');
            $response = array("status" => false, 'users' => [], "code" => 400);
            echo json_encode($response);
        }
    }

    public function getByUser()
    {
        header("Access-Control-Allow_Origin: *");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') {
            $users = $this->user_model->getUser();
            header('content-type: application/json');
            $response = array("status" => true, 'users' => $users, "code" => 200);
            echo json_encode($response);
        } else {
            header('content-type: application/json');
            $response = array("status" => false, 'users' => [], "code" => 400);
            echo json_encode($response);
        }
    }
}
    #################################################################
