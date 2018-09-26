<?php
  require ('header.php');
?>


  <div class="container-fluid d-flex justify-content-center  text-center flex-wrap">

    <?php 
      foreach($repAll as $listProjects)
      {
    ?>
        <div class="col-5 mx-auto mt-5" style="border:1px dotted grey">
          <a class="linkDecoration" href="project.php?project=<?= $listProjects['id']; ?>">
            <h2><?= $listProjects['name']; ?></h2>
            <br />
            <p class="redUnderline">Deadline expiration : <?= $listProjects['deadline_fr']; ?></p>
          </a>
        </div>  
    <?php
      }
    ?>

  </div>  

  <div class="container-fluid col-6 mx-auto text-left mt-5">

    <form method="post" action="index.php">
      <label for="name">Indiquez le nom du projet : </label>
      <input type="text" name="name">
     
      <label for="description">Indiquez la description du projet :</label>
      <input type="text" name="description">

      <label for="end">Indiquez la date de fin du projet.</label>
      <input type="date" name="deadline" id="end">
<br />
      <input type="submit" value="valider">

    </form>  

  </div>  

<?php
  require ('footer.php');
?>  