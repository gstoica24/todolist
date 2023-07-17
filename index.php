<?php
require_once("./controllers/Controller.php");



$uri = strtok($_SERVER['REQUEST_URI'], '?');
$ctrl = new Controlleur();
if ($uri == "/" || $uri == "/tasks") {
    $ctrl->index();
} elseif ($uri == "add-task") {
    $ctrl->createNewTask();
} elseif ($uri == "modif-task") {
    $ctrl->modifyTask();
} elseif ($uri == "delete-task") {
    $ctrl->removeTask();
} else {
    echo "non trouvé";
}
