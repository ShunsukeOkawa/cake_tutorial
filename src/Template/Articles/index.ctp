<!-- File: src/Template/Articles/index.ctp -->

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('記事の追加'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('タグの一覧'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('タグの追加'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('ログアウト'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</nav>
<div class="index large-9 medium-8 columns content">
    <h1>記事一覧</h1>
    <?= $this->Html->link('記事の追加', ['action' => 'add']) ?>
    <table>
        <tr>
            <th>タイトル</th>
            <th>作成日時</th>
            <th>操作</th>
        </tr>

        <!-- ここで、$articles クエリーオブジェクトを繰り返して、記事の情報を出力します -->

        <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
            </td>
            <td>
                <?= $article->created->format(DATE_RFC850) ?>
            </td>
            <td>
                <?= $this->Html->link('編集', ['action' => 'edit', $article->slug]) ?>
                <?= $this->Form->postLink(
                    '削除',
                    ['action' => 'delete', $article->slug],
                    ['confirm' => '削除してもよろしいですか?'])
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

