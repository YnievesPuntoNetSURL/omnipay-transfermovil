<?php
namespace Omnipay\Transfermovil\UseCases\Commands\PayOrder;

class PayOrderCommand
{
    public PayOrderRequestParams $request;

    public function getRequest() : PayOrderRequestParams { 
         return $this->request;
    }
    public function setRequest(PayOrderRequestParams $request) { 
         $this->request = $request;
    }
}
