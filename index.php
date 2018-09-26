<?php

require ('model.php');

$reqAllProjects = getAllProjects();
$repAll = $reqAllProjects->fetchAll();

$repLastProjects = getLastProjects();

if (isset($_POST['name']) AND isset($_POST['description']) AND isset($_POST['deadline']))
{
	$addProject = addProject();
}

require ('projectsView.php');

?>