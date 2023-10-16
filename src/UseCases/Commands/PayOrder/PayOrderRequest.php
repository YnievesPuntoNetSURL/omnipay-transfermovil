<?php
namespace Omnipay\Transfermovil\UseCases\Commands\PayOrder;

use Omnipay\Transfermovil\Message\AbstractRequestImp;

class PayOrderRequest extends AbstractRequestImp
{
    public function getData()
    {
        $this->validate('request_info');

        return [
            'service' => '/RestExternalPayment.svc',
            'endpoint' => '/payOrder',
            'data' => $this->getRequestInfo(),
        ];
    }

    public function setRequestInfo(PayOrderCommand $value)
    {
        return $this->setParameter('request_info', $value);
    }

    public function getRequestInfo() : PayOrderCommand
    {
        return $this->getParameter('request_info');
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }
}