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
 * @package Popov_<package>
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\Picker\View\Helper;

use Stagem\Picker\Service\PickerService;
use Zend\View\Helper\AbstractHelper;
use Popov\Simpler\SimplerHelper;
use Popov\ZfcUser\Helper\UserHelper as BaseUserHelper;
use Popov\ZfcUser\Model\User;

class PickerHelper extends AbstractHelper
{
    /**
     * @var PickerService
     */
    protected $pickerService;

    /**
     * PickerHelper constructor.
     *
     * @param PickerService $pickerService
     */
    public function __construct(PickerService $pickerService)
    {
        $this->pickerService = $pickerService;
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->pickerService->getRandomUsers();
    }

    public function extra(User $user, $field)
    {
        $extra = json_decode($user->getPost(), true);

        return $extra[$field] ?? null;
    }

}