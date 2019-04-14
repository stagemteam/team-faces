<?php
/**
 * The MIT License (MIT)
 * Copyright (c) 2018 Stagem Team
 * This source file is subject to The MIT License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 *
 * @category Stagem
 * @package Stagem_Order
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\Statistic\Model\Repository;

use DateTime;
use Doctrine\ORM\QueryBuilder;
use Popov\ZfcCore\Model\Repository\EntityRepository;
use Popov\ZfcUser\Model\User;
use Stagem\Statistic\Model\Statistic;

class StatisticRepository extends EntityRepository
{
    protected $_alias = Statistic::MNEMO;

    protected $_userAlias = User::MNEMO;

    protected $userToPick = User::MNEMO;
//
//    protected $_marketplaceAlias = Marketplace::MNEMO;
//
//    protected $_customerAlias = Customer::MNEMO;
//
//    protected $_shipmentAlias = Shipment::MNEMO;
    /**
     * @param $startedAt
     * @param $endedAt
     * @param $user
     * @param $userToGuess
     * @return mixed
     */
    public function getGuessingUserStatistic($user, $startedAt, $endedAt)
    {
        $qb = $this->createQueryBuilder($this->_alias)
            ->leftJoin($this->_alias . '.user', $this->_userAlias);

        $qb->andWhere($qb->expr()->in($this->_userAlias . '.id', '?1'));

        $qb->andWhere($qb->expr()->gte($this->_alias . '.checkedAt', '?2'));
        $qb->andWhere($qb->expr()->lte($this->_alias . '.checkedAt', '?3'));

        $qb->setParameter(1, $user);
        $qb->setParameter(2, $startedAt);
        $qb->setParameter(3, $endedAt);
//            $qb->setParameters([
//                2 => $startedAt,
//                3 => $endedAt,
//            ]);
        //$qb->andWhere($qb->expr()->in($this->_userAlias . '.id', '?1'));




        return $qb->getQuery()->getResult();
    }

    public function getStatisticForUser($user, $guessingUser)
    {
        $qb = $this->createQueryBuilder($this->_alias)
            ->leftJoin($this->_alias . '.userToGuess', $this->_userAlias)
            ->leftJoin($this->_alias . '.userToPick', $this->_userAlias . '_pick')
            ->leftJoin($this->_alias . '.user', $this->_userAlias . '_guessing');

        $qb->andWhere($qb->expr()->in($this->_userAlias . '.id', '?1'));
        $qb->andWhere($qb->expr()->in($this->_userAlias . '_pick' . '.id', '?1'));
        $qb->andWhere($qb->expr()->in($this->_userAlias . '_guessing' . '.id', '?2'));

        $qb->setParameters([1 => $user, 2 => $guessingUser ]);

        return $qb->getQuery()->getResult();
    }

//    /**
//     * Get ordered orders by purchaseAt date
//     *
//     * @param Marketplace|null $marketplace
//     * @return QueryBuilder
//     */
//    public function getOrdersOrderedBy(Marketplace $marketplace = null)
//    {
//        $qb = $this->createQueryBuilder($this->_alias)
//            ->leftJoin($this->_alias . '.customer', $this->_customerAlias)
//            ->leftJoin($this->_alias . '.marketplace', $this->_marketplaceAlias)
//            ->orderBy('u.purchaseAt', 'DESC');
//
//        if ($marketplace) {
//            $qb->andWhere($qb->expr()->in($this->_marketplaceAlias . '.id', '?1'));
//            $qb->setParameter(1, $marketplace);
//        }
//
//        return $qb;
//    }
//
//    /**
//     * Get all orders for last day
//     *
//     * @param Marketplace $marketplace
//     * @return QueryBuilder
//     */
//    public function getOrdersForLastDay(Marketplace $marketplace)
//    {
//        $date = new DateTime('-1 days');
//        $qb = $this->createQueryBuilder($this->_alias)
//            ->leftJoin($this->_alias . '.customer', $this->_customerAlias)
//            ->leftJoin($this->_alias . '.marketplace', $this->_marketplaceAlias)
//            ->where(MarketOrder::MNEMO . '.purchaseAt' . ' >= ?1')
//            ->andWhere(MarketOrder::MNEMO . '.marketplace' . ' = ?2')
//            ->orderBy(MarketOrder::MNEMO . '.purchaseAt', 'DESC')
//            ->setParameters([1 => $date, 2 => $marketplace])
//        ;
//
//        return $qb;
//    }
//
//    /**
//     * Get all orders for day
//     *
//     * @param Marketplace $marketplace
//     * @param DateTime $date
//     * @return QueryBuilder
//     */
//    public function getOrdersForDay(Marketplace $marketplace, DateTime $date)
//    {
//        $startedAt = clone $date;
//        $endedAt = (clone $date)->setTime(23, 59, 59);
//        $startedAt->setTime(0, 0);
//
//        $qb = $this->createQueryBuilder($this->_alias)
//            ->leftJoin($this->_alias . '.customer', $this->_customerAlias)
//            ->leftJoin($this->_alias . '.marketplace', $this->_marketplaceAlias)
//            ->where(MarketOrder::MNEMO . '.purchaseAt' . ' >= ?1')
//            ->andWhere(MarketOrder::MNEMO . '.purchaseAt' . ' <= ?2')
//            ->andWhere(MarketOrder::MNEMO . '.marketplace' . ' = ?3')
//            ->orderBy(MarketOrder::MNEMO . '.purchaseAt', 'DESC')
//            ->setParameters([1 => $startedAt, 2 => $endedAt, 3 => $marketplace])
//        ;
//
//        return $qb;
//    }
//
//    /**
//     * Get all orders with pending status
//     *
//     * @param Marketplace $marketplace
//     * @return QueryBuilder
//     */
//    public function getOrdersWithPendingStatus(Marketplace $marketplace)
//    {
//        $qb = $this->createQueryBuilder($this->_alias)
//            ->leftJoin($this->_alias . '.customer', $this->_customerAlias)
//            ->leftJoin($this->_alias . '.marketplace', $this->_marketplaceAlias)
//            ->where(MarketOrder::MNEMO . '.status' . ' = ?1')
//            ->andWhere(MarketOrder::MNEMO . '.marketplace' . ' = ?2')
//            ->orderBy(MarketOrder::MNEMO . '.purchaseAt', 'DESC')
//            ->setParameters([1 => 'Pending', 2 => $marketplace])
//        ;
//
//        return $qb;
//    }
}