<?php
  if (!isset($_SESSION))
  {
    session_start();
  }
  $title = "Listes des projects";
  // We declare there will be a dropdown but no return link on this page.
  $backLinkCheck = false;
  $dropDownCheck = true;
  require ('header.php');
?>



  <div class="container-fluid col-6 mx-auto text-left mt-5">
      <h1>Gestion des projets</h1>

    <form method="post" action="index.php?action=listProjects">
    <div class="form-group">
      <label for="name">Indiquez le nom du projet : </label>
      <input class="form-control" type="text" name="name">
    </div>

    <div class="form-group">
      <label for="description">Indiquez la description du projet :</label>
      <input class="form-control" type="text" name="description">
    </div> 

    <div class="form-group">
      <label for="end">Indiquez la date de fin du projet.</label>
      <input class="form-control" type="date" name="deadline" id="end">
    </div>
    
      <input type="submit" value="valider">

    </form>  

    <form method="post" action="index.php?action=listProjects">
      <label for="delete">Indiquez le projet à supprimer.</label>
      <select name="delete">
        <?php
            foreach($repAll as $listProjects)
            {
        ?>
              <option name="id" value="<?= $listProjects['id']; ?>"><?= $listProjects['name']; ?></option>
        <?php            
            }
        ?>
      </select>
      <input type="submit" name="deleteButton" value="Supprimer">
    </form>          
  </div>  

  <div class="container-fluid d-flex justify-content-center  text-center flex-wrap">

    <?php 
      foreach($repAll as $listProjects)
      {
    ?>
        <div class="col-5 mx-auto mt-5" style="border:1px dotted grey">
          <a class="linkDecoration" href="index.php?action=project&amp;project_id=<?= $listProjects['id']; ?>">
            <h2 style="word-wrap:break-word;"><?= $listProjects['name']; ?></h2>
            <br />
            <p class="redUnderline">Deadline expiration : <?= $listProjects['deadline_fr']; ?></p>
          </a>
        </div>  
    <?php
      }
    ?>

  </div>  
<?php
  require ('footer.php');
?>  