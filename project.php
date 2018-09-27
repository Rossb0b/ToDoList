<?php 

require ('model.php');

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