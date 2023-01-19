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

<main>

    <section>
        
        <table class="table">

            <thead>
                <th>ID</th>
                <th>FIRSTNAME</th>
                <th>LASTNAME</th>
                <th>BIRTHDAY</th>
                <th>EMAIL</th>
            </thead>
            <tbody>
                
                <?php foreach ($users as $user) : ?>
                    <tr>
                    <td><?php echo $user["id"];?></td>
                    <td><?php echo $user["firstname"];?></td>
                    <td><?php echo $user["lastname"];?></td>
                    <td><?php echo $user["birthday"];?></td>
                    <td><?php echo $user["email"];?></td>
                    <?php if($decodedJWT["payload"][0] != $user["id"]){ ?>
                        <td><a href="/user?modify=<?php echo $user['id']?>">Modifier</a></td>
                        <td><a href="/user/delete?del=<?php echo $user['id']?>">Supprimer</a></td>
                    <?php } ?>
                    </tr>
                <?php endforeach ;?>
               
            </tbody>
        
        </form>
    </section>
    <?php if($update==true){?>
    <?php 
      foreach($configUpdateFormErrors as $updateError){
        echo $updateError;?><br><?php
      } 
    $this->includeComponent("form", $updateForm);?>
    
    
    
    
        <?php }?>

    </table>

    <a href="/logout">LOG OUT</a>

</main> 



</body>



</html>