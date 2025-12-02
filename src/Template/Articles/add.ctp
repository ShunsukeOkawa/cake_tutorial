<!-- File: src/Template/Articles/add.ctp -->

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('記事の一覧'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('タグの一覧'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('タグの追加'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>

<div class="form large-9 medium-8 columns content">
    <h1>記事の追加</h1>
    <?php
        echo $this->Form->create($article);
        // 今はユーザーを直接記述
        echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
        echo $this->Form->control('title');
        echo $this->Form->control('body', ['rows' => '3']);
        echo $this->Form->control('tag_string', ['type' => 'text']);
        echo $this->Form->button(__('Save Article'));
        echo $this->Form->end();

    ?>
    <form method="post" action="/articles/add">
</div>
