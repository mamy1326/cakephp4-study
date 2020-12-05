<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;

/**
 * PasswordReset Controller
 *
 * @property \App\Model\Table\PasswordResetTable $PasswordReset
 * @method \App\Model\Entity\PasswordReset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PasswordResetsController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        $this->Authentication->allowUnauthenticated(['reset']);
    }

    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Users');
    }

    public function reset()
    {
        $this->viewBuilder()->setLayout('reset');

        if (!$this->request->is('post')) {
            return;
        }

        $params = $this->request->getQuery();
        $email = $params['email'];
        $user = $this->users->find()
            ->where(['email ' => $email])
            ->first();

        if ($user) {
            $passwordResets = $this->PasswordResets->find()
                ->where(['email' => $email])
                ->first();
            if ($passwordResets){
                // expireを更新するために、すでにテーブルに登録されていたら削除する
                $this->PasswordResets->delete($passwordResets);
            }
        } else {
            // 未登録のメールアドレスの場合は、なにもせずに結果画面を表示
            return $this->redirect('accept');
        }

        // DB登録値
        $data['email'] = $email;
        $data['selector'] = bin2hex(random_bytes(8));
        $data['token'] = random_bytes(32);
        $data['expire'] = date("Y-m-d H:i:s",strtotime("1 day"));

        // パスワードリセット用URL生成
        $url = Router::url([
            'controller' => 'User',
            'action' => 'reset',
            '?' => ['selector' => $data['selector'], 'token' =>bin2hex($data['token'])],
        ], true);

        $password_reset = $this->PasswordResets->newEntity($data);
        $this->PasswordResets->save($password_reset);

        $mailer = new Mailer('default');
        $mailer->setFrom(['no-reply@ths-hanamaru.com'])
            ->setTo($email)
            ->setSubject('パスワード再発行のお知らせ')
            ->emailFormat('text')
            ->viewVars($url)
            ->viewBuilder()
                ->setTemplate('password_reset')
            ->deliver();

        return $this->redirect('accept');
    }
}
