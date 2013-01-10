<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Comparator;

use Doctrine\Common\Collections\ArrayCollection;

class Has extends AbstractComparator
{
    public function compare($object)
    {
        $exists = true;
        $value = null;

        // Check if we have an accessable property as part of an object
        if (is_object($object) && is_string($this->expected)) {
            $value = $this->_getPropertyOfObject($object);

        // Check if we have an element in an array
        } else if (is_array($object) && $this->expected) {
            $value = $this->_getElementFromArray($object);

        // Check if we have an element in a collection
        } else if ($object instanceof ArrayCollection && is_object($this->expected)) {
            return $object->contains($this->expected);
        }


        if (!isset($value) || is_null($value) || $value == '') {
            $exists = false;
        }
        return $exists;
    }

    private function _getPropertyOfObject($object)
    {
        $method = 'get' . ucfirst(trim($this->expected, '_'));

        if (method_exists($object, 'get' . $this->expected)) {
            return $object->$method();
        }  else {
            try {
                return $object->{$this->expected};
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    private function _getElementInArray($array)
    {
        return in_array($this->expected, $array);
    }
}
