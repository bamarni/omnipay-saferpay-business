<?php

namespace Bamarni\Omnipay\Saferpay\Business\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class CompleteAuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('accountId', 'spPassword', 'amount');

        $data = [
            'ACCOUNTID' => $this->getAccountId(),
            'spPassword' => $this->getSpPassword(),
            'AMOUNT' => $this->getAmountInteger(),
            'CURRENCY' => $this->getCurrency(),
            'NAME' => $this->getCardHolderName(),
            'IBAN' => $this->getIban(),
        ];

        if ($card = $this->getCard()) {
            $data['PAN'] = $card->getNumber();
            $data['EXP'] = $card->getExpiryDate('my');
            $data['CVC'] = $card->getCvv();
        } elseif (!$data['IBAN']) {
            $this->validate('bankCode', 'bankAccountNumber');

            $data['TRACK2'] = ';59'.$this->getBankCode().'='.$this->getBankAccountNumber();
        }

        if (!$card && !$data['IBAN'] && !$data['TRACK2']) {
            throw new InvalidRequestException(
                'Either a "card", "IBAN" or a "bank code"/"bank account number" pair is required'
            );
        }

        return $data;
    }

    public function getCardHolderName()
    {
        return $this->getParameter('cardHolderName');
    }

    public function setCardHolderName($value)
    {
        return $this->setParameter('cardHolderName', htmlspecialchars($value));
    }

    public function getIBAN()
    {
        return $this->getParameter('IBAN');
    }

    public function setIBAN($value)
    {
        return $this->setParameter('IBAN', $value);
    }

    public function getBankCode()
    {
        return $this->getParameter('bankCode');
    }

    public function setBankCode($value)
    {
        return $this->setParameter('bankCode', $value);
    }

    public function getBankAccountNumber()
    {
        return $this->getParameter('bankAccountNumber');
    }

    public function setBankAccountNumber($value)
    {
        return $this->setParameter('bankAccountNumber', $value);
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
