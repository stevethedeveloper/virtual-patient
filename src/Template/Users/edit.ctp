<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('all_cases_id');
            echo $this->Form->input('user_name');
            echo $this->Form->input('password');
            echo $this->Form->input('HQ1');
            echo $this->Form->input('HQ2');
            echo $this->Form->input('HQ3');
            echo $this->Form->input('HQ4');
            echo $this->Form->input('HQ5');
            echo $this->Form->input('HQ6');
            echo $this->Form->input('HQ7');
            echo $this->Form->input('HQ8');
            echo $this->Form->input('HQ9');
            echo $this->Form->input('HQ10');
            echo $this->Form->input('HQ11');
            echo $this->Form->input('HQ12');
            echo $this->Form->input('HQ13');
            echo $this->Form->input('HQ14');
            echo $this->Form->input('HQ15');
            echo $this->Form->input('HQ16');
            echo $this->Form->input('HQ17');
            echo $this->Form->input('HQ18');
            echo $this->Form->input('HQ19');
            echo $this->Form->input('HQ20');
            echo $this->Form->input('HQ21');
            echo $this->Form->input('HQ22');
            echo $this->Form->input('HQ23');
            echo $this->Form->input('HQ24');
            echo $this->Form->input('HQ25');
            echo $this->Form->input('HQ26');
            echo $this->Form->input('HQ27');
            echo $this->Form->input('HQ28');
            echo $this->Form->input('HQ29');
            echo $this->Form->input('HQ30');
            echo $this->Form->input('HQ31');
            echo $this->Form->input('HQ32');
            echo $this->Form->input('HQ33');
            echo $this->Form->input('HQ34');
            echo $this->Form->input('HQ35');
            echo $this->Form->input('HQ36');
            echo $this->Form->input('HQ37');
            echo $this->Form->input('HQ38');
            echo $this->Form->input('HQ39');
            echo $this->Form->input('HQ40');
            echo $this->Form->input('HQ41');
            echo $this->Form->input('HQ42');
            echo $this->Form->input('HQ43');
            echo $this->Form->input('HQ44');
            echo $this->Form->input('HQ45');
            echo $this->Form->input('HQ46');
            echo $this->Form->input('HQ47');
            echo $this->Form->input('HQ48');
            echo $this->Form->input('HQ49');
            echo $this->Form->input('HQ50');
            echo $this->Form->input('HQASKED');
            echo $this->Form->input('DD1');
            echo $this->Form->input('DD2');
            echo $this->Form->input('DD3');
            echo $this->Form->input('DD4');
            echo $this->Form->input('DD5');
            echo $this->Form->input('DD6');
            echo $this->Form->input('DD7');
            echo $this->Form->input('DD8');
            echo $this->Form->input('DDCHOSEN');
            echo $this->Form->input('DDFINAL');
            echo $this->Form->input('D1');
            echo $this->Form->input('D2');
            echo $this->Form->input('D3');
            echo $this->Form->input('D4');
            echo $this->Form->input('DCHOSEN');
            echo $this->Form->input('DFINAL');
            echo $this->Form->input('LAB1');
            echo $this->Form->input('LAB2');
            echo $this->Form->input('LAB3');
            echo $this->Form->input('LAB4');
            echo $this->Form->input('LAB5');
            echo $this->Form->input('LAB6');
            echo $this->Form->input('LAB7');
            echo $this->Form->input('LAB8');
            echo $this->Form->input('LAB9');
            echo $this->Form->input('LAB10');
            echo $this->Form->input('LAB11');
            echo $this->Form->input('LAB12');
            echo $this->Form->input('LAB13');
            echo $this->Form->input('LAB14');
            echo $this->Form->input('LAB15');
            echo $this->Form->input('LAB16');
            echo $this->Form->input('LAB17');
            echo $this->Form->input('LAB18');
            echo $this->Form->input('LAB19');
            echo $this->Form->input('LAB20');
            echo $this->Form->input('LABSCHOSEN');
            echo $this->Form->input('MC1');
            echo $this->Form->input('MC2');
            echo $this->Form->input('MC3');
            echo $this->Form->input('MC4');
            echo $this->Form->input('MC5');
            echo $this->Form->input('MC6');
            echo $this->Form->input('MC7');
            echo $this->Form->input('MC8');
            echo $this->Form->input('MC9');
            echo $this->Form->input('MC10');
            echo $this->Form->input('MC11');
            echo $this->Form->input('MC12');
            echo $this->Form->input('mc_counter');
            echo $this->Form->input('MM1');
            echo $this->Form->input('MM2');
            echo $this->Form->input('MM3');
            echo $this->Form->input('MM4');
            echo $this->Form->input('MM5');
            echo $this->Form->input('MM6');
            echo $this->Form->input('MM7');
            echo $this->Form->input('MM8');
            echo $this->Form->input('MM9');
            echo $this->Form->input('MM10');
            echo $this->Form->input('MM11');
            echo $this->Form->input('MM12');
            echo $this->Form->input('MM13');
            echo $this->Form->input('mm_counter');
            echo $this->Form->input('MR1');
            echo $this->Form->input('MR2');
            echo $this->Form->input('MR3');
            echo $this->Form->input('MR4');
            echo $this->Form->input('MR5');
            echo $this->Form->input('MR6');
            echo $this->Form->input('MR7');
            echo $this->Form->input('MR8');
            echo $this->Form->input('MR9');
            echo $this->Form->input('MR10');
            echo $this->Form->input('MR11');
            echo $this->Form->input('MR12');
            echo $this->Form->input('MR13');
            echo $this->Form->input('mr_counter');
            echo $this->Form->input('B1');
            echo $this->Form->input('B2');
            echo $this->Form->input('B3');
            echo $this->Form->input('B4');
            echo $this->Form->input('B5');
            echo $this->Form->input('B6');
            echo $this->Form->input('B7');
            echo $this->Form->input('B8');
            echo $this->Form->input('B9');
            echo $this->Form->input('B10');
            echo $this->Form->input('b_counter');
            echo $this->Form->input('is_admin');
            echo $this->Form->input('complete');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
