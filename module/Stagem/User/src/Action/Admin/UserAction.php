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
use Zend\Router\RouteMatch;
use Zend\View\Model\ViewModel;
use Stagem\ZfcAction\Page\AbstractAction;
use Zend\View\View;

/**
 * @package Stagem_Statistic
 */
class UserAction extends AbstractAction
{

    protected $bestsellerTable;

    protected $bestsellerGrid;

    /** @var StatisticService */
    protected $statisticService;


    public function __construct(
        StatisticService $statisticService
        /*BestsellerTable $bestsellerTable, BestsellerGrid $bestsellerGrid*/)
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
        return new ViewModel([]);

        /*$this->statisticService->userStatistic($this->user()->current());

        $data = [
            'label' => 'asd',
            'backgroundColor' => 'rgb(255, 99, 132)',
            'borderColor' => 'rgb(255, 99, 132)',
            'data' => [
                3,2,4,4,5,
            ],
        ];

        return new ViewModel([
            'dataset' => $data
        ]);*/
    }
}