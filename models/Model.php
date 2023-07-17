<?php

class Model
{
    private string $host = "localhost";
    private string $dbname = "todolist";
    private string $username = "root";
    private string $password = "";
    private PDO $db;


    public function __construct()
    {
        // echo "Construct: connect to db $this->dbname\n";
        $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
    }

    public function getAll()
    {
        try {
            // Une requête pour afficher tous le task
            $sql = "SELECT * FROM todos WHERE  1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $todos =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $todos;
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function addTask($task, $completed)
    {
        try {
            // Une requête pour ajoute un task
            $sql = "INSERT INTO `todos`( `title`, `completed`) VALUES (:task,:completed)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":task", $task);
            $stmt->bindParam(":completed", $completed);
            $stmt->execute();
            $newtask = $stmt->fetch(PDO::FETCH_ASSOC);
            return $newtask;
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function updateTask($id, $title, $completed)
    {
        try {
            // Une requête pour actualize un task
            $sql = "UPDATE `todos` SET `title`=:title,`completed`=:completed WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":completed", $completed);
            $stmt->execute();
            $uptadeTask = $stmt->fetch(PDO::FETCH_ASSOC);
            return $uptadeTask;
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function deleteTask($id)
    {
        try {
            // Une requête pour efface un task
            $sql = "DELETE FROM `todos` WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }
}
