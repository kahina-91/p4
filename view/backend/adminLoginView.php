
<?php $title = "Billets simple pour l'alaska"; ?>
<?php ob_start(); ?>
<?php include (VIEW.'frontend/menu.php'); ?>
<div class='admin'>
    <h3>Connection</h3>
    <p>Vous n'êtes pas connecté, veuillez taper le mot de passe</p>
    <form action="index.php?action=login" method="post" class="connectAdmin">
    <input type='text' name='username' placeholder="pseudo"/>
    <input type='password' placeholder="mot de passe" name='password'/>
    <input type="submit" class="text-center btn"/>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require (VIEW.'frontend/template.php'); ?>

 

 
