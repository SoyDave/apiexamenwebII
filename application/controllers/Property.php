<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Property extends CI_Controller
{

	public function index()
	{
		echo "Index Property Controller";
	}

	#url base http://localhost/api/index.php/Property/

	###############################################################


	#endpoint /addproduct - agrega propiedades

	public function addProperty()

	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method === 'POST') {
			$jsonproperty = file_get_contents('php://input');
			$dataproperty = json_decode($jsonproperty);
			//Validacion de no campos vacios Property
			if ($dataproperty->title == "" || $dataproperty->type == "" || $dataproperty->address == "" || $dataproperty->rooms == "" || $dataproperty->price == "" || $dataproperty->area == "") {
				$response = array("success" => false, 'response' => 'all camps is required!', "code" => 400);
				echo json_encode($response);
				//validación el nombre de la propiedad solo debe contener letras
			} else if (!preg_match("/^[a-zA-Z ]*$/", $dataproperty->title)) {
				$response = array("success" => false, 'response' => 'the title must only contain letters!', "code" => 400);
				echo json_encode($response);
				//validación de que solo ingrese tipo de habitación permitido
			} else if ($dataproperty->type != "house" && $dataproperty->type != "room" && $dataproperty->type != "hotel") {
				$response = array("success" => false, 'response' => 'only accepted house or room or hotel!', "code" => 400);
				echo json_encode($response);
				//validación para que la cantidad de cuartos sea numerico
			} else if (!preg_match("/^[0-9]*$/", $dataproperty->rooms)) {
				$response = array("success" => false, 'response' => 'enter the number of rooms in numbers!', "code" => 400);
				echo json_encode($response);
				//validación para que la cantidad de precio sea numerico
			} else if (!preg_match("/^[0-9]*$/", $dataproperty->price)) {
				$response = array("success" => false, 'response' => 'enter the price in numbers!', "code" => 400);
				echo json_encode($response);
				//el area sea numerica
			} else if (!preg_match("/^[0-9]*$/", $dataproperty->area)) {
				$response = array("success" => false, 'response' => 'enter the area in numbers!', "code" => 400);
				echo json_encode($response);
			} else {
				$this->property_model->addProperty($dataproperty);
				http_response_code(200);
				header('content-type: application/json');
				$response = array("success" => true, 'response' => 'Property addesd successfully!', "code" => 200);
				echo json_encode($response);
			}
		} else {
			header('content-type: application/json');
			$response = array("success" => false, 'response' => 'bad request', "code" => 400);
			echo json_encode($response);
		}
	}

	#endpoint /listpropierties - obtiene todas las propiedades
	public function listProperty()
	{
		header("Access-Control-Allow_Origin: *");
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method === 'GET') {
			$propertys = $this->property_model->listProperty();
			header('content-type: application/json');
			$response = array("success" => true, 'propertys' => $propertys, "code" => 200);
			echo json_encode($response);
		} else {
			header('content-type: application/json');
			$response = array("success" => false, 'propertys' => [], "code" => 400);
			echo json_encode($response);
		}
	}

	#endpoint /getSortedProperties - obtiene todas las propiedades ordenadas por precio
	public function getSortedProperties()
	{
		header("Access-Control-Allow_Origin: *");
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method === 'GET') {
			$propertys = $this->property_model->getSortedProperties();
			header('content-type: application/json');
			$response = array("success" => true, 'propertys' => $propertys, "code" => 200);
			echo json_encode($response);
		} else {
			header('content-type: application/json');
			$response = array("success" => false, 'propertys' => [], "code" => 400);
			echo json_encode($response);
		}
	}

	#endpoint /updateproduct - actualiza una propiedad
	public function updateProperty()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method === 'PUT') {
			$jsonproperty = file_get_contents('php://input');
			$dataproperty = json_decode($jsonproperty);
			//Validacion de no campos vacios Property
			if ($dataproperty->title == "" | $dataproperty->type == "" | $dataproperty->address == "" | $dataproperty->rooms == "" | $dataproperty->price == "" | $dataproperty->area == "") {
				$response = array("success" => false, 'response' => 'all camps is required!', "code" => 400);
				echo json_encode($response);
				//validación el nombre de la propiedad solo debe contener letras
			} else if (!preg_match("/^[a-zA-Z ]*$/", $dataproperty->title)) {
				$response = array("success" => false, 'response' => 'the title must only contain letters!', "code" => 400);
				echo json_encode($response);
				//validación de que solo ingrese tipo de habitación permitido
			} else if ($dataproperty->type != "house" && $dataproperty->type != "room" && $dataproperty->type != "hotel") {
				$response = array("success" => false, 'response' => 'only accepted house or room or hotel!', "code" => 400);
				echo json_encode($response);
				//validación para que la cantidad de cuartos sea numerico
			} else if (!preg_match("/^[0-9]*$/", $dataproperty->rooms)) {
				$response = array("success" => false, 'response' => 'enter the number of rooms in numbers!', "code" => 400);
				echo json_encode($response);
				//validación para que la cantidad de cuartos sea numerico
			} else if (!preg_match("/^[0-9]*$/", $dataproperty->price)) {
				$response = array("success" => false, 'response' => 'enter the price in numbers!', "code" => 400);
				echo json_encode($response);
			} else if (!preg_match("/^[0-9]*$/", $dataproperty->area)) {
				$response = array("success" => false, 'response' => 'enter the area in numbers!', "code" => 400);
				echo json_encode($response);
			} else {
				$this->property_model->updateProperty($dataproperty);
				header('content-type: application/json');
				$response = array("success" => true, 'response' => 'Property update successfully!', "code" => 200);
				echo json_encode($response);
			}
		} else {
			header('content-type: application/json');
			$response = array("success" => false, 'response' => 'bad request', "code" => 400);
			echo json_encode($response);
		}
	}

	#endpoint /deleteproduct - elimina una propiedad
	public function deleteProperty()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method === 'DELETE') {
			$jsonproperty = file_get_contents('php://input');
			$dataproperty = json_decode($jsonproperty);
			$this->property_model->deleteProperty($dataproperty);
			header('content-type: application/json');
			$response = array("success" => true, 'response' => 'Property successfully removed!', "code" => 200);
			echo json_encode($response);
		} else {
			header('content-type: application/json');
			$response = array("success" => false, 'response' => 'bad request', "code" => 400);
			echo json_encode($response);
		}
	}

	################################################################	
}
