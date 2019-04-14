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
        return end($this->getRandomUsers(null, 1));
    }

    /**
     * Ger random users with performance optimization
     *
     * @param User $guested
     * @param int $n Number of random users
     * @return User[]
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getRandomUsers(User $guested = null, $n = 2)
    {
        $userRepository = $this->getRepository();
        // Get count of total rows

        $qbCounter = $userRepository->getUsers()->select('COUNT(' . User::MNEMO . '.id)');
        $qbCounter->andWhere($qbCounter->expr()->isNotNull(User::MNEMO . '.gender'));

        $qb = $userRepository->getUsers();
        if ($guested) {
            $qb->andWhere($qb->expr()->eq(User::MNEMO . '.gender', '?2'));
            $qb->setParameter(2, $guested->getGender());

            $qb->andWhere($qb->expr()->notIn(User::MNEMO . '.id', '?3'));
            $qb->setParameter(3, $guested);

            // Counter
            $qbCounter->andWhere($qb->expr()->eq(User::MNEMO . '.gender', '?2'));
            $qbCounter->setParameter(2, $guested->getGender());

            $qbCounter->andWhere($qbCounter->expr()->notIn(User::MNEMO . '.id', '?3'));
            $qbCounter->setParameter(3, $guested);
        }

        $num = $qbCounter->getQuery()->getSingleScalarResult();

        $offset = max(0, rand(0, $num - $n - 1));


        $qb->andWhere($qb->expr()->isNotNull(User::MNEMO . '.gender'));
        $qb->andWhere($qb->expr()->notIn(User::MNEMO . '.id', '?1'));
        $qb->setParameter(1, $this->userHelper->current())
            ->setMaxResults($n)
            ->setFirstResult($offset);



        return $qb->getQuery()->getResult();
    }
}