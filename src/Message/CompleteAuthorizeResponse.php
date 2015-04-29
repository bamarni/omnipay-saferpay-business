<?php

namespace Bamarni\Omnipay\Saferpay\Business\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompleteAuthorizeResponse extends AbstractResponse
{
    protected $successful = false;

    public function __construct(RequestInterface $request, $response)
    {
        $body = $response->getBody(true);

        if (0 === strpos($body, 'OK:')) {
            $response->setBody(substr($body, 3));
            $data = $response->xml();
            $result = (string) $data->attributes()->RESULT;

            if ('0' == $result) {
                $this->successful = true;
            }
        }

        if (!$this->successful) {
            $data = $body;
        }

        parent::__construct($request, $data);
    }

    public function isSuccessful()
    {
        return $this->successful;
    }

    public function getTransactionReference()
    {
        if ($this->successful) {
            return (string) $this->data->attributes()->ID;
        }
    }

    public function getMessage()
    {
        $authMessage = [];

        if (preg_match('/AUTHMESSAGE="([^"]*)"/i', $this->data, $authMessage)) {
            return $authMessage[1];
        } else {
            return '';
        }
    }
}
