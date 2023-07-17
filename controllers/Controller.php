<?php

require_once("./models/Model.php");
require_once './vendor/autoload.php';

class Controlleur
{
    private $model;
    private $twig;

    public function __construct()
    {
        $this->model = new Model;
        $loader = new \Twig\Loader\FilesystemLoader('templates/');
        $this->twig = new \Twig\Environment($loader);
    }


    public function index()
    {
        $todos = $this->model->getAll();
        echo $this->twig->render('index.html.twig', ['todos' => $todos]);
    }

    public function createNewTask()
    {
        if (isset($_POST['title'], $_POST['completed']) && !empty(trim($_POST['title'])) && !empty(trim($_POST['completed']))) {
            $task = $_POST['title'];
            $completed = $_POST['completed'];
            $todos =   $this->model->addTask($task, $completed);
            echo $this->twig->render('index.html.twig', ['todos' => $todos]);
        }
    }

    public function modifyTask()
    {
        if (isset($_POST['id'], $_POST['title'], $_POST['completed']) && !empty(trim($_POST['title'])) && !empty(trim($_POST['completed']))) {
            $id = $_POST['title'];
            $title = $_POST['title'];
            $completed = $_POST['completed'];
            $todos = $this->model->updateTask($id, $title, $completed);
            echo $this->twig->render('index.html.twig', ['todos' => $todos]);
        }
    }

    public function removeTask()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $todos = $this->model->deleteTask($id);
            echo $this->twig->render('index.html.twig', ['todos' => $todos]);
        }
    }
}
