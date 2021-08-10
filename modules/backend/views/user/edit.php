<?php

use app\widgets\Message;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
$authManager = Yii::$app->authManager;

$this->title = '用户';
?>
<input type="hidden" name="location" value="index.php?r=backend/user/index"/>

<div class="page-header">
    <h3 class="page-title"> 用户 </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">用户设置</li>
            <li class="breadcrumb-item active" aria-current="page">用户</li>
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
                <?php $form->action = 'index.php?r=backend/user/save' ?>
                <?= $form->field($model, 'id', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->hiddenInput(); ?>
                <fieldset>
                    <?php
                    if($model->id ==0){
                        ?>
                        <?= $form->field($model, 'username', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                        <?= $form->field($model, 'email', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                        <?php
                    }else{
                        ?>
                        <?= $form->field($model, 'username', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textInput([
                            'readonly'=>'readonly'
                        ]) ?>
                        <?= $form->field($model, 'email', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textInput([
                            'readonly'=>'readonly'
                        ]) ?>
                        <?php
                    }
                    ?>
                    <?= $form->field($model, 'password_hash', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <?php
                                $index_col_1 = 0;
                                foreach ($roles as $role) {
                                    if($index_col_1%2==0){
                                        $checked = false;
                                        if($model->id!=0){
                                            $checked = $authManager->getAssignment($role->name,$model->id)==null?false:true;
                                        }
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" <?php echo $checked?'checked':''; ?> name="roles[]" value="<?php echo $role->name; ?>" class="form-check-input"> <?php echo $role->name; ?>(<?php echo $role->description; ?>) <i class="input-helper"></i></label>
                                        </div>
                                        <?php
                                    }
                                    $index_col_1 ++;
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <?php
                                $index_col_2 = 0;
                                foreach ($roles as $role) {
                                    if($index_col_2%2==1){
                                        $checked = false;
                                        if($model->id!=0){
                                            $checked = $authManager->getAssignment($role->name,$model->id)==null?false:true;
                                        }
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" <?php echo $checked?'checked':''; ?> name="roles[]" value="<?php echo $role->name; ?>" class="form-check-input"> <?php echo $role->name; ?>(<?php echo $role->description; ?>) <i class="input-helper"></i></label>
                                        </div>
                                        <?php
                                    }
                                    $index_col_2 ++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?= Html::submitButton('提 交', ['class' => 'btn btn-primary']) ?>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>