<?php
  try 
  {
    $db = new PDO('mysql:host=localhost;dbname=ToDoList', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch (exception $e)
  {
      die('erreur : ' . $e->getMessage());
  }

if (isset($_SESSION['id']))
{
  $req = $db->prepare('SELECT * FROM Projects WHERE member_id = "' . $_SESSION['id'] . '" LIMIT 5');
  $req->execute();
  $repLastProjects = $req->fetchAll();
}
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= $title ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="shortcut icon" href="img/favicon.ico">
  <!-- Place favicon.ico in the root directory -->

  <!-- Bootstrap 4.0 stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


  <!-- Personnal stylesheet -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?action=connection">Home <span class="sr-only">(current)</span></a>
          </li>
          
          <!-- Only appears on views with $_SESSION['isConnect'] == true -->
          <?php
            if ($_SESSION['isConnect'] == true)
            {
          ?>    
          <!-- Disconnect Link -->
          <li class="nav-item" style="position:absolute; top:6px; right:5px;">
            <a class="nav-link" href="index.php?action=disconnect">
              Se déconnecter
            </a>
          </li>
          <?php
            }
          ?>

          <!-- Only appears on views with $dropDownCheck == true -->
          <?php 
            if ($dropDownCheck == true)
            {
          ?>    
          <!-- Dropdown link with 5 last projects of user -->
              <li class="nav-item dropdown align-right">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Last Projects
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <?php
                    foreach($repLastProjects as $listProject)
                    {
                  ?>
                      <a class="dropdown-item" href="index.php?action=project&amp;project_id=<?= $listProject['id']; ?>"><?= $listProject['name']; ?></a>
                  <?php        
                    } 
                  ?>
                </div>
              </li>
          <?php    
            }
          ?>  

          <!-- Only appears on views with $backLinkCheck == true -->
          <?php
            if ($backLinkCheck == true)
            {
          ?>    
              <li class="nav-item active">
                <a class="nav-link" href="<?= $backLink; ?>">Retour<span class="sr-only">(current)</span></a>
              </li>
          <?php  
            }
          ?>  
        </ul>
      </div>
    </nav>
  </header>  
