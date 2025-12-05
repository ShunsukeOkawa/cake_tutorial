<!-- File: src/Template/Articles/index.ctp -->

<?= $this->element('sidebar') ?>


<div class="index large-9 medium-8 columns content">
    <h1>記事一覧</h1>
    <table>
        <tr>
            <th>タイトル</th>
            <th>作成日時</th>
            <th>いいね数</th>
        </tr>

        <!-- ここで、$articles クエリーオブジェクトを繰り返して、記事の情報を出力します -->

        <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
            </td>
            <td>
                <?= $article->created->format('Y年m月d日 H:i') ?>
            </td>
            <td>
                <?= h($article->like_count) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

