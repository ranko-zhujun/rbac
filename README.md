<p align="center">
   <br>
    <a href="http://www.ranko.cn" target="_blank">
         <br>
        <img src="http://www.ranko.cn/theme/img/logo.png" height="80px" >
    </a>
    <h1 align="center">RBAC - YII2权限管理</h1>
    <br>
</p>

RBAC - YII2权限管理

# 开源协议
GPL

# 注意事项
严禁使用本软件从事任何非法活动

# 安装步骤
1. 复制install目录下的dev文件至config目录下
2. 修改dev目录下的db.php中的数据库配置
3. 数据库导入SQL脚本,对应的脚本install目录下
4. 默认密码：ranko/admin
5. 后台地址：index.php?r=site/login

## 使用事项
1.starter/filter/BackendSessionFilter中的注释掉的代码取消注释，以开启权限过滤

```
$permission = $action->controller->module->id.'/'.$action->controller->id.'/'.$action->id;
if(\Yii::$app->user->can($permission)){
    return parent::beforeAction($action);
}else{
    throw new UnauthorizedHttpException($permission);
}
```

# 代码地址
GITHUB：https://github.com/ranko-zhujun/rbac