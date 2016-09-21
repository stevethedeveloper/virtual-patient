<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List All Cases'), ['controller' => 'AllCases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New All Case'), ['controller' => 'AllCases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User Name') ?></th>
            <td><?= h($user->user_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ1') ?></th>
            <td><?= h($user->HQ1) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ2') ?></th>
            <td><?= h($user->HQ2) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ3') ?></th>
            <td><?= h($user->HQ3) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ4') ?></th>
            <td><?= h($user->HQ4) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ5') ?></th>
            <td><?= h($user->HQ5) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ6') ?></th>
            <td><?= h($user->HQ6) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ7') ?></th>
            <td><?= h($user->HQ7) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ8') ?></th>
            <td><?= h($user->HQ8) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ9') ?></th>
            <td><?= h($user->HQ9) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ10') ?></th>
            <td><?= h($user->HQ10) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ11') ?></th>
            <td><?= h($user->HQ11) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ12') ?></th>
            <td><?= h($user->HQ12) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ13') ?></th>
            <td><?= h($user->HQ13) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ14') ?></th>
            <td><?= h($user->HQ14) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ15') ?></th>
            <td><?= h($user->HQ15) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ16') ?></th>
            <td><?= h($user->HQ16) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ17') ?></th>
            <td><?= h($user->HQ17) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ18') ?></th>
            <td><?= h($user->HQ18) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ19') ?></th>
            <td><?= h($user->HQ19) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ20') ?></th>
            <td><?= h($user->HQ20) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ21') ?></th>
            <td><?= h($user->HQ21) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ22') ?></th>
            <td><?= h($user->HQ22) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ23') ?></th>
            <td><?= h($user->HQ23) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ24') ?></th>
            <td><?= h($user->HQ24) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ25') ?></th>
            <td><?= h($user->HQ25) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ26') ?></th>
            <td><?= h($user->HQ26) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ27') ?></th>
            <td><?= h($user->HQ27) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ28') ?></th>
            <td><?= h($user->HQ28) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ29') ?></th>
            <td><?= h($user->HQ29) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ30') ?></th>
            <td><?= h($user->HQ30) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ31') ?></th>
            <td><?= h($user->HQ31) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ32') ?></th>
            <td><?= h($user->HQ32) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ33') ?></th>
            <td><?= h($user->HQ33) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ34') ?></th>
            <td><?= h($user->HQ34) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ35') ?></th>
            <td><?= h($user->HQ35) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ36') ?></th>
            <td><?= h($user->HQ36) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ37') ?></th>
            <td><?= h($user->HQ37) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ38') ?></th>
            <td><?= h($user->HQ38) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ39') ?></th>
            <td><?= h($user->HQ39) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ40') ?></th>
            <td><?= h($user->HQ40) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ41') ?></th>
            <td><?= h($user->HQ41) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ42') ?></th>
            <td><?= h($user->HQ42) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ43') ?></th>
            <td><?= h($user->HQ43) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ44') ?></th>
            <td><?= h($user->HQ44) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ45') ?></th>
            <td><?= h($user->HQ45) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ46') ?></th>
            <td><?= h($user->HQ46) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ47') ?></th>
            <td><?= h($user->HQ47) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ48') ?></th>
            <td><?= h($user->HQ48) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ49') ?></th>
            <td><?= h($user->HQ49) ?></td>
        </tr>
        <tr>
            <th><?= __('HQ50') ?></th>
            <td><?= h($user->HQ50) ?></td>
        </tr>
        <tr>
            <th><?= __('DD1') ?></th>
            <td><?= h($user->DD1) ?></td>
        </tr>
        <tr>
            <th><?= __('DD2') ?></th>
            <td><?= h($user->DD2) ?></td>
        </tr>
        <tr>
            <th><?= __('DD3') ?></th>
            <td><?= h($user->DD3) ?></td>
        </tr>
        <tr>
            <th><?= __('DD4') ?></th>
            <td><?= h($user->DD4) ?></td>
        </tr>
        <tr>
            <th><?= __('DD5') ?></th>
            <td><?= h($user->DD5) ?></td>
        </tr>
        <tr>
            <th><?= __('DD6') ?></th>
            <td><?= h($user->DD6) ?></td>
        </tr>
        <tr>
            <th><?= __('DD7') ?></th>
            <td><?= h($user->DD7) ?></td>
        </tr>
        <tr>
            <th><?= __('DD8') ?></th>
            <td><?= h($user->DD8) ?></td>
        </tr>
        <tr>
            <th><?= __('DDCHOSEN') ?></th>
            <td><?= h($user->DDCHOSEN) ?></td>
        </tr>
        <tr>
            <th><?= __('DDFINAL') ?></th>
            <td><?= h($user->DDFINAL) ?></td>
        </tr>
        <tr>
            <th><?= __('D1') ?></th>
            <td><?= h($user->D1) ?></td>
        </tr>
        <tr>
            <th><?= __('D2') ?></th>
            <td><?= h($user->D2) ?></td>
        </tr>
        <tr>
            <th><?= __('D3') ?></th>
            <td><?= h($user->D3) ?></td>
        </tr>
        <tr>
            <th><?= __('D4') ?></th>
            <td><?= h($user->D4) ?></td>
        </tr>
        <tr>
            <th><?= __('DCHOSEN') ?></th>
            <td><?= h($user->DCHOSEN) ?></td>
        </tr>
        <tr>
            <th><?= __('DFINAL') ?></th>
            <td><?= h($user->DFINAL) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB1') ?></th>
            <td><?= h($user->LAB1) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB2') ?></th>
            <td><?= h($user->LAB2) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB3') ?></th>
            <td><?= h($user->LAB3) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB4') ?></th>
            <td><?= h($user->LAB4) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB5') ?></th>
            <td><?= h($user->LAB5) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB6') ?></th>
            <td><?= h($user->LAB6) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB7') ?></th>
            <td><?= h($user->LAB7) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB8') ?></th>
            <td><?= h($user->LAB8) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB9') ?></th>
            <td><?= h($user->LAB9) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB10') ?></th>
            <td><?= h($user->LAB10) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB11') ?></th>
            <td><?= h($user->LAB11) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB12') ?></th>
            <td><?= h($user->LAB12) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB13') ?></th>
            <td><?= h($user->LAB13) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB14') ?></th>
            <td><?= h($user->LAB14) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB15') ?></th>
            <td><?= h($user->LAB15) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB16') ?></th>
            <td><?= h($user->LAB16) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB17') ?></th>
            <td><?= h($user->LAB17) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB18') ?></th>
            <td><?= h($user->LAB18) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB19') ?></th>
            <td><?= h($user->LAB19) ?></td>
        </tr>
        <tr>
            <th><?= __('LAB20') ?></th>
            <td><?= h($user->LAB20) ?></td>
        </tr>
        <tr>
            <th><?= __('MC1') ?></th>
            <td><?= h($user->MC1) ?></td>
        </tr>
        <tr>
            <th><?= __('MC2') ?></th>
            <td><?= h($user->MC2) ?></td>
        </tr>
        <tr>
            <th><?= __('MC3') ?></th>
            <td><?= h($user->MC3) ?></td>
        </tr>
        <tr>
            <th><?= __('MC4') ?></th>
            <td><?= h($user->MC4) ?></td>
        </tr>
        <tr>
            <th><?= __('MC5') ?></th>
            <td><?= h($user->MC5) ?></td>
        </tr>
        <tr>
            <th><?= __('MC6') ?></th>
            <td><?= h($user->MC6) ?></td>
        </tr>
        <tr>
            <th><?= __('MC7') ?></th>
            <td><?= h($user->MC7) ?></td>
        </tr>
        <tr>
            <th><?= __('MC8') ?></th>
            <td><?= h($user->MC8) ?></td>
        </tr>
        <tr>
            <th><?= __('MC9') ?></th>
            <td><?= h($user->MC9) ?></td>
        </tr>
        <tr>
            <th><?= __('MC10') ?></th>
            <td><?= h($user->MC10) ?></td>
        </tr>
        <tr>
            <th><?= __('MC11') ?></th>
            <td><?= h($user->MC11) ?></td>
        </tr>
        <tr>
            <th><?= __('MC12') ?></th>
            <td><?= h($user->MC12) ?></td>
        </tr>
        <tr>
            <th><?= __('MM1') ?></th>
            <td><?= h($user->MM1) ?></td>
        </tr>
        <tr>
            <th><?= __('MM2') ?></th>
            <td><?= h($user->MM2) ?></td>
        </tr>
        <tr>
            <th><?= __('MM3') ?></th>
            <td><?= h($user->MM3) ?></td>
        </tr>
        <tr>
            <th><?= __('MM4') ?></th>
            <td><?= h($user->MM4) ?></td>
        </tr>
        <tr>
            <th><?= __('MM5') ?></th>
            <td><?= h($user->MM5) ?></td>
        </tr>
        <tr>
            <th><?= __('MM6') ?></th>
            <td><?= h($user->MM6) ?></td>
        </tr>
        <tr>
            <th><?= __('MM7') ?></th>
            <td><?= h($user->MM7) ?></td>
        </tr>
        <tr>
            <th><?= __('MM8') ?></th>
            <td><?= h($user->MM8) ?></td>
        </tr>
        <tr>
            <th><?= __('MM9') ?></th>
            <td><?= h($user->MM9) ?></td>
        </tr>
        <tr>
            <th><?= __('MM10') ?></th>
            <td><?= h($user->MM10) ?></td>
        </tr>
        <tr>
            <th><?= __('MM11') ?></th>
            <td><?= h($user->MM11) ?></td>
        </tr>
        <tr>
            <th><?= __('MM12') ?></th>
            <td><?= h($user->MM12) ?></td>
        </tr>
        <tr>
            <th><?= __('MM13') ?></th>
            <td><?= h($user->MM13) ?></td>
        </tr>
        <tr>
            <th><?= __('MR1') ?></th>
            <td><?= h($user->MR1) ?></td>
        </tr>
        <tr>
            <th><?= __('MR2') ?></th>
            <td><?= h($user->MR2) ?></td>
        </tr>
        <tr>
            <th><?= __('MR3') ?></th>
            <td><?= h($user->MR3) ?></td>
        </tr>
        <tr>
            <th><?= __('MR4') ?></th>
            <td><?= h($user->MR4) ?></td>
        </tr>
        <tr>
            <th><?= __('MR5') ?></th>
            <td><?= h($user->MR5) ?></td>
        </tr>
        <tr>
            <th><?= __('MR6') ?></th>
            <td><?= h($user->MR6) ?></td>
        </tr>
        <tr>
            <th><?= __('MR7') ?></th>
            <td><?= h($user->MR7) ?></td>
        </tr>
        <tr>
            <th><?= __('MR8') ?></th>
            <td><?= h($user->MR8) ?></td>
        </tr>
        <tr>
            <th><?= __('MR9') ?></th>
            <td><?= h($user->MR9) ?></td>
        </tr>
        <tr>
            <th><?= __('MR10') ?></th>
            <td><?= h($user->MR10) ?></td>
        </tr>
        <tr>
            <th><?= __('MR11') ?></th>
            <td><?= h($user->MR11) ?></td>
        </tr>
        <tr>
            <th><?= __('MR12') ?></th>
            <td><?= h($user->MR12) ?></td>
        </tr>
        <tr>
            <th><?= __('MR13') ?></th>
            <td><?= h($user->MR13) ?></td>
        </tr>
        <tr>
            <th><?= __('Mr Counter') ?></th>
            <td><?= h($user->mr_counter) ?></td>
        </tr>
        <tr>
            <th><?= __('B1') ?></th>
            <td><?= h($user->B1) ?></td>
        </tr>
        <tr>
            <th><?= __('B2') ?></th>
            <td><?= h($user->B2) ?></td>
        </tr>
        <tr>
            <th><?= __('B3') ?></th>
            <td><?= h($user->B3) ?></td>
        </tr>
        <tr>
            <th><?= __('B4') ?></th>
            <td><?= h($user->B4) ?></td>
        </tr>
        <tr>
            <th><?= __('B5') ?></th>
            <td><?= h($user->B5) ?></td>
        </tr>
        <tr>
            <th><?= __('B6') ?></th>
            <td><?= h($user->B6) ?></td>
        </tr>
        <tr>
            <th><?= __('B7') ?></th>
            <td><?= h($user->B7) ?></td>
        </tr>
        <tr>
            <th><?= __('B8') ?></th>
            <td><?= h($user->B8) ?></td>
        </tr>
        <tr>
            <th><?= __('B9') ?></th>
            <td><?= h($user->B9) ?></td>
        </tr>
        <tr>
            <th><?= __('B10') ?></th>
            <td><?= h($user->B10) ?></td>
        </tr>
        <tr>
            <th><?= __('B Counter') ?></th>
            <td><?= h($user->b_counter) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Admin') ?></th>
            <td><?= h($user->is_admin) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('All Cases Id') ?></th>
            <td><?= $this->Number->format($user->all_cases_id) ?></td>
        </tr>
        <tr>
            <th><?= __('HQASKED') ?></th>
            <td><?= $this->Number->format($user->HQASKED) ?></td>
        </tr>
        <tr>
            <th><?= __('LABSCHOSEN') ?></th>
            <td><?= $this->Number->format($user->LABSCHOSEN) ?></td>
        </tr>
        <tr>
            <th><?= __('Mc Counter') ?></th>
            <td><?= $this->Number->format($user->mc_counter) ?></td>
        </tr>
        <tr>
            <th><?= __('Mm Counter') ?></th>
            <td><?= $this->Number->format($user->mm_counter) ?></td>
        </tr>
        <tr>
            <th><?= __('Complete') ?></th>
            <td><?= $this->Number->format($user->complete) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
</div>
