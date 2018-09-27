<?php

require ('model.php');

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