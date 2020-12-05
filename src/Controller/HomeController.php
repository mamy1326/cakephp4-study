<?php
declare(strict_types=1);

namespace App\Controller;

class HomeController extends AppController
{
    public function index()
    {
        $this->loadModel('Users');
        echo '<h1>1. Authentication コンポーネントで取得</h1>';
        $query = $this->Users->find();
        $user = $query
            ->select([
                'usernames' => $query->func()->group_concat(['username' => 'identifier']),
            ])
            ->toList();
        debug($user);
    
        echo '<h1>2. request で取得</h1>';
        $user = $this->request->getAttribute('identity');
        debug($user);
    
        echo '<a href="/users/logout">ログアウト</a>';
        exit;
    }
}