<?php

require ('global.php');

// !----------------------------------------------------------! 		
// 				Function needed for memberArea
// !----------------------------------------------------------!


function identification()
{	
	$db = connect();

	$req = $db->query('SELECT * FROM member');
	$rep = $req->fetchAll();
	return $rep;
};

function registration()
{
	$db = connect();

	$req = $db->prepare('INSERT INTO member(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
	$req->execute(array(
		'pseudo' => $_POST['pseudo'],
		'pass' => $_POST['password'],
		'email' => $_POST['email']
				));

	return $req;
};

function checkRegistration()
{
	$db = connect();

	$req = $db->query('SELECT pseudo FROM member WHERE pseudo = "'.$_POST['pseudo'].'"');
	$countpseudo = $req->rowCount();

	return $countpseudo;
}











// !----------------------------------------------------------! 			
//			Function needed for index/indexView.php.
// !----------------------------------------------------------!


// Function shows every projects. 

function getAllProjects()
{	
	$db = connect();

	$req = $db->query('SELECT id, name, DATE_FORMAT(deadline, "%d/%m/%Y %Hh%imin%ss") as deadline_fr FROM Projects WHERE member_id = "' . $_SESSION['id'] . '"');
	
	return $req;
};


// Function shows only last 5 projects for header dropdown.

function getLastProjects()
{
	$db = connect();

	if (isset($_SESSION['id']))
	{
		$req = $db->prepare('SELECT * FROM Projects WHERE member_id = "' . $_SESSION['id'] . '" LIMIT 5');
		$req->execute();
		$repLastProjects = $req->fetchAll();
	}
}


// Function to add project on DB.

function addProject()
{
	$db = connect();

	$req = $db->prepare('INSERT INTO Projects(name, description, deadline, member_id) VALUES(:name, :description, :deadline, :member_id)');
	$req->execute(array(
		'name' => $_POST['name'],
		'description' => $_POST['description'],
		'deadline' => $_POST['deadline'],
		'member_id' => $_SESSION['id'],
	));
}


function checkAddProject()
{
	$db = connect();

	$req = $db->prepare('SELECT name FROM Projects WHERE name = "' . $_POST['name'] . '" AND member_id = "' . $_SESSION['id'] . '"');
	$countname = $req->rowCount();

	return $countname;
}

// Function delete list

function deleteProject()
{
	$db = connect();

	$req = $db->prepare('DELETE FROM Projects WHERE id = "' . $_POST['delete'] . '"');
	$rep = $req->execute();	
}









// !----------------------------------------------------------! 			
// 			Function needed for projects/projectsView.php
// !----------------------------------------------------------!


// Function to get THIS project via GET method.

function getThisProject()
{
	$db = connect();

	$req = $db->prepare('SELECT id, name, description, DATE_FORMAT(deadline, "%d/%m/%Y %Hh%imin%ss") as deadline_fr FROM Projects WHERE id =  ?');
	$req->execute(array($_GET['project_id']
	));
	$rep = $req->fetch();
	return $rep;
}


// Function shows lists linked to THIS project.

function getListsThisProject()
{
	$db = connect();

	$req = $db->prepare('SELECT ToDoLists.id, ToDoLists.name, GROUP_CONCAT(Tasks.name) as tasks_name FROM ToDoLists LEFT JOIN Tasks ON ToDoLists.id = Tasks.list_id WHERE project_id = ? GROUP BY ToDoLists.id');
	$req->execute(array($_GET['project_id']
	));
	$rep = $req->fetchAll();
	return $rep;
}

// function getListThisProjectPlusTasksThisList()
// {
// 	$db = connect();

// 	$req = $db->query('SELECT ToDoLists.id, GROUP_CONCAT(Tasks.name ORDER BY deadline) AS name FROM ToDoLists LEFT JOIN Tasks ON ToDoLists.id = Tasks.list_id GROUP BY ToDoLists.id');
// 	$rep = $req->fetchAll();
// 	return $rep;
// }



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

// Function delete list

function deleteList()
{
	$db = connect();

	$req = $db->prepare('DELETE FROM ToDoLists WHERE id = "' . $_POST['delete'] . '"');
	$rep = $req->execute();	
}









// !----------------------------------------------------------! 			
//			Function needed for tasks/tasksView.php.
// !----------------------------------------------------------!


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

	$req = $db->prepare('INSERT INTO Tasks(name, deadline, list_id, status) VALUES(:name, :deadline, :list_id, :status)');
	$req->execute(array(
		'name' => $_POST['name'],
		'deadline' => $_POST['deadline'],
		'list_id' => $_POST['list'],
		'status' => $_POST['status']
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

// Function update Status of THIS task.

function updateStatus()
{
	$db = connect();

	$req = $db->prepare('UPDATE Tasks SET status = :status WHERE id = :id');
	$req->execute(array(
		'status' => $_POST['status'],
		'id' => $_POST['id']
	));
}

// Function delete task

function deleteTask()
{
	$db = connect();

	$req = $db->prepare('DELETE FROM Tasks WHERE id = "' . $_POST['id'] . '"');
	$rep = $req->execute();
}