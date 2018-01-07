<?php
use yii\widgets\ActiveForm;

$this->title = '晓涛论坛';
$this->params['breadcrumbs'][] = $this->title;
use yii\imagine\Image;
?>
    <?php

    Image::crop("../uploads/01.jpg", 500, 500,[100,500])
        ->save('../uploads/image.jpg');
    echo "222";
    ?>



</div>
