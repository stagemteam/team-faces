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
     * Get one random user
     *
     * @return User[]
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getRandomUser()
    {
        return $this->getRandomUsers(null, 1);
    }

    /**
     * Ger random users with performance optimization
     *
     * @param User $guested
     * @param int $n Number of random users
     * @return User[]
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getRandomUsers($guested, $n = 3)
    {
        $userRepository = $this->getRepository();
        // Get count of total rows
        //$num = $userRepository->getUsers()->select('COUNT(' . User::MNEMO . '.id)')->getQuery()->getSingleScalarResult();
        $num = 27;
        $offset = max(0, rand(0, $num - $n - 1));

        $qb = $userRepository->getUsers();
        $qb->andWhere($qb->expr()->eq(User::MNEMO . '.gender', '?1'));
        $qb->andWhere($qb->expr()->in(User::MNEMO . '.id', '?1'));
        $qb->andWhere($qb->expr()->notIn(User::MNEMO . '.id', '?2'));
        $qb->setParameters([1 => $guested->getG1 => $guested, 2 => $this->userHelper->current()])
            ->setMaxResults(3)
            ->setFirstResult($offset);

        return $qb->getQuery()->getResult();
    }
}