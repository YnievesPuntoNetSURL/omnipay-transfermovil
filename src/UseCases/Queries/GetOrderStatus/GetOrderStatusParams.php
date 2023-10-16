<?php
namespace Omnipay\Transfermovil\UseCases\Queries\GetOrderStatus;

class GetOrderStatusParams
{
    public $ExternalId;

    public function getExternalId() { 
         return $this->ExternalId;
    }
    public function setExternalId($ExternalId) { 
         $this->ExternalId = $ExternalId;
    }
}
