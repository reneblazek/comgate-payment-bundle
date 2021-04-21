<?php

namespace Mufin\ComgateBundle\Helper;

interface RequestInterface
{
    /**
     * @return array
     */
    public function getData();


    /**
     * @return bool
     */
    public function isPost();


    /**
     * @return string
     */
    public function getEndPoint();


    /**
     * @return string
     */
    public function getResponseClass();

}