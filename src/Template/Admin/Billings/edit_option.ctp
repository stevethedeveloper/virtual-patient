<?= $this->Form->create($billing) ?>
<?= $this->Element('edit_submenu')?>
    <h3>Edit Option</h3>

    <div class="col-md-10 panel panel-default">
        <div class="panel-body">
            <fieldset>
                <?php
                    echo $this->Form->hidden('all_cases_id', ['value' => $billing->all_cases_id]);
                    echo $this->Form->input('billing_text', ['required' => false]);
                    echo $this->Form->input('pict_ordered', ['required' => false, 'label' => 'Thumbnail Image If Ordered (Full URL)']);
                    echo $this->Form->input('pict_ordered_lg', ['required' => false, 'label' => 'Full Size Image If Ordered (Full URL)']);
                    echo $this->Form->input('pict_not_ordered', ['required' => false, 'label' => 'Thumbnail Image If Not Ordered (Full URL)']);
                    echo $this->Form->input('pict_not_ordered_lg', ['required' => false, 'label' => 'Full Size Image If Not Ordered (Full URL)']);
                    echo $this->Form->input('if_ordered', ['required' => false, 'label' => 'Feedback if Ordered']);
                    echo $this->Form->input('billing_yield', ['required' => false, 'options' => $yield_names, 'label' => 'Yield if Ordered']);
                    echo $this->Form->input('vid_ordered', ['required' => false, 'label' => 'Video if Ordered (File Name Only)']);
                    echo $this->Form->input('not_ordered', ['required' => false, 'label' => 'Feedback if Not Ordered']);
                    echo $this->Form->input('billing_yield_not_ordered', ['required' => false, 'options' => $yield_names, 'label' => 'Yield if Not Ordered']);
                    echo $this->Form->input('vid_not_ordered', ['required' => false, 'label' => 'Video if Not Ordered (File Name Only)']);
                ?>
            </fieldset>
        </div>
    </div>
    <div class="col-md-10">
        <?= $this->Form->button(__('Submit')) ?>
    </div>
<?= $this->Form->end() ?>
