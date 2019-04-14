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

namespace Stagem\Picker\Action\Admin;

use DateTime;
use Popov\ZfcUser\Model\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Server\RequestHandlerInterface;
#use Psr\Http\Server\RequestHandlerInterface;
use Stagem\Picker\Service\PickerService;
use Stagem\Statistic\Model\Statistic;
use Stagem\Statistic\Service\StatisticService;
use Zend\Router\RouteMatch;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Stagem\ZfcAction\Page\AbstractAction;

/**
 * @package Stagem_Picker
 */
class PickAction extends AbstractAction
{
    /**
     * @var PickerService
     */
    protected $pickerService;

    /**
     * @var StatisticService
     */
    protected $statisticService;

    public function __construct(PickerService $pickerService, StatisticService $statisticService)
    {
        $this->pickerService = $pickerService;
        $this->statisticService = $statisticService;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request->withAttribute(ViewModel::class, $this->action($request)));
    }

    public function action(ServerRequestInterface $request)
    {
        if ($request->getMethod() == self::METHOD_POST) {
            $fields = $request->getParsedBody();
            /** @var User $guessed */
            $guessed = $this->pickerService->find($id = (int) $fields['guessed']);
            /** @var User $picked */
            $picked = $this->pickerService->find($id = (int) $fields['picked']);

            $statistic = $this->statisticService->getObjectModel();
            $statistic->setCheckedAt(new DateTime())
                ->setUser($this->user()->current())
                ->setUserToGuess($guessed)
                ->setUserToPick($picked)
            ;

            $code = 200;
            if ($guessed && $picked && ($guessed === $picked)) {
                $message = 'User successfully was guessed';
                $statistic->setStatus(Statistic::STATUS_SUCCESS);
            } else {
                $code = 400;
                $message = 'Guess of user is failed';
                $statistic->setStatus(Statistic::STATUS_FAIL);
            }

            $this->statisticService->getObjectManager()->flush();

            return new JsonModel(['message' => $message, 'code' => $code]);
        }

        //$users = $this->pickerService->getRandomUsers();

        //return new ViewModel(['users' => $users]);

        return new EmptyResponse();
    }
}