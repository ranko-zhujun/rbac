<?php

use app\widgets\Message;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = '角色';
?>
<input type="hidden" name="location" value="index.php?r=backend/role/index"/>

<div class="page-header">
    <h3 class="page-title"> 角色 </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">用户设置</li>
            <li class="breadcrumb-item active" aria-current="page">角色</li>
        </ol>
    </nav>
</div>


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'form-edit']); ?>
                <?php $form->action = 'index.php?r=backend/role/save' ?>
                <fieldset>
                    <?= $form->field($model, 'name', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                    <?= $form->field($model, 'description', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <?php
                                $index_col_1 = 0;
                                foreach ($permissions as $permission) {
                                    if($index_col_1%2==0){
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="permissions[]" value="<?php echo $permission->name; ?>" class="form-check-input"> <?php echo $permission->name; ?>(<?php echo $permission->description; ?>) <i class="input-helper"></i></label>
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
                                foreach ($permissions as $permission) {
                                    if($index_col_2%2==1){
                                        ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="permissions[]" value="<?php echo $permission->name; ?>" class="form-check-input"> <?php echo $permission->name; ?>(<?php echo $permission->description; ?>) <i class="input-helper"></i></label>
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
