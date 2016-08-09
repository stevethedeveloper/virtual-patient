<?
    echo $this->Html->script('tinymce/tinymce.min.js');
?>
<script>
tinymce.init({
  selector: 'textarea',
  height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern responsivefilemanager imagetools'
  ],
  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager',
  toolbar2: 'print preview media | forecolor backcolor emoticons',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ],
  external_filemanager_path:"/cake/filemanager/",
  filemanager_title:"Responsive Filemanager" ,
  external_plugins: { "filemanager" : "/cake/filemanager/plugin.min.js"},
  convert_urls: false,
  relative_urls: false,
});
</script>

<style>
    .container {
        cursor:move;
    }
</style>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?= h($contentPage->title) ?></h3>
        </div>
    </div>
    <!-- /.box -->
   
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Videos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody id="selector" class="container">
                <?php foreach ($contentPage->videos as $video): ?>
                <tr id="option_<?=$video->id?>">
                    <td class="col-md-8"><?= h($video->title) ?></td>
                    <td class="actions col-md-4">
                        <?//= $this->Html->link(__('Submenu'), ['action' => 'view', $submenu->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Videos', 'action' => 'edit', $video->id]) ?> - 
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'deleteVideo', $video->id], ['confirm' => __('Are you sure you want to delete "{0}"?', $video->title)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
                <?php if ($this->Paginator->hasPage(2)) {?>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                </div>
                <?}?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Video</h3>
        </div>
        <?= $this->Form->create($newVideo) ?>
            <div class="box-body">
                <?php
                    echo $this->Form->hidden('content_page_id', ['value' => $contentPage->id]);
                    echo $this->Form->hidden('display_order', ['value' => '0']);
                    echo $this->Form->input('title', ['class' => 'form-control', 'value' => '']);
                    echo $this->Form->input('video_url', ['class' => 'form-control', 'value' => '']);
                    echo $this->Form->input('poster_url', ['class' => 'form-control', 'value' => '']);
                    echo $this->Form->input('description', ['class' => 'form-control', 'value' => '']);
                    echo '<br />';
                    //echo $this->Form->input('content_page_id', ['label' => 'Page', 'options' => $contentPages, 'empty' => 'Please Select']);
                    //echo $this->Form->input('url', ['class' => 'form-control', 'required' => false]);
                ?>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        <?= $this->Form->end() ?>
    </div>

</section>

<script>
$(function(){

    /* Sort options */
    $('.container').sortable({
        axis: "y",
        update: function (event, ui) {
            var data = $(this).sortable('toArray');
            var url = "<?php echo $this->Url->build(['controller' => 'ContentPages', 'action' => 'change_video_order']);?>";

            var posting = $.post( url, { data } );
        }   
    }); 
    
});
</script>