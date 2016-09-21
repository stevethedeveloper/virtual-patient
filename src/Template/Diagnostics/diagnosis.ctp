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

      <!--left middle-->
      <div class="row">
          <div class="col-md-12 well left-middle">
              <div id="count_div">
              You have selected <strong id="selected_count"><?=$total_count?></strong> of a possible <strong><?=$d_option_cap?></strong> options.
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

			<div class="btn-block center-block">
				<div class="row text-center">
					<div class="col-md-12">
						Your Differential Diagnosis choices are outlined in red.
						<br /><br />
				<?php
					foreach ($options as $option) {
						?>
							<button type="button" id="option-button-<?=$option->id?>" class="btn btn-default btn-md diagnosis-button<?=(in_array($option->id, $already_selected)) ? ' selected-option' : ''?><?=(in_array($option->id, $differential_already_selected)) ? ' dd-selected-option' : ''?>" onClick="javascript:clickButton('<?=$option->id?>', 'diagnosis');"><div><?=$option->diagnosis_name?></div></button>
						<?php
					}
				?>
					</div>
				</div>
			</div>

		</div>

	</div>

    <!--nav-->  
    <div class="row">
        <div class="col-md-10">
            <?= $this->Html->link('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Previous', ['controller' => 'order_labs'], ['class' => 'btn btn-default btn-md previous-button', 'escape' => false])?>
        </div>
        <div class="col-md-2 pull-right">
			<?php if ($locked) {?>
	            <?= $this->Html->link('Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>', ['controller' => 'Management'], ['class' => 'btn btn-default btn-md pull-right', 'escape' => false])?>
			<?php } else {?>
	            <?= $this->Form->postLink('Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>', ['controller' => 'diagnostics', 'action' => 'lock_d'], ['class' => 'btn btn-default btn-md pull-right', 'escape' => false])?>
			<?php }?>
        </div>
    </div>

</div>

<script>
    var selected_count = <?=$total_count?>;

    function clickButton(option_id, section_name) {

    	var button = $("#option-button-" + option_id);
    	var locked = <?=$locked?>;

    	if (locked == 1) {
            alert("You cannot edit your Diagnosis.");
    	} else if (selected_count >= <?=$d_option_cap?> && !button.hasClass("selected-option")) {
            alert("You have selected the maximum number of options.");
        } else {

            var url = "<?php echo $this->Url->build(['controller' => 'Diagnostics', 'action' => 'selectOption']);?>";

            var posting = $.post( url, { option_id:option_id, section_name:section_name } );
         
            posting.done(function( data ) {
                    try {
                        if (button.hasClass("selected-option") && data == "\"removed\"") {
                            button.removeClass("selected-option");
                            selected_count = selected_count - 1;
                            $("#selected_count").html(selected_count);
                        } else {
                            button.addClass("selected-option");
                            selected_count = selected_count + 1;
                            $("#selected_count").html(selected_count);
                        }
                    }
                    catch(err) {
                        //$( "#video_div" ).empty().append( data );
                    }
            });
        }
    }

</script>