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
 * @ORM\Table(name="user_statistic")
 */
class Statistic
{
    use DomainAwareTrait;

    const MNEMO = 'statistic';

    const TABLE = 'user_statistic';

    const STATUS_SUCCESS = 1;

    const STATUS_FAIL = 0;

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
     * User who we should to guess
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="Popov\ZfcUser\Model\User")
     * @ORM\JoinColumn(name="userToGuessId", referencedColumnName="id", nullable=true)
     */
    private $userToGuess;

    /**
     * User who we pick up
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="Popov\ZfcUser\Model\User")
     * @ORM\JoinColumn(name="userToPickId", referencedColumnName="id", nullable=true)
     */
    private $userToPick;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Popov\ZfcUser\Model\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Statistic
     */
    public function setId(int $id): Statistic
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Statistic
     */
    public function setStatus(string $status): Statistic
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCheckedAt(): DateTime
    {
        return $this->checkedAt;
    }

    /**
     * @param DateTime $checkedAt
     * @return Statistic
     */
    public function setCheckedAt(DateTime $checkedAt): Statistic
    {
        $this->checkedAt = $checkedAt;

        return $this;
    }

    /**
     * @return User
     */
    public function getUserToGuess(): User
    {
        return $this->userToGuess;
    }

    /**
     * User who we should to guess
     *
     * @param User $userToGuess
     * @return Statistic
     */
    public function setUserToGuess(User $userToGuess = null): Statistic
    {
        $this->userToGuess = $userToGuess;

        return $this;
    }

    /**
     * @return User
     */
    public function getUserToPick(): User
    {
        return $this->userToPick;
    }

    /**
     * @param User $userToPick
     * @return Statistic
     */
    public function setUserToPick(User $userToPick =  null): Statistic
    {
        $this->userToPick = $userToPick;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Statistic
     */
    public function setUser(User $user): Statistic
    {
        $this->user = $user;

        return $this;
    }
}