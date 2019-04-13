<?php
/**
 * The MIT License (MIT)
 * Copyright (c) 2019 Serhii Popov
 * This source file is subject to The MIT License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 *
 * @category Stagem
 * @package Stagem_Picker
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\Picker\Service;

use Popov\ZfcCore\Service\DomainServiceAbstract;
use Popov\ZfcUser\Model\Repository\UserRepository;
use Popov\ZfcUser\Model\User;

/**
 * Class PickerService
 * @method UserRepository getRepository()
 */
class PickerService extends DomainServiceAbstract
{
    protected $entity = User::class;

    /**
     * @return User[]
     */
    public function getRandomUsers()
    {
        $max = 8;
        $qb = $this->getRepository()->getUsers();
        $qb->where($qb->expr()->in(User::MNEMO . '.id', '?1'));
        // Performance optimization
        $qb->setParameters([1 => [rand(1, $max), rand(0, $max), rand(0, $max), rand(0, $max), rand(0, $max), rand(0, $max)]])
            ->setMaxResults(3);

        return $qb->getQuery()->getResult();
    }
}