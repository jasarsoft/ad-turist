<!DOCTYPE html>
<html>
    <head>
        <title>AD Turist</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo Misc::link('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo Misc::link('assets/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo Misc::link('assets/css/main.css'); ?>" rel="stylesheet">
        <link href="<?php echo Misc::link('assets/css/mobile.css'); ?>" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <header>
                <nav>
                    <?php if (Session::exists('user_id')): ?>
                        <?php include 'app/views/_global/menu-session.php'; ?>
                    <?php else: ?>
                        <?php include 'app/views/_global/menu-no-session.php'; ?>
                    <?php endif; ?>
                </nav>
            </header>
            <section>
