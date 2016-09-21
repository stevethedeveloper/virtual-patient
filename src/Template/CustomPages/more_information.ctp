<div class="row two-column-video">

	<!--left column-->
	<div class="col-md-5 left-column">
		<div class="col-md-12">

			<!--left top-->
			<div class="row">
				<div class="col-md-12 well left-top">
					<h1><?php echo $page->pages_title; ?></h1>
                    <div id="media_div">
                        <div id="image">
                            <img src="<?=$poster?>" alt="" />
                        </div>
                    </div>
		        </div>
			</div>

			<!--left bottom-->
			<div class="row">
				<div class="col-md-12 well left-bottom">
					<?=$page->pages_desc?>
				</div>
			</div>

		</div>
	</div>

	<!--right column-->
	<div class="col-md-7 well right-column">
		
		<div class="col-md-12">
			<div id="pe-image-div">
				<?=$page->pages_text?>
			</div>
		</div>

	</div>

    <!--nav-->  
    <div class="row">
        <div class="col-md-10">
            <?= $this->Html->link('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Previous', ['controller' => 'diagnostics', 'action' => 'differential'], ['class' => 'btn btn-default btn-md previous-button', 'escape' => false])?>
        </div>
        <div class="col-md-2 pull-right">
            <?= $this->Html->link('Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>', ['controller' => 'order_labs'], ['class' => 'btn btn-default btn-md pull-right', 'escape' => false])?>
        </div>
    </div>

</div>

