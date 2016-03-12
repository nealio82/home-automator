<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_credentials")
 */
class ApiCredential
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(length=140) */
    protected $userName;

    /** @ORM\Column(length=40) */
    protected $accessToken;

    /**
     * @ORM\ManyToOne(targetEntity="ApiProvider", inversedBy="apiCredentials")
     * @ORM\JoinColumn(name="api_provider_id", referencedColumnName="id")
     */
    protected $apiProvider;


    /** @ORM\OneToMany(targetEntity="Device", mappedBy="apiCredential") */
    protected $devices;

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
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    public function getApiProvider()
    {
        return $this->apiProvider;
    }

    /**
     * @param mixed $apiProvider
     */
    public function setApiProvider($apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }

    /**
     * @return mixed
     */
    public function getDevices()
    {
        return $this->devices;
    }

    /**
     * @param mixed $devices
     */
    public function setDevices($devices)
    {
        $this->devices = $devices;
    }


}