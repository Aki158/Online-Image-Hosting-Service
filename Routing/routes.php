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
        $imagesList = DatabaseHelper::getImagesListInfo();

        return new HTMLRenderer('publicImages', ['imagesList'=>$imagesList]);
    },
    'image-jpeg'=>function(): HTTPRenderer{
        $imageUrlType = getImageUrlTypeInfo($_SERVER['REQUEST_URI']);

        if($imageUrlType['urlType'] === "post_url"){
            return new HTMLRenderer('postImage', ['image'=>$imageUrlType['image']]);
        }
        return new HTMLRenderer('deleteImage', ['image'=>$imageUrlType['image']]);
    },
    'image-png'=>function(): HTTPRenderer{
        $imageUrlType = getImageUrlTypeInfo($_SERVER['REQUEST_URI']);

        if($imageUrlType['urlType'] === "post_url"){
            return new HTMLRenderer('postImage', ['image'=>$imageUrlType['image']]);
        }
        return new HTMLRenderer('deleteImage', ['image'=>$imageUrlType['image']]);
    },
    'image-gif'=>function(): HTTPRenderer{
        $imageUrlType = getImageUrlTypeInfo($_SERVER['REQUEST_URI']);

        if($imageUrlType['urlType'] === "post_url"){
            return new HTMLRenderer('postImage', ['image'=>$imageUrlType['image']]);
        }
        return new HTMLRenderer('deleteImage', ['image'=>$imageUrlType['image']]);
    },
    'notFoundImage'=>function(): HTTPRenderer{
        return new HTMLRenderer('notFoundImage', ['notFoundImage'=>'ページが見つかりません']);
    },
    'api'=>function(): HTTPRenderer{
        return new JSONRenderer([[''=>'']]);
    },
    'api/publicImages'=>function(){
        $imagesList = DatabaseHelper::getImagesListInfo();

        return new JSONRenderer(['imagesList'=>$imagesList]);
    },
    'api/image-jpeg'=>function(): HTTPRenderer{
        $imageUrlType = getImageUrlTypeInfo($_SERVER['REQUEST_URI']);

        return new JSONRenderer(['image'=>$imageUrlType['image']]);
    },
    'api/image-png'=>function(): HTTPRenderer{
        $imageUrlType = getImageUrlTypeInfo($_SERVER['REQUEST_URI']);

        return new JSONRenderer(['image'=>$imageUrlType['image']]);
    },
    'api/image-gif'=>function(): HTTPRenderer{
        $imageUrlType = getImageUrlTypeInfo($_SERVER['REQUEST_URI']);

        return new JSONRenderer(['image'=>$imageUrlType['image']]);
    },
    'api/notFoundImage'=>function(): HTTPRenderer{
        return new JSONRenderer(['notFoundImage'=>'ページが見つかりません']);
    }
];

function getImageUrlTypeInfo($requestUrl){
    $path = parse_url($requestUrl, PHP_URL_PATH);
    $path = ltrim($path, '/');
    $path = ValidationHelper::string($path);
    $urlType = ValidationHelper::urlType($path);
    $image = DatabaseHelper::getImage($urlType, $path);

    $imageUrlType = [
        "urlType" => $urlType,
        "image" => $image
    ];
    return $imageUrlType;
}