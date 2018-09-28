<?php
	$title = "Liste : " . $repThisList['name'];
	$backLinkCheck = true;
	$backLink = "index.php?action=project&amp;project_id=" . $_GET['Project'];
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
						<li class="<?php if($task['status'] == '1'){
							echo 'done';
						} ?>"><?= $task['name'] . " : " . $task['deadline_fr']; ?>
						</li>
							<br />
							<form method="post" action="index.php?action=tasks&amp;list=<?=$_GET['list'];?>&amp;Project=<?=$_GET['Project'];?>">
								<input type="hidden" name="id" value="<?= $task['id'] ?>">
								<select name="status">
									<option value="0">ToDo</option>
									<option value="1">Done</option>
								</select>
								<input type="submit" name="switchStatus" value="Valider">
							</form>
							<form method="post" action="index.php?action=tasks&amp;list=<?=$_GET['list'];?>&amp;Project=<?=$_GET['Project'];?>">
								<input type="hidden" name="id" value="<?= $task['id'] ?>">
								<button type="submit" name="delete"><i class="fas fa-trash-alt"></i></button>
							</form>
					</div>
			<?php		
				}
			?>
		</ul>
	</div>	

	<div class="container-fluid col-6">
		<form method="post" action="index.php?action=tasks&amp;list=<?=$_GET['list'];?>&amp;Project=<?=$_GET['Project'];?>">
			<input type="hidden" name="status" value="0">
			<label for="name">Indiquez le nom de la tâche.</label>
			<input type="text" name="name">

			<label for="end">Indiquez la date de fin de la tâche.</label>
			<input type="date" name="deadline" id="end">
			<br />

			<input type="hidden" name="list" value="<?= $_GET['list']; ?>">

			<input type="submit" value="valider">
		</form>	
	</div>	



<?php 
	require ('footer.php');
?>	