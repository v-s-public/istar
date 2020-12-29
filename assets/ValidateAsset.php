<?php

namespace app\assets;
use yii\web\AssetBundle;

class ValidateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/jquery.validate.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}