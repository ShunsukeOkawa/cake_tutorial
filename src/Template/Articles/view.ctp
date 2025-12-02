<!-- File: src/Template/Articles/view.ctp -->
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('記事の一覧'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('タグの一覧'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('タグの追加'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>

<div class="tags view large-9 medium-8 columns content">

    <h1><?= h($article->title) ?></h1>
    <p><?= h($article->body) ?></p>
    <p><small>作成日時: <?= $article->created->format(DATE_RFC850) ?></small></p>
    <p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>

</div>