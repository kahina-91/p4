<?php ob_start(); ?>
<p class="text-center text-success t4">Dérniers billets du blog </p>
 
<?php
while ($data = $allPosts->fetch())
{
?>
<div class="news">
    <h3>
        <?php echo htmlspecialchars($data['title']); ?>
        <em>le <?php echo $data['date_creation_fr']; ?></em>
    </h3>
    <button>
    	<a href="index.php?action=apdate&amp;id=<?= $data['id'] ?>">modifier</a>
    
    </button>
    <button>
        <a href="index.php?action=delete&amp;id=<?= $data['id'] ?>">supprimer</a>
    </button>
</div>
<?php
} // Fin de la boucle des billets
$allPosts->closeCursor();
?>
<br/>
<button>
	<a href="index.php?action=insertPost ">ajouter un article</a>
</button>
<?php include 'view/frontend/footer.php'; ?>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/template.php'; ?>