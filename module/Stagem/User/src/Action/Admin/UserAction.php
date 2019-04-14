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
 * @package Stagem_Amazon
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\User\Action\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Server\RequestHandlerInterface;
#use Psr\Http\Server\RequestHandlerInterface;
use Stagem\Statistic\Service\StatisticService;
use Zend\View\Model\ViewModel;
use Stagem\ZfcAction\Page\AbstractAction;

/**
 * @package Stagem_Statistic
 */
class UserAction extends AbstractAction
{
    protected $bestsellerTable;

    protected $bestsellerGrid;

    /** @var StatisticService */
    protected $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
        //$this->bestsellerTable = $bestsellerTable;
        //$this->bestsellerGrid = $bestsellerGrid;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request->withAttribute(ViewModel::class, $this->action($request)));
    }

    public function action(ServerRequestInterface $request)
    {
        $data = $this->statisticService->guessingUserStatistic($this->user()->current());

        $labels = [];
        foreach ($data as $key => $item){
            $labels [$item->getCheckedAt()->format('Y-m-d')][] = $item;
        }

        $dataSet = [
            'labels' => [],
            'data' => []
        ];

        foreach ($labels as $key => $label){
            $forDay = 0;
            foreach ($label as $item){
                $forDay += $item->getStatus();
            }
            $dataSet['labels'][] = $key;
            $dataSet['data'][] = $forDay/count($label)*100;
        }

        $dashboardData =$this->statisticService->userDashboardData($data);

        //------------------------------------------------------------------
        $data = [];
        //$data = $this->statisticService->userStatistic($this->user()->current());
        //$dashboardData =$this->statisticService->userDashboardData($data);
        $users = $this->statisticService->getAllUsers();
        $usersByOffice = [];
        foreach ($users as $user) {
            if (!empty($user->getPost())) {
                $post = json_decode($user->getPost(), true);
                //we don't need date filtering, so add "false"
                $userStat = $this->statisticService->userStatistic($user, $this->user()->current());
                $status = empty($userStat) ? 0 : 1;

                $userArr = [
                    'photo' => $status ? $user->getPhoto() : '/img/mask.svg',
                    'name' => $user->getName(),
                    'status' => $status
                ];
                $usersByOffice[str_replace(' ', '', strstr($post['project_group_title'], ' '))][] = $userArr;
            }
        }
        //------------------------------------------------------------------


        return new ViewModel([
            'dataset' => $dataSet,
            'dashboard' => $dashboardData,
            'usersByOffice' => $usersByOffice,

        ]);
    }
}