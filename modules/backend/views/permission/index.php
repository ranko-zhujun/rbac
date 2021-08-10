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
    <div class="col-12 mb-3 stretch-card">
        <div class="card">
            <div class="card-body ">
                <form class="form-inline float-right">
                    <a href="index.php?r=backend/permission/edit" class="btn btn-primary">添加权限</a>
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
                        foreach ($permissions as $permission) {
                            if($permission->type == \yii\rbac\Item::TYPE_PERMISSION){
                                ?>
                                <tr>
                                    <td><?php echo $permission->description; ?></td>
                                    <td><?php echo $permission->name; ?></td>
                                    <td><?php echo date("Y-m-d H:i:s",$permission->createdAt);?></td>
                                    <td>
                                        <button type="button" onclick="deletePermission('<?php echo $permission->name; ?>')"
                                                class="btn btn-danger btn-sm mr-2">删除
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
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
    function deletePermission(permissionname) {
        doConfirm('删除权限：'+permissionname+'？', function () {
            window.location.href = 'index.php?r=backend/permission/delete&name=' + permissionname;
        });
    }
</script>