<?php

use app\widgets\Message;

$this->title = 'RBAC - YII2权限管理';
$debug = Yii::$app->params['debug'];
?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="backend/images/logo.png">
                        </div>
                        <h4>RBAC - YII2权限管理</h4>
                        <h6 class="font-weight-light">管理员登录.</h6>
                        <form class="pt-3" id="form-default" action="index.php?r=site/login" method="post">
                            <input type="hidden" value="<?= Yii::$app->request->csrfToken ?>" name="_csrf"/>
                            <div class="form-group">
                                <input name="username" class="form-control form-control-lg"
                                       placeholder="账 户">
                            </div>
                            <div class="form-group">
                                <input type="password" name="userpassword" class="form-control form-control-lg"
                                       placeholder="密 码">
                            </div>
                            <div class="mt-3">
                                <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-semibold auth-form-btn">
                                    登 录
                                </button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" name="rememberme" value="true" class="form-check-input"> 保持登录 </label>
                                </div>
                            </div>
                            <?php
                            echo Message::widget();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>