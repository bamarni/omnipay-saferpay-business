<?php

namespace Bamarni\Omnipay\Saferpay\Business\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class AuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $redirectUrl;

    public function isSuccessful()
    {
        return true;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->request->getData()['redirectUrl'];
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return null;
    }
}