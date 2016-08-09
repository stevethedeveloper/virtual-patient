<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'The Wellbeing Campaign';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?//= $this->Html->css('base.css') ?>
    <?//= $this->Html->css('cake.css') ?>

    <?php
    echo $this->Html->css('bootstrap.css');
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <?php
    echo $this->Html->script('bootstrap.min.js');
    ?>

    <?= $this->Html->css('style.css') ?>

    <?= $this->Html->css('/font-awesome/css/font-awesome.min.css') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?//= $this->fetch('meta') ?>
    <?//= $this->fetch('css') ?>
    <?//= $this->fetch('script') ?>
</head>
<body>
<div id="content">
    <div class="top-header">
        <?=$this->Html->image('full_logo.png');?>

        <a href="<?php echo $this->Url->build(["controller" => "for-providers-staff"]);?>">
        <button type="button" class="btn btn-default" aria-label="Left Align">
          <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
          For Providers &amp; Staff
        </button>
        </a>

    </div>
    <!-- Navigation -->
    <nav class="navbar navbar-default topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand topnav" href="#">Start Bootstrap</a>-->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php foreach ($menus as $menu) {?>
                    <li>
                        <?php if (!empty($menu->content_page)) {?>
                            <a href="<?php echo $this->Url->build(["controller" => $menu->content_page->slug]);?>"><?=$menu->title?></a>
                        <?php } else {?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$menu->title?></span></a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($menu->child_menus as $child) {?>
                                        <li><a href="<?php echo $this->Url->build(["controller" => $child->content_page->slug]);?>"><?=$child['title']?></a></li>
                                    <?php }?>
                                </ul>
                            </li>
                        <?php }?>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div id="title">
        <h3><?= $contentPage->title ?></h3>
        <?= $contentPage->subtitle ?>
    </div>

    <div id="title-wave">
    </div>

    <div id="page-content">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright text-muted small">&copy; <?=date("Y")?> &nbsp;&nbsp;&nbsp;&nbsp;<?=$this->Html->link('Privacy Policy', '/privacy-policy');?></p>
                </div>
            </div>
        </div>
    </footer>

</div>
</body>
</html>