<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;

return [
    ''=>function(): HTTPRenderer{
        return new HTMLRenderer('newImage', [''=>'']);
    },
    'publicImages'=>function(): HTTPRenderer{
        $ImagesList = DatabaseHelper::getImagesListInfo();

        return new HTMLRenderer('publicImages', ['ImagesList'=>$ImagesList]);
    },
    'image-jpeg'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = ValidationHelper::string($path);
        $url_type = ValidationHelper::urlType($path);
        $image = DatabaseHelper::getImage($url_type, $path);
        
        if($url_type === "post_url"){
            return new HTMLRenderer('postImage', ['image'=>$image]);
        }
        return new HTMLRenderer('deleteImage', ['image'=>$image]);
    },
    'image-png'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = ValidationHelper::string($path);
        $url_type = ValidationHelper::urlType($path);
        $image = DatabaseHelper::getImage($url_type, $path);
        
        if($url_type === "post_url"){
            return new HTMLRenderer('postImage', ['image'=>$image]);
        }
        return new HTMLRenderer('deleteImage', ['image'=>$image]);
    },
    'image-gif'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = ValidationHelper::string($path);
        $url_type = ValidationHelper::urlType($path);
        $image = DatabaseHelper::getImage($url_type, $path);
        
        if($url_type === "post_url"){
            return new HTMLRenderer('postImage', ['image'=>$image]);
        }
        return new HTMLRenderer('deleteImage', ['image'=>$image]);
    },
    'notFoundImage'=>function(): HTTPRenderer{
        return new HTMLRenderer('notFoundImage', ['notFoundImage'=>'ページが見つかりません']);
    },
    'api'=>function(): HTTPRenderer{
        return new JSONRenderer([[''=>'']]);
    },
    'api/publicImages'=>function(){
        $ImagesList = DatabaseHelper::getImagesListInfo();

        return new JSONRenderer(['ImagesList'=>$ImagesList]);
    },
    'api/image-jpeg'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = ValidationHelper::string($path);
        $url_type = ValidationHelper::urlType($path);
        $image = DatabaseHelper::getImage($url_type, $path);
        
        return new JSONRenderer(['image'=>$image]);
    },
    'api/image-png'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = ValidationHelper::string($path);
        $url_type = ValidationHelper::urlType($path);
        $image = DatabaseHelper::getImage($url_type, $path);
        
        return new JSONRenderer(['image'=>$image]);
    },
    'api/image-gif'=>function(): HTTPRenderer{
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = ltrim($path, '/');
        $path = ValidationHelper::string($path);
        $url_type = ValidationHelper::urlType($path);
        $image = DatabaseHelper::getImage($url_type, $path);
        
        return new JSONRenderer(['image'=>$image]);
    },
    'api/notFoundImage'=>function(): HTTPRenderer{
        return new JSONRenderer(['notFoundImage'=>'ページが見つかりません']);
    }
];