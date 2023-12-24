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
    'publicImages'=>function(): HTTPRenderer{
        $ImagesList = DatabaseHelper::getImagesListInfo();

        return new HTMLRenderer('publicImages', ['ImagesList'=>$ImagesList]);
    },
    'image/jpeg'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = ValidationHelper::string($path);
        $url_type = ValidationHelper::urlType($path);
        $image = DatabaseHelper::getImage($url_type, $path);
        
        if($url_type === "post_url"){
            DatabaseHelper::updateImage($image["id"]);
            return new HTMLRenderer('postImage', ['image'=>$image]);
        }
        return new HTMLRenderer('deleteImage', ['image'=>$image]);
    },
    'image/png'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = ValidationHelper::string($path);
        $url_type = ValidationHelper::urlType($path);
        $image = DatabaseHelper::getImage($url_type, $path);
        
        if($url_type === "post_url"){
            DatabaseHelper::updateImage($image["id"]);
            return new HTMLRenderer('postImage', ['image'=>$image]);
        }
        return new HTMLRenderer('deleteImage', ['image'=>$image]);
    },
    'image/gif'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = ValidationHelper::string($path);
        $url_type = ValidationHelper::urlType($path);
        $image = DatabaseHelper::getImage($url_type, $path);
        
        if($url_type === "post_url"){
            DatabaseHelper::updateImage($image["id"]);
            return new HTMLRenderer('postImage', ['image'=>$image]);
        }
        return new HTMLRenderer('deleteImage', ['image'=>$image]);
    },
    // 'deleteImage'=>function(): HTTPRenderer{
    //     $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    //     $path = ltrim($path, '/');
    //     $path = ValidationHelper::string($path);
    //     $deleteImage = DatabaseHelper::getImage('delete_url', $path);

    //     return new HTMLRenderer('deleteImage', ['deleteImage'=>$deleteImage]);
    // },
    'notFoundImage'=>function(): HTTPRenderer{
        return new HTMLRenderer('notFoundImage', ['notFoundImage'=>'画像は見つかりませんでした。']);
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
    'api/notFoundImage'=>function(): HTTPRenderer{
        return new JSONRenderer(['notFoundImage'=>'Not Exist Image']);
    }
];