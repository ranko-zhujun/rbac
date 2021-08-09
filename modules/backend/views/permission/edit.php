<?php

use app\widgets\Message;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = '权限';
?>
<input type="hidden" name="location" value="index.php?r=backend/permission/index"/>

<div class="page-header">
    <h3 class="page-title"> 权限 </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">用户设置</li>
            <li class="breadcrumb-item active" aria-current="page">权限</li>
        </ol>
    </nav>
</div>


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'form-edit']); ?>
                <?php $form->action = 'index.php?r=backend/catalog/save' ?>
                <fieldset>
                    <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                    <?= $form->field($model, 'catalogname', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                    <?= $form->field($model, 'catalogtype', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->dropDownList($catalogtype) ?>
                    <?= Html::submitButton('提 交', ['class' => 'btn btn-primary']) ?>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
