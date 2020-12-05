<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Baked\Table\PasswordResetsTable as BakedTable;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * {@inheritDoc}
 */
class PasswordResetsTable extends BakedTable
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
    }
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        parent::validationDefault($validator);
        $validator
            ->notEmpty('password', 'パスワードが入力されていません。')
            ->minLength('password', 8,  'パスワードは8文字以上で入力してください。')
            ->alphaNumeric('password', 'パスワードには半角英数字のみ使用できます。')
            ->add('password', 'AlphaNumericSymbols',[
                'rule' => function($value, $context) {
                    return preg_match('/\A(?=.*?[a-z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}+\z/i', $value) ? true : false;
                },
                'message' => 'パスワードは英文字・数字・記号をそれぞれ1文字以上、必ず含んでください。'
            ])
            ->sameAs('password', 'password_check', '確認用のパスワードと一致しません。'); 
        return $validator;
    }
}
