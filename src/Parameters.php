<?php

namespace Bamarni\Omnipay\Saferpay\Business;

trait Parameters
{
    public function setAccountId($value)
    {
        $this->setParameter('accountId', $value);
    }

    public function getAccountId()
    {
        return $this->getParameter('accountId');
    }

    public function setSpPassword($value)
    {
        $this->setParameter('spPassword', $value);
    }

    public function getSpPassword()
    {
        return $this->getParameter('spPassword');
    }
}
