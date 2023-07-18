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
        $task = $_POST['title'];
        if (isset($_POST['completed'])) {
            $completed = 1;
        } else {
            $completed = 0;
        }
        $this->model->addTask($task, $completed);
        $todos = $this->model->getAll();
        echo $this->twig->render('index.html.twig', ['todos' => $todos]);
    }

    public function modifyTask()
    {
        $id = $_POST['id'];
        $task = $_POST['title'];
        if (isset($_POST['completed'])) {
            $completed = 1;
        } else {
            $completed = 0;
        }
        $this->model->updateTask($id, $task, $completed);
        $todos = $this->model->getAll();
        echo $this->twig->render('index.html.twig', ['todos' => $todos]);
    }

    public function removeTask()
    {
        $id = $_POST['id'];
        $this->model->deleteTask($id);
        $todos = $this->model->getAll();
        echo $this->twig->render('index.html.twig', ['todos' => $todos]);
    }
}
