<?php
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
			foreach($repListsThisProject as $value)
			{
		?>
				<a href="tasks.php?list=<?=$value['id'];?>"><?= $value['name']; ?></a>
				<br />
		<?php		
			}
		?>
		</div>		

	</div>	

<?php
	require ('footer.php');
?>