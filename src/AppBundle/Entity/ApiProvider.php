<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_providers")
 */
class ApiProvider
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(length=140) */
    protected $name;

    /** @ORM\OneToMany(targetEntity="ApiCredential", mappedBy="apiProvider") */
    protected $apiCredentials;

    public function __construct()
    {
        $this->devices = new ArrayCollection();
        $this->apiCredentials = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getApiCredentials()
    {
        return $this->apiCredentials;
    }

    /**
     * @param mixed $apiCredentials
     */
    public function setApiCredentials($apiCredentials)
    {
        $this->apiCredentials = $apiCredentials;
    }


}