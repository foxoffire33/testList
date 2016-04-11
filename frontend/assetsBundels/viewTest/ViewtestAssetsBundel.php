<?php

namespace frontend\assetsBundels\viewTest;

use yii\web\AssetBundle;

class ViewtestAssetsBundel extends AssetBundle
{

    public $baseUrl = '@web';
    public $sourcePath = '@frontend/assetsBundels/viewTest';
    public $publishOptions = [
        'forceCopy' => true,
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END, 'async' => 'async',];

    public $js = [
        'js/viewTest.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $appendTimestamp = true;

}