<!DOCTYPE html>
 <html lang="fr">

    <head>
         <title>Ma TODO List</title>
         <meta charset="utf-8">
          <link rel="stylesheet" type="text/css" href="style.css">
     </head>   
 <body>

<h1> Bienvenue dans votre espace personnel</h1>

<h2> Ajout d'une tache</h2>
<section class="row bg-light">
     <div class="col-6">
     <form action="index.php?route=insert_tache" method="post">
             <div>
             <label> Intitulé de la tache </label>
             <input type='textarea' id='description' name='description' placeholder="Intitulé de la tache">
             </div>
             <div>
             <label> Date limite de la tache </label>
             <input type='date' id='date' name='date' placeholder="Date limite de la tache">
             </div>
             <div>
           <input type='submit' id='valider' value='Soumettre'>
           </div>
         </form>
     </div>
<br>


<a href="index.php?route=deconnect">Me deconnecter</a>

</body>