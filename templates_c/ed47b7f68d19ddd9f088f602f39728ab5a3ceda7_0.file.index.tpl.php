<?php
/* Smarty version 3.1.34-dev-7, created on 2024-05-25 22:42:02
  from '/var/www/html/daily_reports/app/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6651eaaa5f0061_17318544',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed47b7f68d19ddd9f088f602f39728ab5a3ceda7' => 
    array (
      0 => '/var/www/html/daily_reports/app/templates/index.tpl',
      1 => 1716644399,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6651eaaa5f0061_17318544 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/index.css">
    <!-- Bootstrap CSS -->
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
    <!-- Bootstrap JS (optional, for components that require JS) -->
    <?php echo '<script'; ?>
 src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" src="../../public/js/index.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" src="../../public/js/class.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" src="../../public/js/request.js"><?php echo '</script'; ?>
>
</head>
<body>
<div id="login_page" class="page_class">
<div class="row mgTp">
    <h3 class="title">Please sign in</h3>
    <hr class="divisor">
    <div class="form-group">
        <label>Username</label>
        <input type="email" class="form-control" id="login_user" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="login_password" placeholder="Password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1111">
        <label class="form-check-label">Remember me</label>
    </div>
    <button id="login_btn" type="submit" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i> Sign in</button>
    <button id="login_register_btn" type="submit" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i> 新規登録</button>
</div>
</div>
</body>
</html><?php }
}
