<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'statics/css/style.css',
        'statics/css/material-icons.css',
        'statics/css/font-awesome.css',
        'statics/css/font-awesome.min.css',
        'statics/css/bootstrap.min.css',
        'statics/css/site.css',
        'statics/css/iconfont.css',
        'statics/css/fileUpload.css'
    ];
    public $js = [
      'statics/js/bootstrap.min.js',
        'statics/js/jquery-1.11.3.min.js',
        'statics/js/iconfont.js',
        'statics/js/fileUpload.js',
        'statics/js/jquery-2.1.3.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'light\widgets\SweetSubmitAsset'

    ];

}
