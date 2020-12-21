# 概要
CakePHP 4 の自己学習用リポジトリです。
https://github.com/mamy1326/cakephp4-study-playbook　とセットです。


## 環境構築

1. ローカルマシンに任意のディレクトリを作成

```
mkdir ~/cakephp4-study
cd ~/cakephp4-study
```

2. docker 環境構築リポジトリを clone

```
git clone git@github.com:mamy1326/cakephp4-study-playbook.git infrastructure
```

3. 当リポジトリを clone

```
git clone git@github.com:mamy1326/cakephp4-study.git backend
```

4. docker コンテナ起動

- コンテナ構築と起動

```
docker-compose up -d
(初回は多くのログが流れます)
```

- composer install

```
# コンテナに入る
docker exec -it docker-cakephp4_app_1 bash

# コンテナ内で composer install
composer install
```

5. アプリケーション起動

http://127.0.0.1:8080/

6. ログイン用テストアカウント作成

- DB コンテナに入る

```
docker exec -it docker-cakephp4_db_1 bash
```

- MySQL ログイン
    - PW: `secret`

```
mysql -umy_app  my_app -p
```

- users テーブル作成

```sql
CREATE TABLE `users` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `password` varchar(255) NOT NULL,
 `created` datetime NOT NULL,
 `modified` datetime NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
)
```

- テストユーザー作成
    - PW: `p@ssw0rd`

```sql
insert into users(
    username,
    email,
    password,
    created,
    modified
)
values(
    'test user',
    'test@example.com',
    '$2y$10$chRR/dnRQgyJ4gVlscsIc.aiDsFs1QUT/.AiCfPf.Rru5LixtAfP6',
    now(),
    now()
);
```

7. `config/app_local.php` の修正
    - host を `localhost` から `db` に修正

```php
    'Datasources' => [
        'default' => [
            'host' => 'db',
```

8. メールアドレス、PW でログイン

## 備考
パスワードリマインダーは実装中 (2020/12/21 時点)