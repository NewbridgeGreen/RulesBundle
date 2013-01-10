<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Rule;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Condition
{

    /**
     * @var mixed
     */
    protected $target;

    /** @MongoDB\Field(type="string", name="target") */
    protected $targetClassName;

    /**
     * @var string
     * @MongoDB\String
     */
    protected $property;

    /**
     * @var Comparable
     */
    protected $comparator;

    /** @MongoDB\Field(type="string", name="comparator") */
    protected $comparatorClassName;

    /**
     * @var mixed
     * @MongoDB\Hash
     */
    protected $expected;

    /*public function __construct($config = null)
    {
        if ($config['com'])
        $this->setComparator($comparator);
        $this->setExpected($expected);
    } */

    /**
     * @param $comparator
     * @return Condition
     */
    public function setComparator($comparator)
    {
        if (is_object($comparator)) {
            $this->comparatorClassName = get_class($comparator);
        }
        $this->comparator = $comparator;
        $this->expected = $comparator->getExpected();
        return $this;
    }

    /**
     * @return Comparable
     */
    public function getComparator()
    {
        return $this->comparator;
    }

    public function getComparatorClassName()
    {
        return $this->comparatorClassName;
    }

    /**
     * @param string $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param $target
     * @return Condition
     */
    public function setTarget($target)
    {
        if (is_object($target)) {
            $this->targetClassName = get_class($target);
        }
        $this->target = $target;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    public function getTargetClassName()
    {
        return $this->targetClassName;
    }

    /**
     * @param $expected
     * @return Condition
     */
    public function setExpected($expected)
    {
        $this->expected = $expected;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpected()
    {
        return $this->expected;
    }

    /**
     * @return mixed
     */
    public function evaluate($object)
    {
        $value = $this->_getValue($object);
        if ($this->comparator === null && $this->expected) {
            $this->comparator = new $this->comparatorClassName($this->expected);
        }
        return $this->comparator->compare($value);
    }

    /**
     * @return mixed
     * @throws \BadMethodCallException
     */
    private function _getValue($object)
    {
        $method = 'get' . ucfirst(trim($this->property, '_'));

        if (method_exists($object, 'get' . $this->property)) {
            return $object->$method();
        }  else {
            throw new \BadMethodCallException('Method does not exist. Check your target and property values');
        }
    }
}