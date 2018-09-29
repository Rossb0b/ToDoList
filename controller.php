<?php 

require ('model.php');

// Function that makes projectsView.php functionnal.

function connection()
{
	$repIdentification = identification();
	if (!isset($_POST['identifiant']) AND !isset($_POST['password-check']))
	{
		require ('connectionView.php');
	}
	elseif (isset($_POST['identifiant']) AND isset($_POST['password-check']))
	{
		foreach($repIdentification as $val)
		{
			$checkedPassword = password_verify($_POST['password-check'], $val['pass']);
			if ($val['pseudo'] == $_POST['identifiant'])
			{
				if ($checkedPassword)
				{

					$_SESSION['id'] = $val['id'];
					$_SESSION['pseudo'] = $val['pseudo'];
					$_SESSION['isConnect'] = true;
					if (isset($_POST["auto_connection"]))
					{
						setcookie('id', '$val["id"]', time() + 365*24*3600, null, null, false, true);
						setcookie('password', '$val["pass"]', time() + 365*24*3600, null, null, false, true);
						listProjects();
						break;
					}
					else 
					{
						listProjects();
						break;
					}
				}
				else 
				{
					require ('connectionView.php');
					echo "Mauvais identifiant ou mot de passe2.";
					break;
				}
			}
		}
	}
}

function register()
{
	if (!isset($_POST['pseudo']) AND !isset($_POST['password']) AND !isset($_POST['password_verification']) AND !isset($_POST['email']))
	{
		require ('registration.php');
	}
	
	if (isset($_POST['pseudo']) AND isset($_POST['password']) AND isset($_POST['email']) AND isset($_POST['password_verification']))
	{
	$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
	$_POST['password'] = htmlspecialchars($_POST['password']);
	$_POST['email'] = htmlspecialchars($_POST['email']);
	$_POST['password_verification'] = htmlspecialchars($_POST['password_verification']);
	$req = checkRegistration();


	// We check if pseudo isn't use, and if every inputs correspond to requested enter.

		if ($req < 1 AND preg_match("#^[a-zA-Z0-9._-]{3,10}$#", $_POST['pseudo']) AND preg_match("#[a-zA-Z0-9@._-]{5,}#", $_POST['password']) AND preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) AND $_POST['password'] == $_POST['password_verification']) 
		{
			echo "Bienvenu " . $_POST['pseudo'] . " votre enregistration a bien été prise en compte.";

			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$rep = registration();

			connection();
		}	
		else 
		{
			echo "Bonjour, vous n'avez apparemment pas répondu aux critères dégagés par notre site afin de vous enregistrer, voici la liste des erreurs : <br />"; 
			
			if (!preg_match("#^[a-zA-Z0-9._-]{3,10}$#", $_POST['pseudo']))
			{
				echo "Votre pseudo ne correspond pas aux critères, veillez à bien les respecter.<br />";
			}
			else if (!preg_match("#[a-zA-Z0-9@._-]{5,}#", $_POST['password']))
			{
				echo "Votre mot de passe ne correspond pas aux critères, veillez à bien les respecter. <br />";
			}
			else if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
			{
				echo "Votre e-mail n'est pas valide.<br />";
			}
			else if (!$_POST['password'] == $_POST['password_verification'])
			{
				echo "Les mots de passes choisie ne match pas.<br />";
			}
			else if ($req > 0)
			{
				echo "Votre pseudonyme est déjà utilisé<br />";
			}	
		}		
	}
}


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
	session_start();
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
	session_start();
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