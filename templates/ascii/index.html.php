<?php foreach ($ascii as $dessin): ?>

    <div class="post mt-3">
        <h3><?= $dessin->getNom() ?></h3>
        <p><?= $dessin->getCode() ?></p>
        <a href="index.html.php?type=post&action=show&id=<?= $dessin->getId() ?>" class="btn btn-success">Lire</a>
    </div>

<?php endforeach;?>
