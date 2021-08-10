<?php

use app\widgets\Message;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = '权限';
?>
<input type="hidden" name="location" value="index.php?r=backend/role/index"/>

<div class="page-header">
    <h3 class="page-title"> 角色 </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">用户设置</li>
            <li class="breadcrumb-item active" aria-current="page"> 角色 </li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 mb-3 stretch-card">
        <div class="card">
            <div class="card-body ">
                <form class="form-inline float-right">
                    <a href="index.php?r=backend/role/edit" class="btn btn-primary">添加角色</a>
                </form>
            </div>
        </div>
    </div>
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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>描述</th>
                            <th>名称</th>
                            <th>创建时间</th>
                            <th>操 作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($roles as $role) {
                            ?>
                            <tr>
                                <td><?php echo $role->description; ?></td>
                                <td><?php echo $role->name; ?></td>
                                <td><?php echo $role->createdAt;?></td>
                                <td>
                                    <button type="button" onclick="deleteRole('<?php echo $role->name; ?>')"
                                            class="btn btn-danger btn-sm mr-2">删除
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteRole(role) {
        doConfirm('删除角色：'+role+'？', function () {
            window.location.href = 'index.php?r=backend/role/delete&name=' + role;
        });
    }
</script>