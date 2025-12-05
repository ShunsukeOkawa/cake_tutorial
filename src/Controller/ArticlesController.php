<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

use App\Controller\AppController;

class ArticlesController extends AppController
{
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // add および tags アクションは、常にログインしているユーザーに許可されます。
        if (in_array($action, ['add', 'tags', 'likeToArticle'])) {
            return true;
        }

        // 他のすべてのアクションにはスラッグが必要です。
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        // 記事が現在のユーザーに属していることを確認します。
        $article = $this->Articles->findBySlug($slug)->first();

        return $article->user_id === $user['id'];
    }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); 
        $this->loadComponent('RequestHandler'); 

        $this->loadModel('Likes');

        $this->Auth->allow(['tags']);
    }



    public function index()
    {
        $this->loadComponent('Paginator');
        $articlesQuery = $this->Articles->find()
                ->select([
                    'Articles.id',
                    'Articles.title',
                    'Articles.slug',
                    'Articles.created',
                    'like_count' => $this->Likes->find()->func()->count('Likes.id')
                ])
                ->leftJoinWith('Likes')
                ->group(['Articles.id']);

        $articles = $this->Paginator->paginate($articlesQuery);

        $this->set(compact('articles'));        

    }

    public function view($slug = null)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $userId = $this->Auth->user('id');

        // いいね数
        $likeCount = $this->Likes->find()
            ->where(['article_id' => $article->id])
            ->count();

        // 自分がいいね済みかどうか
        $isLike = false;
        if ($userId) {
            $isLike = $this->Likes->exists([
                'user_id'    => $userId,
                'article_id' => $article->id,
            ]);
        }

        $this->set(compact('article', 'isLike', 'likeCount'));
    }

    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            // user_id の決め打ちは一時的なもので、あとで認証を構築する際に削除されます。
            $article->user_id = $this->Auth->user('id');

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('「{0}」が追加されました。', $article->title));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('記事の追加に失敗しました。'));
        }
        // タグのリストを取得
        $tags = $this->Articles->Tags->find('list');

        // ビューコンテキストに tags をセット
        $this->set('tags', $tags);

        $this->set('article', $article);
    }

    public function edit($slug)
    {
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain('Tags') // 関連づけられた Tags を読み込む
            ->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData(), [
                // 追加: user_id の更新を無効化
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('「{0}」の編集が保存されました。', $article->title));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('記事の編集に失敗しました。'));
        }

        // タグのリストを取得
        $tags = $this->Articles->Tags->find('list');

        // ビューコンテキストに tags をセット
        $this->set('tags', $tags);

        $this->set('article', $article);
    }

    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('「{0}」が削除されました。', $article->title));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function tags(...$tags)
    {
        // ArticlesTable を使用してタグ付きの記事を検索します。
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags
        ]);

        // 変数をビューテンプレートのコンテキストに渡します。
        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);
    }

    public function likeToArticle($articleId){
        $this->request->allowMethod(['post']);

        $userId = $this->Auth->user('id');
        if (!$userId) {
            return $this->response->withStatus(401);
        }

        // 「いいね」しているか確認
        $like = $this->Likes->find()
            ->where(['user_id' => $userId, 'article_id' => $articleId])
            ->first();

        if ($like) {
            $this->Likes->delete($like);
            $isLike = false;
        } else {
            $like = $this->Likes->newEntity([
                'user_id'    => $userId,
                'article_id' => $articleId,
            ]);
            $this->Likes->save($like);
            $isLike = true;
        }

        $likeCount = $this->Likes->find()
            ->where(['article_id' => $articleId])
            ->count();

        $this->set(compact('isLike', 'likeCount'));
        $this->set('_serialize', ['isLike', 'likeCount']);

    }
}