<?php

namespace Bamarni\Omnipay\Saferpay\Business\Message;

class CompleteAuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [
            'ACCOUNTID' => $this->getAccountId(),
            'spPassword' => $this->getSpPassword(),
            'AMOUNT' => $this->getAmountInteger(),
            'CURRENCY' => $this->getCurrency(),
            'CARDREFID' => 'simplesurance',
        ];

        return $data;
    }

    protected function getEndpoint()
    {
        return 'https://www.saferpay.com/hosting/execute.asp';
    }

    protected function createResponse($response)
    {
        return new CompleteAuthorizeResponse($this, $response);
    }
}
