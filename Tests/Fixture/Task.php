<?php
/**
 * Newbridge Green
 * User: jsutherland
 */


namespace NewbridgeGreen\RulesBundle\Tests\Fixture;

/**
 *
 */
class Task
{
    /** @var bool */
    protected $closed = true;

    /** @var \DateTime */
    protected $dueDate;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $details;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->dueDate = isset($data['dueDate']) ? $data['dueDate'] : new \DateTime;
    }

    /**
     * @param boolean $closed
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;
    }

    /**
     * @return boolean
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * @param $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param DateTime $dueDate
     */
    public function setDueDate(\DateTime $dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}
