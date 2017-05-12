<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 12/05/2017
 * Time: 20:41
 */
class ApiResponse
{
    private $code;

    private $error;

    private $content;

    /**
     * ApiResponse constructor.
     * @param $code
     * @param $error
     * @param $content
     */
    public function __construct($code,  $content, $error = false)
    {
        $this->code = $code;
        $this->error = $error;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return boolean
     */
    public function isError(): bool
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }


}