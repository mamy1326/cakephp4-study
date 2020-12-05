<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Baked\Entity\PasswordReset as BakedEntity;

/**
 * {@inheritDoc}
 */
class PasswordReset extends BakedEntity
{
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }

/*     protected function _setToken($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }
 */
}
