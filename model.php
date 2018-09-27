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


function checkAddProject()
{
	$db = connect();

	$req = $db->query('SELECT name FROM Projects WHERE name = "' . $_POST['name'] . '"');
	$countname = $req->rowCount();

	return $countname;
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

function addListsThisProject()
{
	$db = connect();

	$req = $db->prepare('INSERT INTO ToDoLists(name, project_id) VALUES(:name, :project_id)');
	$req->execute(array(
		'name' => $_POST['listname'],
		'project_id' => $_POST['project']
	));
}

function checkAddLists()
{
	$db = connect();

	$req = $db->query('SELECT name FROM ToDoLists WHERE project_id = "' . $_POST['project'] . '" AND name = "' . $_POST['listname'] . '"');
	$countname = $req->rowCount();

	return $countname;
}










// Functions needed for tasks/tasksView.php.


// Function to get THIS list from GET method.

function getThisList()
{
	$db = connect();

	$req = $db->prepare('SELECT name FROM ToDoLists WHERE id = ?');
	$req->execute(array($_GET['list']
	));
	$rep = $req->fetch();
	return $rep;
}


// Function shows tasks linked to THIS list.

function getTasksThisList()
{
	$db = connect();

	$req = $db->prepare('SELECT id, name, status, DATE_FORMAT(deadline, "%d/%m/%Y %Hh%imin%ss") as deadline_fr FROM Tasks WHERE list_id = ?');
	$req->execute(array($_GET['list']
	));
	$rep = $req->fetchAll();
	return $rep;
}


// Function adding Tasks to THIS list.

function addTasksThisList()
{
	$db = connect();

	$req = $db->prepare('INSERT INTO Tasks(name, deadline, list_id) VALUES(:name, :deadline, :list_id)');
	$req->execute(array(
		'name' => $_POST['name'],
		'deadline' => $_POST['deadline'],
		'list_id' => $_POST['list']
	));
}


// Function check TaskName.

function checkAddTasks()
{
	$db = connect();

	$req = $db->query('SELECT name FROM Tasks WHERE list_id = "' . $_POST['list'] . '" AND name = "' . $_POST['name'] . '"');
	$countname = $req->rowCount();

	return $countname;
}

// Function update Status.

function updateStatus()
{
	$db = connect();

	$req = $db->prepare('UPDATE Tasks SET status = :status WHERE id = :id');
	$req->execute(array(
		'status' => $_POST['status'],
		'id' => $_POST['id']
	));
}