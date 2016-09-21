<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $this->fetch('title') ?></title>

    <!-- Bootstrap Core CSS -->
    <?php
    echo $this->Html->css('bootstrap/bootstrap.css');
    ?>

    <!-- MetisMenu CSS -->
    <?php
    echo $this->Html->css('admin/metisMenu.min.css');
    ?>

    <!-- Timeline CSS -->
    <?php
    echo $this->Html->css('admin/timeline.css');
    ?>

    <!-- Custom CSS -->
    <?php
    echo $this->Html->css('admin/sb-admin-2.css');
    ?>

    <!-- Morris Charts CSS -->
    <?php
    echo $this->Html->css('admin/morris.css');
    ?>

    <!-- Custom Fonts -->
    <?php
        echo $this->Html->css('font-awesome.min.css');
    ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <?php
        echo $this->Html->script('admin/bower_components/jquery/dist/jquery.min.js');
    ?>

    <!-- jQuery-UI -->
    <?php
        echo $this->Html->script('jquery/jquery-ui.min.js');
    ?>

    <!-- TinyMCE -->
    <?php
        echo $this->Html->script('tinymce/tinymce.min.js');
    ?>
    <script>
    tinymce.init({ 
        selector:'textarea',
        //theme : "advanced",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            //"insertdatetime media table contextmenu paste jbimages"
            "insertdatetime media table contextmenu paste validatable"
        ],
        //toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
        force_br_newlines : false,
        force_p_newlines : false,
        forced_root_block : '',
        relative_urls: false
    });
    </script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Wipe Diseases Admin</a>
            </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'index') ? ' class="active"' : '' ?>>
                            <a href="<?= $this->Url->build(['controller' => '/'])?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li<?=!($this->request->controller == 'CustomPages' && $this->request->action == 'index') ? ' class="active"' : '' ?>>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Cases<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= $this->Url->build(['controller' => 'all_cases'])?>"<?=!($this->request->controller == 'CustomPages' && $this->request->action == 'index') ? ' class="active"' : '' ?>>Edit Cases</a>
                                </li>
                                <li>
                                    <a href="<?= $this->Url->build(['controller' => 'all_cases', 'action' => 'newCase'])?>">Add New Case</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <br />
            <?= $this->Flash->render() ?>
            <section class="container clearfix">
                <?= $this->fetch('content') ?>
            </section>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <?php
        echo $this->Html->script('admin/bower_components/bootstrap/dist/js/bootstrap.min.js');
    ?>

    <!-- Metis Menu Plugin JavaScript -->
    <?php
        echo $this->Html->script('admin/bower_components/metisMenu/dist/metisMenu.min.js');
    ?>

    <!-- Morris Charts JavaScript -->
    <?php
        //echo $this->Html->script('admin/bower_components/raphael/raphael-min.js');
    ?>

    <?php
        //echo $this->Html->script('admin/bower_components/morrisjs/morris.min.js');
    ?>

    <?php
        //echo $this->Html->script('admin/morris-data.js');
    ?>


    <!-- Custom Theme JavaScript -->
    <?php
        echo $this->Html->script('admin/sb-admin-2.js');
    ?>

</body>

</html>
