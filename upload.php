<?php

 //Constants

define('ALLOWED_FORMAT', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
define('UPLOAD_DIR', './uploads/');
define('MAX_FILE_SIZE', 1000000);

//Variables

$extensionFile = '';
$uploadFile = '';
$originName = '';
$mime = '';
$size = 0;
$errors = '';

//Create the uploads directory

if(!is_dir(UPLOAD_DIR))
{
    mkdir(UPLOAD_DIR);
}

//Delete picture

if(isset($_GET['delete']) && $_GET['delete'] === 'true' && isset($_GET['file']) && !empty($_GET['file']))
{
    
    if(file_exists($_GET['file']))
    {
        unlink($_GET['file']);
        header('Location: /form.php');
    }
}

//Test the picture if the form is submited

if(isset($_FILES['picture']) && !empty($_FILES['picture']))
{
    foreach($_FILES['picture']['tmp_name'] as $index => $tmpName)
    {
        $originName = $_FILES['picture']['name'][$index];
        $mime = $_FILES['picture']['type'][$index];
        $size = $_FILES['picture']['size'][$index];
        if($size > MAX_FILE_SIZE) $errors .= '<span style="color:red">L\'image "'.$originName.'" est trop lourde !</span>';
        if(!in_array($mime, ALLOWED_FORMAT)) $errors .= '<span style="color:red">Le fichier "'. $originName .'" n\'est pas au bon format, merci de séléctionné un autre fichier(.jpeg, .png, .gif ou .webp).</span>';

        if($size < MAX_FILE_SIZE && in_array($mime, ALLOWED_FORMAT))
        {
            $extensionFile = implode(array_slice(explode('/', $mime), 1, 1));
            $uploadFile = UPLOAD_DIR . uniqid() . '.' . $extensionFile;
            move_uploaded_file($tmpName, $uploadFile);
        }
    }
}
