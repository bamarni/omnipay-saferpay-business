<?php

namespace Bamarni\Omnipay\Saferpay\Business\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

class AuthorizeRequest extends BaseAbstractRequest
{
    public function getData()
    {
        return [
            'redirectUrl' => $this->getRedirectUrl() ?: $this->getReturnUrl(),
        ];
    }

    public function getRedirectUrl()
    {
        return $this->getParameter('redirectUrl');
    }

    public function setRedirectUrl($value)
    {
        return $this->setParameter('redirectUrl', $value);
    }

    public function send()
    {
        return $this->response = new AuthorizeResponse($this, null);
    }

    public function sendData($data)
    {
        throw new \BadMethodCallException('This method is unimplemented');
    }
}
