<?php

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container ">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" style="margin-top: 3rem;" role="alert">
               错误内容：<?php echo $this->title ; ?><br>
               错误信息：<?= nl2br(Html::encode($message)) ?>
            </div>
        </div>
    </div>
</div>