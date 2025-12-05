<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag[]|\Cake\Collection\CollectionInterface $tags
 */
?>

<?= $this->element('sidebar') ?>

<div class="tags index large-9 medium-8 columns content">
    <h3><?= __('タグ一覧') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('タイトル') ?></th>
                <th scope="col"><?= $this->Paginator->sort('作成日') ?></th>
                <th scope="col"><?= $this->Paginator->sort('編集日') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?= $this->Number->format($tag->id) ?></td>
                <td><?= h($tag->title) ?></td>
                <td><?= h($tag->created->format('Y年m月d日 H:i')) ?></td>
                <td><?= h($tag->modified->format('Y年m月d日 H:i')) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $tag->id]) ?>
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $tag->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
