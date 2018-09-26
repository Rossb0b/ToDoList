<?php 

require ('model.php');

$repLastProjects = getLastProjects();
$repThisProject = getThisProject();
$repListsThisProject = getListsThisProject();


require ('projectView.php');