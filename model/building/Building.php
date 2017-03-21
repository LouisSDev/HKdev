<?php

/**
 * Created by PhpStorm.
 * User: Desazars
 * Date: 21/03/2017
 * Time: 09:14
 */
class Building
{
    /**
 * @var integer
 */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $adress;

    /**
     * @var string
     */
    private $user;

    /**
     * @var array
     */
    private $homes;

    /**
     * @return array
     */
    public function getHomes(): array
    {
        return $this->homes;
    }

    /**
     * @param array $homes
     */
    public function setHomes(array $homes)
    {
        $this->homes = $homes;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAdress(): string
    {
        return $this->adress;
    }

    /**
     * @param string $adress
     */
    public function setAdress(string $adress)
    {
        $this->adress = $adress;
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
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

}