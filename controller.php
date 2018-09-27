<?php 

require ('model.php');

// Function that makes projectsView.php functionnal.

function listProjects()
{
	$reqAllProjects = getAllProjects();
	$repAll = $reqAllProjects->fetchAll();

	$repLastProjects = getLastProjects();


	require ('projectsView.php');

	if (isset($_POST['name']) AND isset($_POST['description']) AND isset($_POST['deadline']))
	{
		$repCheckedProject = checkAddProject();
		if ($repCheckedProject < 1)
		{
			$addProject = addProject();
		}
		else
		{
			echo "<p class='text-center'>Vous avez déjà un projet avec ce nom.</p>";
		}
	}


	if (isset($_POST['deleteButton']))
	{
		$deleteProject = deleteProject();
	}	
}


// Function that makes projectView.php functionnal.

function listThisProject()
{
	$repLastProjects = getLastProjects();
	$repThisProject = getThisProject();
	$repListsThisProject = getListsThisProject();


	require ('projectView.php');

	if (isset($_POST['listname']))
	{
		$repCheckedLists = checkAddLists();
		if ($repCheckedLists < 1)
		{
			$addList = addListsThisProject();
		}
		else 
		{
			echo "<p class='text-center'>Vous avez déjà une tâche portant ce nom.</p>";
		}
	}

	if (isset($_POST['deleteButton']))
	{
		$deleteList = deleteList();
	}
}


// Function that makes tasksView.php functionnal.

function tasksThisList()
{
	$repLastProjects = getLastProjects();
	$repThisList = getThisList();
	$repTasksThisList = getTasksThisList();

	require ('tasksView.php');

	if (isset($_POST['name']) and isset($_POST['deadline']))
	{
		$repCheckedTasks = checkAddTasks();
		if ($repCheckedTasks < 1)
		{
			$addTasks = addTasksThisList();
		}
		else 
		{
			echo "<p class='text-center'>Vous avez déjà une tâche portant ce nom.</p>";
		}
	}

	if (isset($_POST['switchStatus']))
	{
		$updateStatus = updateStatus();
	}

	if (isset($_POST['delete']))
	{
		$deleteTask = deleteTask();
	}	
}