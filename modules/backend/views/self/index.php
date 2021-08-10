<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '修改密码';
?>

<div class="page-header">
    <h3 class="page-title"> 修改密码 </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">个人信息</li>
            <li class="breadcrumb-item active" aria-current="page"> 修改密码 </li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <?php
        echo app\widgets\Message::widget();
        ?>
    </div>
</div>


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'form-edit']); ?>
                <?php $form->action = 'index.php?r=backend/self/changepassword' ?>
                <?= $form->field($model, 'id', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->label(false)->hiddenInput(); ?>
                <fieldset>
                    <?= $form->field($model, 'username', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textInput([
                        'readonly'=>'readonly'
                    ]) ?>
                    <?= $form->field($model, 'email', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textInput([
                        'readonly'=>'readonly'
                    ]) ?>
                    <?= $form->field($model, 'password_hash', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                    <?= Html::submitButton('提 交', ['class' => 'btn btn-primary']) ?>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>