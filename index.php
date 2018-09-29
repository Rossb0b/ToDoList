<?php

require('controller.php');
if (isset($_GET['action'])) 
{
	if ($_GET['action'] == 'connection')
    {
        session_start();
        if (isset($_SESSION['isConnect']) AND $_SESSION['isConnect'] == true)
        {
            listProjects();
        }
        else
        {
		  connection();
        }
	}
    elseif ($_GET['action'] == 'registration') 
    {
        register();
    }
    elseif ($_GET['action'] == 'listProjects') 
    {
        if (isset($_SESSION))
        {
            listProjects();
        }
        else
        {
            session_start();
            listProjects();
        }
    }
    elseif ($_GET['action'] == 'project') 
    {
        if (isset($_GET['project_id']) && $_GET['project_id'] > 0) 
        {
            listThisProject();
        }
        else 
        {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    elseif ($_GET['action'] == 'tasks' && $_GET['list'] > 0 && $_GET['Project'] > 0)
    {
    		tasksThisList();
    }
    elseif ($_GET['action'] == 'disconnect')
    {
        session_start();
        session_destroy();
        header('location:index.php?action=connection');
    }
}
else 
{
    connection();
}