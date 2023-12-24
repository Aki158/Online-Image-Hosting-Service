<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;

return [
    ''=>function(): HTTPRenderer{
        $ImageStatus = ValidationHelper::string($_GET['ImageStatus']??'');

        return new HTMLRenderer('newImage', ['ImageStatus'=>$ImageStatus]);
    },
    'newImage'=>function(): HTTPRenderer{
        $ImageStatus = ValidationHelper::string($_GET['ImageStatus']??'');

        return new HTMLRenderer('newImage', ['ImageStatus'=>$ImageStatus]);
    },
    'publicImages'=>function(): HTTPRenderer{
        $ImagesList = DatabaseHelper::getImagesListInfo();

        return new HTMLRenderer('publicImages', ['ImagesList'=>$ImagesList]);
    },
    'postImage'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/image/');
        $path = ValidationHelper::string($path);
        $postimage = DatabaseHelper::getImage($path);

        return new HTMLRenderer('postImage', ['postImage'=>$postimage]);
    },
    'deleteImage'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/image/');
        $path = ValidationHelper::string($path);
        $deleteImage = DatabaseHelper::getImage($path);

        return new HTMLRenderer('deleteImage', ['deleteImage'=>$deleteImage]);
    },
    'notExistImage'=>function(): HTTPRenderer{
        return new HTMLRenderer('notExistImage', ['notExistImage'=>'Not Exist Image']);
    },
    'api'=>function(): HTTPRenderer{
        $ImageStatus = ValidationHelper::string($_GET['ImageStatus']??'');

        return new JSONRenderer(['ImageStatus'=>$ImageStatus]);
    },
    'api/newImage'=>function(): HTTPRenderer{
        $ImageStatus = ValidationHelper::string($_GET['ImageStatus']??'');

        return new JSONRenderer(['ImageStatus'=>$ImageStatus]);
    },
    'api/publicImages'=>function(){
        DatabaseHelper::checkImagesExpiration();
        $ImagesList = DatabaseHelper::getImagesListInfo();

        return new JSONRenderer(['ImagesList'=>$ImagesList]);
    },
    'api/postImage'=>function(){
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/image/');
        $path = ValidationHelper::string($path);        
        $postImage = DatabaseHelper::getImage($path);

        return new JSONRenderer(['postImage'=>$postImage]);
    },
    'api/deleteImage'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/image/');
        $path = ValidationHelper::string($path);
        $deleteImage = DatabaseHelper::getImage($path);

        return new JSONRenderer(['deleteImage'=>$deleteImage]);
    },
    'api/notExistImage'=>function(): HTTPRenderer{
        return new JSONRenderer(['notExistImage'=>'Not Exist Image']);
    }
];