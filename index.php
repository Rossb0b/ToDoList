<?php

require('controller.php');

// We first check the existence of cookies or not.

if (isset($_COOKIE['id']) AND isset($_COOKIE['pseudo']) AND isset($_COOKIE['password']))
{
    cookies();
    listLastProjects();
}

// If there is no cookies or we get an action of the user.. :

elseif (isset($_GET['action'])) 
{
	if ($_GET['action'] == 'connection')
    {
        session_start();
        if (isset($_SESSION['isConnect']) AND $_SESSION['isConnect'] == true)
        {
            listProjects();
            listLastProjects();
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
            listLastProjects();
        }
        else
        {
            session_start();
            listProjects();
            listLastProjects();
        }
    }
    elseif ($_GET['action'] == 'project') 
    {
        if (isset($_GET['project_id']) && $_GET['project_id'] > 0) 
        {
            listThisProject();
            listLastProjects();
        }
        else 
        {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    elseif ($_GET['action'] == 'tasks' && $_GET['list'] > 0 && $_GET['Project'] > 0)
    {
    	tasksThisList();
        listLastProjects();
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
    session_start();
    connection();
}