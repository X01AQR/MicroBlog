<?php


namespace App\Polices;


use App\Article;
use App\User;

class ArticlePolicy
{
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

}
