<?php

namespace Bamarni\Omnipay\Saferpay\Business\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

class AuthorizeRequest extends BaseAbstractRequest
{
    public function getData()
    {
        return [
            'returnUrl' => $this->getReturnUrl(),
            'cancelUrl' => $this->getCancelUrl(),
        ];
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
