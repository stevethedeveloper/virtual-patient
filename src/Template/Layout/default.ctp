<?php

use Cake\Core\Configure;

/**
 * Default `html` block.
 */
if (!$this->fetch('html')) {
    $this->start('html');
    printf('<html lang="%s" class="no-js">', Configure::read('App.language'));
    $this->end();
}

/**
 * Default `title` block.
 */
if (!$this->fetch('title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}

/**
 * Default `footer` block.
 */
if (!$this->fetch('tb_footer')) {
    $this->start('tb_footer');
    printf('&copy;%s %s', date('Y'), Configure::read('App.title'));
    $this->end();
}

/**
 * Default `body` block.
 */
$this->prepend('tb_body_attrs', ' class="' . implode(' ', array($this->request->controller, $this->request->action)) . '" ');
if (!$this->fetch('tb_body_start')) {
    $this->start('tb_body_start');
    echo '<body' . $this->fetch('tb_body_attrs') . '>';
    $this->end();
}
/**
 * Default `flash` block.
 */
if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    if (isset($this->Flash)) {
        echo $this->Flash->render();
    }
    $this->end();
}
if (!$this->fetch('tb_body_end')) {
    $this->start('tb_body_end');
    echo '</body>';
    $this->end();
}

/**
 * Prepend `meta` block with `author` and `favicon`.
 */
$this->prepend('meta', $this->Html->meta('author', null, array('name' => 'author', 'content' => Configure::read('App.author'))));
$this->prepend('meta', $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon')));

/**
 * Prepend `css` block with TwitterBootstrap and Bootflat stylesheets and append
 * the `$html5Shim`.
 */
$html5Shim =
<<<HTML
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
HTML;
$this->prepend('css', $this->Html->css(['bootstrap/bootstrap']));
$this->append('css', $html5Shim);

$this->prepend('script', $this->Html->script(['bootstrap/bootstrap']));

?>
<!DOCTYPE html>

<?= $this->fetch('html') ?>

    <head>

        <?= $this->Html->charset() ?>

        <title><?= $this->fetch('title') ?></title>

        <?php
        echo $this->Html->css('jquery.jscrollpane.css');
        echo $this->Html->css('jquery.jscrollpane.lozenge.css');
        echo $this->Html->css('style.css');

        echo $this->Html->script('jquery/jquery.js');
        echo $this->Html->script('jquery.mousewheel.js');    
        echo $this->Html->script('jquery.jscrollpane.min.js');    
        ?>


        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    
    </head>

    <?php
    echo $this->fetch('tb_body_start');
    ?>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--<a class="navbar-brand" href="#">Virtual Patient: </a>-->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?=$course_home?>" class="button"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Return</a></li>

            <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'intro') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => '/'])?>">Intro</a></li>

            <?if (in_array('history', $locked_sections)) {?>
                <li><a class="locked">History</a></li>
            <?} else {?>
                <li<?=($this->request->controller == 'HistoryQuestions' && $this->request->action == 'index') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'HistoryQuestions'])?>">History</a></li>
            <?}?>

            <?if (in_array('physical_exam', $locked_sections)) {?>
                <li><a class="locked">Physical Exam</a></li>
            <?} else {?>
                <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'physicalExam') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'physical_exam'])?>">Physical Exam</a></li>
            <?}?>

            <?if (in_array('differential_diagnosis', $locked_sections)) {?>
                <li><a class="locked">Differential Diagnosis</a></li>
            <?} else {?>
                <li<?=($this->request->controller == 'Diagnostics' && $this->request->action == 'differential') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'Diagnostics', 'action' => 'differential'])?>">Differential Diagnosis</a></li>
            <?}?>

            <?if (in_array('more_information', $locked_sections)) {?>
                <li><a class="locked">More Info</a></li>
            <?} else {?>
                <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'moreInformation') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'more_information'])?>">More Info</a></li>
            <?}?>
    
            <?if (in_array('labs', $locked_sections)) {?>
                <li><a class="locked">Study</a></li>
            <?} else {?>
                <li<?=($this->request->controller == 'OrderLabs' && $this->request->action == 'index') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'order_labs'])?>">Study</a></li>
            <?}?>

            <?if (in_array('diagnosis', $locked_sections)) {?>
                <li><a class="locked">Diagnosis</a></li>
            <?} else {?>
                <li<?=($this->request->controller == 'Diagnostics' && $this->request->action == 'diagnosis') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'Diagnostics', 'action' => 'diagnosis'])?>">Diagnosis</a></li>
            <?}?>

            <?if (in_array('management_counseling', $locked_sections) && in_array('management_medication', $locked_sections) && in_array('management_referral', $locked_sections)) {?>
                <li><a class="locked">Management</a></li>
            <?} else {?>
                <li<?=($this->request->controller == 'ManagementCounselings' || $this->request->controller == 'ManagementMedications' || $this->request->controller == 'ManagementReferrals') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'management'])?>">Management</a></li>
            <?}?>

            <?if ($hide_billing != 1) {?>
                <?if (in_array('billing', $locked_sections)) {?>
                    <li><a class="locked">Billing</a></li>
                <?} else {?>
                    <li<?=($this->request->controller == 'Billings' && $this->request->action == 'index') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'billing'])?>">Billing</a></li>
                <?}?>
            <?}?>

            <?if (in_array('feedback_labs', $locked_sections) && in_array('feedback_counseling', $locked_sections) && in_array('feedback_medication', $locked_sections) && in_array('feedback_referral', $locked_sections) && in_array('feedback_billing', $locked_sections)) {?>
                <li><a class="locked">Feedback</a></li>
            <?} else {?>
                <li<?=($this->request->controller == 'Feedback') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'feedback'])?>">Feedback</a></li>
            <?}?>

            <?if (in_array('summary', $locked_sections)) {?>
                <li><a class="locked">Summary</a></li>
            <?} else {?>
                <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'summary') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'summary'])?>">Summary</a></li>
            <?}?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="content">
        <?php
        echo $this->fetch('tb_flash');
        ?>
        <?php
        echo $this->fetch('content');
        ?>
    </div>
    <?php
    echo $this->fetch('tb_footer');
    echo $this->fetch('script');
    echo $this->fetch('tb_body_end');
    ?>
</html>
