<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 18/04/2017
 * Time: 08:45
 */
class SensorType
{

    /**
     * @var $name string
     */
    private $name;

    /**
     * @var boolean $chart
     */
    private $chart;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return SensorType
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isChart(): bool
    {
        return $this->chart;
    }

    /**
     * @param boolean $chart
     * @return SensorType
     */
    public function setChart(bool $chart)
    {
        $this->chart = $chart;
        return $this;
    }



}