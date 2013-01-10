<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Tests\Fixture;

class Document
{
    protected $reference;

    protected $tags;

    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function getReference()
    {
        return $this->reference;
    }

}
