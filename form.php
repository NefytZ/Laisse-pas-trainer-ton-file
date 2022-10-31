<?php require 'upload.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Laisse pas traîner ton file</title>
</head>

<body>
    <h1>Import image</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="picture">Sélectionne les images à upload</label>
        <input type="file" name="picture[]" id="picture" multiple="multiple" />
        <?= $errors ?>
        <button>Go</button>
    </form>
    <section class="List">
        <strong>Liste des images déja upload:</strong>
    <ul>
        <?php
        $picture = new FilesystemIterator(UPLOAD_DIR);
        if (!empty($picture->getFilename())) {
            foreach ($picture as $file) { ?>
                <li>
                    <figure>
                        <img src="<?= UPLOAD_DIR . $picture->getFilename() ?>" alt="<?= $picture->getFilename() ?>">
                        <figcaption><?= $picture->getFilename() ?></figcaption>
                        <a href="?delete=true&file=<?= $picture->getFileInfo() ?>">Delete</a>
                    </figure>
                </li>
            <?php }
        } else { ?>
            <h2>No image here</h2>
        <?php } ?>
    </ul>
</body>

</html>