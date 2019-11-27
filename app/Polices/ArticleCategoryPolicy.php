<?php


namespace App\Polices;


use App\Article;
use App\User;

class ArticleCategoryPolicy
{
    public function store(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }
}
