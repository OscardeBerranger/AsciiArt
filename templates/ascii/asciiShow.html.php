<form enctype="multipart/form-data" action="?type=ascii&action=change" method="post">
    <input type="text" name="nom" value="<?= $ascii->getNom() ?>">
    <input type="hidden" name = "id" value = "<?= $ascii->getId()?>">
    <input type="submit" value="Envoyer">
    <p><?= $ascii->getCode() ?></p>
</form>