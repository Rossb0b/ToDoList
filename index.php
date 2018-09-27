<?php

require('controller.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listProjects') {
        listProjects();
    }
    elseif ($_GET['action'] == 'project') {
        if (isset($_GET['project_id']) && $_GET['project_id'] > 0) {
            listThisProject();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    elseif ($_GET['action'] == 'tasks' && $_GET['list'] > 0 && $_GET['Project'] > 0){
    		tasksThisList();
    	}
}
else {
    listProjects();
}