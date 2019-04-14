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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Zend\View\Model\ViewModel;
use Stagem\ZfcAction\Page\AbstractAction;
use Stagem\Picker\Service\ImportService;


/**
 * @package Stagem_Picker
 */
class ImportAction extends AbstractAction
{
    /**
     * @var ImportService
     */
    protected $importService;

    /**
     * ImportAction constructor.
     *
     * @param ImportService $importService
     */
    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request->withAttribute(ViewModel::class, $this->action($request)));
    }

    public function action(ServerRequestInterface $request)
    {



        $file = file_get_contents('public/timebase.json', true);
        $userData = json_decode($file, true);

        $this->importService->import($userData);
        echo 1;

        /*$route = $request->getAttribute(RouteMatch::class);
        $select = $this->bestsellerTable->getLastMonthBestsellers();

        $this->bestsellerGrid->setCounter($this->bestsellerTable->getLastMonthDistinctCounter());
        $this->bestsellerGrid->init();
        $dataGrid = $this->bestsellerGrid->getDataGrid();
        $dataGrid->setUrl($this->url()->fromRoute($route->getMatchedRouteName(), $route->getParams()));
        $dataGrid->setDataSource($select, $this->bestsellerTable->getAdapter());
        $dataGrid->render();
        $dataGridVm = $dataGrid->getResponse();

        return $dataGridVm;*/

        return new ViewModel();
    }
}