<!-- File: src/Template/Articles/add.ctp -->

<?= $this->element('sidebar') ?>

<div class="form large-9 medium-8 columns content">
    <h1>記事の追加</h1>
    <?php
        echo $this->Form->create($article);
        // 今はユーザーを直接記述
        echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
        echo $this->Form->control('title', [
            'label' => 'タイトル',
        ]);
        echo $this->Form->control('body', [
            'rows' => '10',
            'label' => '本文',
        ]);
        echo $this->Form->control('tag_string', [
            'type' => 'text',
            'label' => 'タグ'
        ]);
        echo $this->Form->button(__('記事を保存'));
        echo $this->Form->end();

    ?>
    <form method="post" action="/articles/add">
</div>
