<?php

namespace Bamarni\Omnipay\Saferpay\Business;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    use Parameters;

    public function getName()
    {
        return 'Saferpay Business';
    }

    public function getDefaultParameters()
    {
        return array(
            'testMode' => false,
        );
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Bamarni\Omnipay\Saferpay\Business\Message\AuthorizeRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Bamarni\Omnipay\Saferpay\Business\Message\CompleteAuthorizeRequest', $parameters);
    }

    public function registerCard(array $parameters = array())
    {
        return $this->createRequest('\Bamarni\Omnipay\Saferpay\Business\Message\RegisterCardRequest', $parameters);
    }

    public function completeRegisterCard(array $parameters = array())
    {
        return $this->createRequest('\Bamarni\Omnipay\Saferpay\Business\Message\CompleteRegisterCardRequest', $parameters);
    }
}
