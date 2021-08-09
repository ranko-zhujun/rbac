<?php

use app\widgets\Alert;
use yii\helpers\Html;

\app\assets\BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="backend/dist/img/favicon.ico">
    <?php $this->head() ?>
    <script src="backend/vendors/js/vendor.bundle.base.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container-scroller">
    <!-- partial:../../partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item border-bottom ">
                <div class="dropdown nav-link user-profile-button">
                    <button type="button" class="btn btn-primary btn-block dropdown-toggle" id="mypanel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-account"></i>&nbsp;&nbsp;<h6 style="display: inline;"><?php echo Yii::$app->user->identity['loginname'] ?></h6>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="mypanel">
                        <h6 class="dropdown-header"><i class="fa fa-cogs"></i>&nbsp;个人设置</h6>
                        <a class="dropdown-item" href="index.php?r=backend/user/edit&userId=<?php echo Yii::$app->user->identity['id'] ?>"><i class="fa fa-lock"></i>&nbsp;修改密码</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?r=site/logout"><i class="fa fa-power-off"></i>&nbsp;退出</a>
                    </div>
                </div>
            </li>
            <li class="pt-2 pb-1">
                <span class="nav-item-head">功能列表</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?r=backend/default/index">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span class="menu-title">控制面板</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?r=backend/post/index">
                    <i class="mdi mdi-file-document menu-icon"></i>
                    <span class="menu-title">内容</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?r=backend/catalog/index">
                    <i class="mdi mdi-tree menu-icon"></i>
                    <span class="menu-title">目录</span>
                </a>
            </li>
            <li class="nav-item <?php echo Yii::$app->user->identity['super']==1?'':'border-bottom'; ?>">
                <a class="nav-link" href="index.php?r=backend/attachment/index">
                    <i class="fa fa-cloud menu-icon"></i>
                    <span class="menu-title">附件</span>
                </a>
            </li>
            <?php
            if(Yii::$app->user->identity['super']==1){
                ?>
                <li class="nav-item border-bottom">
                    <a class="nav-link" href="index.php?r=backend/user/index">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">用户</span>
                    </a>
                </li>
                <?php
            }
            ?>
            <li class="nav-item ">
                <a class="nav-link" href="http://www.ranko.cn" target="_blank">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">文档</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid page-body-wrapper">
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="../../index.html"><img
                                src="../../../assets/images/logo-mini.svg" alt="logo"/></a>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="/" target="_blank">
                            <i class="mdi mdi-home-circle"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <?= $content ?>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y'); ?>
                        <a href="http://www.ranko.cn" target="_blank">无锡市蓝科创想科技有限公司</a>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a
                                href="http://www.ranko.cn" target="_blank">如果觉得本系统不错，请赞助我！</a><i class="fa fa-heart text-danger"></i></span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
