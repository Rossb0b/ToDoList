<?php

require ('global.php');

// Function needed for index/indexView.php.



// Function shows every projects. 

function getAllProjects()
{	
	$db = connect();

	$req = $db->query('SELECT id, name, DATE_FORMAT(deadline, "%d/%m/%Y %Hh%imin%ss") as deadline_fr FROM Projects');
	
	return $req;
};


// Function shows only last 5 projects for header dropdown.

function getLastProjects()
{
	$db = connect();

	$req = $db->query('SELECT id, name FROM Projects ORDER BY id DESC LIMIT 5');
	$rep = $req->fetchAll();
	return $rep;
}


// Function to add project on DB.

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


// Function needed for project/projectView.php.



// Function to get THIS project via GET method.

function getThisProject()
{
	$db = connect();

	$req = $db->prepare('SELECT id, name, description, DATE_FORMAT(deadline, "%d/%m/%Y %Hh%imin%ss") as deadline_fr FROM Projects WHERE id =  ?');
	$req->execute(array($_GET['project']
	));
	$rep = $req->fetch();
	return $rep;
}


// Function shows lists linked to THIS project.

function getListsThisProject()
{
	$db = connect();

	$req = $db->prepare('SELECT id, name FROM ToDoLists WHERE project_id = ?');
	$req->execute(array($_GET['project']
	));
	$rep = $req->fetchAll();
	return $rep;
}

// Functions needed for tasks/tasksView.php.



// Function to get THIS list from GET method.

function getThisList()
{
	$db = connect();

	$req = $db->prepare('SELECT name FROM ToDoLists WHERE id = ?');
	$req->execute(array($_GET['list']
	));
	$rep = $req->fetchAll();
	return $rep;
}


// Function shows tasks linked to THIS list.

function getTasksThisList()
{
	$db = connect();

	$req = $db->prepare('SELECT * FROM Tasks WHERE list_id = ?')
	$req->execute(array($_GET['list']
	));
	$rep = $req->fetchAll();
	return $rep;
}