<?php
	require ('header.php');
?>

	<div class="main-title container-fluid mt-5 col-2 text-center mx-auto">
		<h1>
			<?= $repThisList['name']; ?>
		</h1>	
	</div>

	<div class="container-fluid">
		<ul>
			<?php foreach ($repTasksThisList as $task)
				{
			?>		<div>
						<li><?= $task['name'] . " : " . $task['deadline_fr']; ?></li>
					</div>
			<?php		
				}
			?>
		</ul>
	</div>	

	<div class="container-fluid col-6">
		<form method="post" action="tasks.php?list=<?=$_GET['list'];?>">
			<label for="name">Indiquez le nom de la tâche.</label>
			<input type="text" name="name">

			<label for="end">Indiquez la date de fin du projet.</label>
			<input type="date" name="deadline" id="end">
			<br />

			<input type="hidden" name="list" value="<?= $_GET['list']; ?>">

			<input type="submit" value="valider">
		</form>	
	</div>	



<?php 
	require ('footer.php');
?>	