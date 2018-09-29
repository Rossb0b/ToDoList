<?php

	$title = "Projet : " . $repThisProject['name'];
	$backLinkCheck = true; 
	$dropDownCheck = true;
	$backLink = "index.php?action=listProjects";
	require ('header.php');
?>

	<div class="main-title container-fluid mt-5 col-2 text-center mx-auto">
		<h1>
			<?= $repThisProject['name']; ?>
		</h1>
		<p>
			<h2> Description : </h2>
			<?= $repThisProject['description']; ?>
		</p>
		<p>
			<h2> Deadline : </h2>	
			<?= $repThisProject['deadline_fr']; ;?>
		</p>		
	</div>	

	<div class="container-fluid d-flex justify-content-center text-center flex-wrap">
		<div class="list mt-4">
			<h2> ToDo Lists : </h2>
		<?php
			foreach($repListsThisProject as $list)
			{
		?>
				<a href="index.php?action=tasks&amp;list=<?=$list['id'];?>&amp;Project=<?= $_GET['project_id'];?>"><?= $list['name']; ?></a>
				<br />
		<?php		
			}
		?>
		</div>		
	</div>	

	<div class="container-fluid col-6 mt-5">
		<form method="post" action="index.php?action=project&amp;project_id=<?=$_GET['project_id'];?>">
			<label for="listname">Indiquez le nom de votre liste.</label>
			<input type="text" name="listname">

			<input type="hidden" name="project" value="<?= $_GET['project_id']; ?>">

			<input type="submit" value="valider">
		</form>

		<form method="post" action="index.php?action=project&amp;project_id=<?=$_GET['project_id'];?>">
			<label for="delete">Indiquez la liste à supprimer.</label>
			<select name="delete">
				<?php 
					foreach($repListsThisProject as $list)
					{ 
				?>		
						<option name="id" value="<?= $list['id']; ?>"><?= $list['name']; ?></option>
				<?php	
					}
				?>
			</select>
			<input type="submit" name="deleteButton" value="Supprimer">
		</form>		

	</div>		

<?php
	require ('footer.php');
?>