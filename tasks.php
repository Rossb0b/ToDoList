<?php

require ('model.php');

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

?>