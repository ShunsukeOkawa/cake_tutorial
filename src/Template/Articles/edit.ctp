<!-- File: src/Template/Articles/edit.ctp -->

<?= $this->element('sidebar') ?>

<div class="form large-9 medium-8 columns content">

    <h1>記事の編集</h1>
    <?php
        echo $this->Form->create($article);
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
</div>