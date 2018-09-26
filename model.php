<?php

require ('global.php');

// Function needed for index/indexView.php.

function getAllProjects()
{	
	$db = connect();

	$req = $db->query('SELECT id, name, DATE_FORMAT(deadline, "%d/%m/%Y %Hh%imin%ss") as deadline_fr FROM Projects');
	
	return $req;
};

function getLastProjects()
{
	$db = connect();

	$req = $db->query('SELECT id, name FROM Projects ORDER BY id DESC LIMIT 5');
	$rep = $req->fetchAll();
	return $rep;
}

function addProject()
{
	$db = connect();

	$req = $db->prepare('INSERT INTO Projects(name, description, deadline) VALUES(:name, :description, :deadline)');
	$req->execute(array(
		'name' => $_POST['name'],
		'description' => $_POST['description'],
		'deadline' => $_POST['deadline']
	));
}


// Function needed for project/projectView.php

function getThisProject()
{
	$db = connect();

	$req = $db->prepare('SELECT id, name, description, DATE_FORMAT(deadline, "%d/%m/%Y %Hh%imin%ss") as deadline_fr FROM Projects WHERE id =  ?');
	$req->execute(array($_GET['project']
	));
	$rep = $req->fetch();
	return $rep;
}

function getListsThisProject()
{
	$db = connect();

	$req = $db->prepare('SELECT id, name FROM ToDoLists WHERE project_id = ?');
	$req->execute(array($_GET['project']
	));
	$rep = $req->fetchAll();
	return $rep;
}