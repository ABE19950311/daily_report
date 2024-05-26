<?php
/* Smarty version 3.1.34-dev-7, created on 2024-05-26 21:20:37
  from '/var/www/html/daily_reports/app/templates/userRegister.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_66532915c5b8b7_14024714',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae848ee979be5e97788080a501478e32aff5ebd1' => 
    array (
      0 => '/var/www/html/daily_reports/app/templates/userRegister.tpl',
      1 => 1716726035,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66532915c5b8b7_14024714 (Smarty_Internal_Template $_smarty_tpl) {
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
 type="module" src="../../public/js/home.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" src="../../public/js/class.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="module" src="../../public/js/request.js"><?php echo '</script'; ?>
>
</head>
<body>

<div id="register_page" class="page_class">
        <div class="mb-3">
        <label class="form-label">ユーザ名</label>
        <input type="email" class="form-control" id="register_user" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
        <label class="form-label">パスワード</label>
        <input type="password" class="form-control" id="register_password">
        </div>
        <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label">Check me out</label>
        </div>
        <button id="register_submit_btn" type="submit" class="btn btn-primary">Submit</button>
        <button id="register_back_login_btn" class="btn btn-primary">ログイン画面に戻る</button>
  </div>

</body>
</html><?php }
}
