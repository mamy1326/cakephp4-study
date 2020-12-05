<?php use Cake\Core\Configure; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo Configure::read('Theme.title'); ?> | パスワードリマインダー</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/admin_l_t_e/bower_components/bootstrap/dist/css/bootstrap.min.css"/><link rel="stylesheet" href="/admin_l_t_e/css/AdminLTE.min.css"/>
    <?php echo $this->fetch('css'); ?>
    <?php echo $this->Html->css('AdminLTE./bower_components/bootstrap/dist/css/bootstrap.min', ['block' => 'css']); ?>
    <!-- Theme style -->
    <?php echo $this->Html->css('AdminLTE.AdminLTE.min', ['block' => 'css']); ?>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?php echo $this->Html->css('style.css'); ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/" >
            <img class="p-pc-header__logo" src="/img/logo.png" alt="ths">
        </a>
    </div>
    <?= $this->Flash->render() ?>
    <div class="users form content">
        <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('emailを入力してください') ?></legend>
            <?= $this->Form->control('email') ?>
        </fieldset>
        <?= $this->Form->button(__('パスワードリセットを実行する')); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<!-- Bootstrap 3.3.7 -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap/dist/js/bootstrap.min', ['block' => 'script']); ?>
</body>
</html>