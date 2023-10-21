<?php

namespace Omnipay\Transfermovil;

class PaymentAPIGateway extends BaseGateway
{
    public function getName()
    {
        return 'PaymentAPIGateway';
    }

    public function setDemoMode($value)
    {
        return $this->setParameter('demo_mode', $value);
    }

    public function getDemoMode()
    {
        return $this->getParameter('demo_mode');
    }

    public function SendPayOrderRequest(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Transfermovil\UseCases\Commands\PayOrder\PayOrderRequest', $parameters);
    }

    public function GetPaymentOrderStatus(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Transfermovil\UseCases\Queries\GetOrderStatus\GetOrderStatusRequest', $parameters);
    }

    public function requestBalance(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Transfermovil\Message\RequestBalance', $parameters);
    }

    public function requestTransactions(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Transfermovil\Message\RequestTransactions', $parameters);
    }

    public function requestTransaction(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Transfermovil\Message\RequestTransaction', $parameters);
    }

    public function requestCreateInvoice(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Transfermovil\Message\RequestCreateInvoice', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Transfermovil\Message\RequestCreateInvoice', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Transfermovil\Message\RequestCreateInvoice', $parameters);
    }

}
