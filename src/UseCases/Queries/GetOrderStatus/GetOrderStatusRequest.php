<?php
namespace Omnipay\Transfermovil\UseCases\Queries\GetOrderStatus;

use Omnipay\Transfermovil\Message\AbstractRequestImp;

class GetOrderStatusRequest extends AbstractRequestImp
{
    public function getData()
    {
        $this->validate('request_info');

        return [
            'service' => '/RestExternalPayment.svc',
            'endpoint' => '/getStatusOrder/'.$this->getRequestInfo()->getExternalId().'/'.$this->getEntityId(),
        ];
    }

    public function setRequestInfo(GetOrderStatusParams $value)
    {
        return $this->setParameter('request_info', $value);
    }

    public function getRequestInfo() : GetOrderStatusParams
    {
        return $this->getParameter('request_info');
    }

    protected function getHttpMethod()
    {
        return 'GET';
    }
}