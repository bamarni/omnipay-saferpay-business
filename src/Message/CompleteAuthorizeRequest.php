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
            'IBAN' => $this->getIban(),
        ];

        if ($card = $this->getCard()) {
            $data['PAN'] = $card->getNumber();
            $data['EXP'] = $card->getExpiryDate('my');
            $data['CVC'] = $card->getCvv();
        }

        return $data;
    }

    public function getIBAN()
    {
        return $this->getParameter('IBAN');
    }

    public function setIBAN($value)
    {
        return $this->setParameter('IBAN', $value);
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
