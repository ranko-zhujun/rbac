<?php

use yii\helpers\Html;

\app\assets\BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="<?= Yii::$app->charset ?>">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - Powered by RANKO.CN ! </title>
    <link rel="shortcut icon" href="style/backend/dist/img/favicon.ico">
    <?php $this->head() ?>
    <script src="backend/vendors/js/vendor.bundle.base.js"></script>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
