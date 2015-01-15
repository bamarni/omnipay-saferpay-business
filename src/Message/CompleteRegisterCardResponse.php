<?php

namespace Bamarni\Omnipay\Saferpay\Business\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompleteRegisterCardResponse extends AbstractResponse
{
    protected $successful = false;

    public function __construct(RequestInterface $request, $response)
    {
        $body = $response->getBody(true);

        if (0 === strpos($body, 'OK:RESULT=0')) {
            $this->successful = true;
        }

        parent::__construct($request, $body);
    }

    public function isSuccessful()
    {
        return $this->successful;
    }
}