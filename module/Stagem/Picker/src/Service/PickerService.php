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
use Popov\ZfcUser\Helper\UserHelper;
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
     * @var UserHelper
     */
    protected $userHelper;

    public function __construct(UserHelper $userHelper)
    {
        $this->userHelper = $userHelper;
    }

    /**
     * @return User[]
     */
    public function getRandomUsers()
    {
        $max = 152;
        $qb = $this->getRepository()->getUsers();
        $qb->andWhere($qb->expr()->in(User::MNEMO . '.id', '?1'));
        $qb->andWhere($qb->expr()->notIn(User::MNEMO . '.id', '?2'));
        // Performance optimization
        $qb->setParameters([
            1 => [rand(1, $max), rand(0, $max), rand(0, $max), rand(0, $max), rand(0, $max), rand(0, $max)],
            2 => $this->userHelper->current()
        ])
            ->setMaxResults(3);

        return $qb->getQuery()->getResult();
    }
}