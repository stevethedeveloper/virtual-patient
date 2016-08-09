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

<section class="content">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add Page</h3>
    </div>
    <?= $this->Form->create($contentPage) ?>
        <div class="box-body">
            <?php
                echo $this->Form->input('title', ['class' => 'form-control']);
                echo $this->Form->input('subtitle', ['class' => 'form-control']);
                echo $this->Form->input('content', ['class' => 'form-control', 'required' => false]);
            ?>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    <?= $this->Form->end() ?>
</div>
</section>
