<!-- File: src/Template/Element/sidebar.ctp -->

<nav class="sidebar large-3 medium-4 columns" id="actions-sidebar">
    <div class="sidebar-title">メニュー</div>

    <div class="accordion">

        <div class="accordion-section is-open">
            <button type="button" class="accordion-header">記事</button>
            <ul class="accordion-body">
                <li><?= $this->Html->link(__('記事の一覧'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('記事の追加'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
            </ul>
        </div>

        <div class="accordion-section is-open">
            <button type="button" class="accordion-header">タグ</button>
            <ul class="accordion-body">
                <li><?= $this->Html->link(__('タグの一覧'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('タグの追加'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
            </ul>
        </div>

        <div class="accordion-section is-open">
            <button type="button" class="accordion-header">ユーザー</button>
            <ul class="accordion-body">
                <li><?= $this->Html->link(__('ユーザー一覧'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('ユーザー追加'), ['controller' => 'Users', 'action' => 'add']) ?></li>
            </ul>
        </div>
    </div>

    <div class="sidebar-logout">
        <?= $this->Html->link(__('ログアウト'), ['controller' => 'Users', 'action' => 'logout']) ?>
    </div>
</nav>
