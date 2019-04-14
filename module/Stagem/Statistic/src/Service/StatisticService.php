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

namespace Stagem\Statistic\Service;

use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Popov\ZfcCore\Service\DomainServiceAbstract;
use Popov\ZfcUser\Model\User;
use Stagem\Order\Model\Repository\StatisticRepository;
use Stagem\Statistic\Model\Statistic;

/**
 * @method StatisticRepository getRepository()
 * @method EntityManager getObjectManager()
 */
class StatisticService extends DomainServiceAbstract
{
    protected $entity = Statistic::class;

//    public function getOrders($marketplace = null)
//    {
//        return $this->getRepository()->getOrders($marketplace);
//    }

    /**
     * This method changes order status after parsing in order to know
     * what order was parsed the last in unusual situations.
     *
     * @param $userId
     */
    public function userStatistic($user)
    {
        //we will get last 30 days
        $endedAt = new DateTime('now');
        $startedAt = new DateTime('-30 days');
        $data = $this->getRepository()->getStatisticForUser($startedAt, $endedAt, $user);

        return $data;
    }

    public function userDashboardData($data)
    {
        $statisticDashboard = [
            'total' => 0,
            'successful' => 0,
            'failed' => 0,
            'involvementRate' => 0.0,
        ];
        $statisticDashboard ['total'] = count($data);
        foreach ($data as $item) {
            $statisticDashboard ['successful'] += $item->getStatus();
            $statisticDashboard ['failed'] += $item->getStatus();
        }
        $statisticDashboard['involvementRate'] =
            $statisticDashboard ['successful'] / $statisticDashboard ['total'] * 100;

        return $statisticDashboard;
    }

    public function getAllUsers()
    {
        $data = $this->getObjectManager()->getRepository(User::class)->findAll();
        return $data;
    }
}