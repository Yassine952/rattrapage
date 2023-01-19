<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Créez votre site esport en deux clics !" />
  
  <title>Rattrapage</title>
  
</head>

<body>
  
  <main class="home">

    <div class="title">
      <h1>Inscription</h1>
    </div>

    <section>
      <?php 
      foreach($configRegisterFormErrors as $registerError){
        echo $registerError;?><br><?php
      } ?>
      <?php
      $this->includeComponent("form", $registerForm);?>
    </section>

    <div class="title">
      <h2>Connexion</h2>
    </div>

    <section>
      <?php 
      foreach($configLoginFormErrors as $loginError){
        echo $loginError;?><br><?php
      } ?>
    <?php
      
      $this->includeComponent("form", $loginForm);?>
    </section>

    

    



  </main>

  
</body>

</html>