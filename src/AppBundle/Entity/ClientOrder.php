<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientOrder
 *
 * @ORM\Table(name="client_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientOrderRepository")
 */
class ClientOrder
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
     * @var int
     *
     * @ORM\Column(name="table_number", type="integer")
     */
    private $tableNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="customer_id", type="integer")
     */
    private $customerId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="datetime")
     */
    private $orderDate;


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
     * Set tableNumber
     *
     * @param integer $tableNumber
     *
     * @return ClientOrder
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

    /**
     * Set customerId
     *
     * @param integer $customerId
     *
     * @return ClientOrder
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     *
     * @return ClientOrder
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }
}

