<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiningTable
 *
 * @ORM\Table(name="dining_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiningTableRepository")
 */
class DiningTable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="table_number", type="integer")
     */
    private $tableNumber;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return DiningTable
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tableNumber
     *
     * @param integer $tableNumber
     *
     * @return DiningTable
     */
    public function setTableNumber($tableNumber)
    {
        $this->tableNumber = $tableNumber;

        return $this;
    }

    /**
     * Get tableNumber
     *
     * @return int
     */
    public function getTableNumber()
    {
        return $this->tableNumber;
    }
}

