<!-- File: src/Template/Articles/view.ctp -->

<?= $this->element('sidebar') ?>

<div class="tags view large-9 medium-8 columns content">

    <h1><?= h($article->title) ?></h1>
    <p><?= nl2br(h($article->body)) ?></p>
    <p>
        <small>作成日時: <?= $article->created->format('Y年m月d日 H:i') ?></small>
        <small style="margin-left: 1em;">いいね数：</small>
        <small id="likeCount"><?= $likeCount ?></small>
        <button
            id = "likeBtn"
            type="button"
            class="btn-good <?= $isLike ? 'is-liked' : '' ?>"
            onclick="likeArticle('<?= h($article->id) ?>')"
        >
            いいね
            <img src="<?= $this->Url->image('good.png') ?>" alt="" class="btn-good-icon">
        </button>
    </p>
    <p><?= $this->Html->link('編集', ['action' => 'edit', $article->slug]) ?></p>
    <p>
        <?= $this->Form->postLink(
            '削除',
            ['action' => 'delete', $article->slug],
            [
                'confirm' => __('「{0}」を削除してもよろしいですか？', $article->title),
                'class' => 'btn-danger'
            ]
        ) ?>
    </p>

</div>