<?php

namespace Bamarni\Omnipay\Saferpay\Business\Message;

use Bamarni\Omnipay\Saferpay\Business\Parameters;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    use Parameters;

    public function send()
    {
        $url = $this->getEndpoint().'?'.http_build_query($this->getData());

        $httpResponse = $this->httpClient->get($url)->send();

        return $this->response = $this->createResponse($httpResponse);
    }

    public function sendData($data)
    {
        throw new \BadMethodCallException('This method is unimplemented');
    }

    abstract protected function getEndpoint();

    abstract protected function createResponse($response);
}
