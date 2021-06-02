<?php
namespace Models;



use App\Customers;

class CustomerModel
{
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($customer)
    {
        $sql = "INSERT INTO `customers`(`name`,`email`,`address`) VALUE (:name ,:email,:address)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":name", $customer->name);
        $stmt->bindParam(":email", $customer->email);
        $stmt->bindParam(":address", $customer->address);

        return $stmt->execute();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM `customers`";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $customers = [];
        foreach ($result as $row) {
            $data["name"] = $row["name"];
            $data["email"] = $row["email"];
            $data["address"] = $row["address"];
            $customer = new Customers($data);
            $customer->id = $row['id'];
            $customers[] = $customer;
        }
        return $customers;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM customers WHERE id = :id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(":id", $id);
        return $statement->execute();
    }
}