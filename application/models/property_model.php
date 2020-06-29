<?php
defined('BASEPATH') or exit('No direct script access allowed');

class property_model extends CI_Model
{
    public function addProperty($property)
    {
        $this->db->insert("propertys", $property);
    }

    public function listProperty()
    {
        $response = $this->db->query("SELECT * FROM propertys")->result();
        return $response;
    }

    public function getSortedProperties()
    {
        $response = $this->db->query("SELECT title,type,address,rooms,price,area FROM propertys ORDER BY price DESC")->result();
        return $response;
    }


    public function updateProperty($property)
    {
        $id = $property->id;
        $title = $property->title;
        $type = $property->type;
        $address = $property->address;
        $rooms = $property->rooms;
        $price = $property->price;
        $area = $property->area;
        $response = $this->db->query("UPDATE propertys SET title='${title}', type='${type}', address='${address}', rooms='${rooms}', price='${price}', area='${area}' WHERE id ={$id}");
        return $response;
    }

    public function deleteProperty($id)
    {
        $response = $this->db->query("DELETE FROM propertys WHERE id={$id->id}");
    }
}
