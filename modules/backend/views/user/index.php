<?php

use app\widgets\Message;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = '用户';
?>
<input type="hidden" name="location" value="index.php?r=backend/user/index"/>

<div class="page-header">
    <h3 class="page-title"> 用户 </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">用户设置</li>
            <li class="breadcrumb-item active" aria-current="page"> 用户 </li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 mb-3 stretch-card">
        <div class="card">
            <div class="card-body ">
                <form class="form-inline float-right">
                    <a href="index.php?r=backend/user/edit" class="btn btn-primary">添加用户</a>
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
                            <th>名称</th>
                            <th>邮箱</th>
                            <th>创建时间</th>
                            <th>操 作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($userlist['list'] as $user) {
                            ?>
                            <tr>
                                <td><?php echo $user->username; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->createtime;?></td>
                                <td>
                                    <a href="index.php?r=backend/user/edit&id=<?php echo $user['id']; ?>"
                                       class="btn btn-primary btn-sm mr-2">编辑</a>
                                    <button type="button" onclick="deleteUser('<?php echo $user->id; ?>')"
                                            class="btn btn-danger btn-sm mr-2">禁用
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
<div class="row">
    <div class="col-12">
        <nav style="overflow: hidden;">
            <?php
            echo LinkPager::widget([
                'pagination' => $userlist['pagination'],
                'options' => [
                    'class' => 'pagination d-flex justify-content-center table-pagination'
                ],
                'linkOptions' => [
                    'class' => 'page-link'
                ],
                'linkContainerOptions' => [
                    'class' => 'page-item'
                ],
                'disabledPageCssClass' => [
                    'class' => 'page-link disabled'
                ]
            ]);
            ?>
        </nav>
    </div>
</div>
<script>
    function deleteUser(role) {
        doConfirm('禁用用户：'+role+'？', function () {
            window.location.href = 'index.php?r=backend/user/delete&name=' + role;
        });
    }
</script>