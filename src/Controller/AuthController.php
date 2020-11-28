<?php
declare(strict_types=1);

namespace App\Controller;

require_once __DIR__ . '/../../vendor/autoload.php';

use Cake\Event\EventInterface;
use Cake\Routing\Router;

class AuthController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        $this->Authentication->allowUnauthenticated(['loginView']);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function loginView()
    {
        // ログイン用の画面をLayoutで使用
        $this->viewBuilder()->setLayout('login_view');

        $result = $this->Authentication->getResult();

        // 認証成功
        if ($result->isValid()) {
//            $target = $this->Authentication->getLoginRedirect() ?? '/home';
            $refererUrl = $this->Authentication->getLoginRedirect();
            $refererUrl = '/';
            return $this->redirect($refererUrl);
        }
        // ログインできなかった場合
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Email または パスワードが違います');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
    }
}
