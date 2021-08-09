<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;


class BackendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'backend/vendors/mdi/css/materialdesignicons.min.css',
        'backend/vendors/css/vendor.bundle.base.css',
        'backend/vendors/jquery-bar-rating/css-stars.css',
        'backend/vendors/flag-icon-css/css/flag-icon.min.css',
        'backend/vendors/font-awesome/css/font-awesome.min.css',
        'backend/vendors/jquery-toast-plugin/jquery.toast.min.css',
        'backend/css/style.css',
        'backend/css/custom.css'
    ];



    public $js = [
        'backend/js/off-canvas.js',
        'backend/js/hoverable-collapse.js',
        'backend/js/misc.js',
        'backend/js/settings.js',
        'backend/vendors/sweetalert/sweetalert.min.js',
        'backend/vendors/jquery-toast-plugin/jquery.toast.min.js',
        'backend/vendors/tinymce/tinymce.min.js',
        'backend/js/custom.js'
    ];


    public $jsOptions = [
    ];
    public $depends = [

    ];
}

