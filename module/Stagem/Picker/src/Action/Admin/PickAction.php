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

use Popov\ZfcUser\Service\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Server\RequestHandlerInterface;
#use Psr\Http\Server\RequestHandlerInterface;
use Stagem\Picker\Service\PickerService;
use Zend\Router\RouteMatch;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Stagem\ZfcAction\Page\AbstractAction;
use Zend\View\View;

/**
 * @package Stagem_Picker
 */
class PickAction extends AbstractAction
{

    protected $pickerService;

    protected $bestsellerGrid;

    public function __construct(PickerService $pickerService/*, BestsellerGrid $bestsellerGrid*/)
    {
        $this->pickerService = $pickerService;
        //$this->bestsellerGrid = $bestsellerGrid;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request->withAttribute(ViewModel::class, $this->action($request)));
    }

    public function action(ServerRequestInterface $request)
    {
        if ($request->getMethod() == self::METHOD_POST) {
            $fields = $request->getParsedBody();
            $guessed = $this->pickerService->find($id = (int) $fields['guessed']);
            $picked = $this->pickerService->find($id = (int) $fields['picked']);


            $code = 200;
            if ($guessed && $picked && ($guessed === $picked)) {
                $message = 'User successfully was guessed';
                // success guess
            } else {
                $code = 400;
                $message = 'Guess of user is failed';
            }

            return new JsonModel(['message' => $message, 'code' => $code]);
            //$this->mainObjectService->saveMainObject($formObject);
            //$message = 'Something went wrong';
        }

        $users = $this->pickerService->getRandomUsers();

        return new ViewModel(['users' => $users]);
    }
}