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

namespace Stagem\Statistic\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Popov\ZfcCore\Model\DomainAwareTrait;
use Popov\ZfcUser\Model\User;

/**
 * @ORM\Entity(repositoryClass="Stagem\Statistic\Model\Repository\StatisticRepository")
 * @ORM\Table(name="statistic")
 */
class Statistic
{
    use DomainAwareTrait;

    const MNEMO = 'statistic';

    const TABLE = 'statistic';

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var DateTime
     * @ORM\Column(name="checkedAt", nullable=false, type="datetime")
     */
    private $checkedAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Popov\ZfcUser\Model\User")
     * @ORM\JoinColumn(name="userToGuessId", referencedColumnName="id", nullable=false)
     */
    private $userToGuess;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Popov\ZfcUser\Model\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return DateTime
     */
    public function getCheckedAt()
    {
        return $this->checkedAt;
    }

    /**
     * @param DateTime $checkedAt
     */
    public function setCheckedAt($checkedAt)
    {
        $this->checkedAt = $checkedAt;
    }

    /**
     * @return User
     */
    public function getUserToGuess()
    {
        return $this->userToGuess;
    }

    /**
     * @param User $userToGuess
     */
    public function setUserToGuess($userToGuess)
    {
        $this->userToGuess = $userToGuess;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



}