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

namespace Stagem\Picker\View\Helper;

use Exception;
use Zend\View\Helper\AbstractHelper;
use Stagem\Picker\Service\PickerService;
use Popov\ZfcUser\Model\User;

class PickerHelper extends AbstractHelper
{
    /**
     * @var PickerService
     */
    protected $pickerService;

    /**
     * @var User
     */
    protected $guessedUser;

    /**
     * @param PickerService $pickerService
     */
    public function __construct(PickerService $pickerService)
    {
        $this->pickerService = $pickerService;
    }

    public function getGuessedUser()
    {
        if (!$this->guessedUser) {
            $this->guessedUser = $this->pickerService->getRandomUser() ?: $this->pickerService->getObjectModel();
        }

        return $this->guessedUser;
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        try {
            $guessedUser = $this->getGuessedUser();
            $users = $this->pickerService->getRandomUsers($guessedUser);
            array_push($users, $this->getGuessedUser());
            shuffle($users);
        } catch (Exception $e) {
            $users = [];
        }

        return $users;
    }

    public function extra(User $user, $field)
    {
        $extra = json_decode($user->getPost(), true);

        return $extra[$field] ?? null;
    }
}