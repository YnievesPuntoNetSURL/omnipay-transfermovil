<?php
namespace Omnipay\Transfermovil\UseCases\Commands\PayOrder;

class PayOrderRequestParams
{
    public $Amount;
    public $Phone;
    public $Currency;
    public $Description;
    public $ExternalId;
    public $Source;
    public $UrlResponse;
    public $ValidTime;

    public function getAmount() { 
         return $this->Amount;
    }
    public function setAmount($Amount) { 
         $this->Amount = $Amount;
    }

    public function getPhone() { 
         return $this->Phone;
    }
    public function setPhone($Phone) { 
         $this->Phone = $Phone;
    }

    public function getCurrency() { 
         return $this->Currency;
    }
    public function setCurrency($Currency) { 
         $this->Currency = $Currency;
    }

    public function getDescription() { 
         return $this->Description;
    }
    public function setDescription($Description) { 
         $this->Description = $Description;
    }

    public function getExternalId() { 
         return $this->ExternalId;
    }
    public function setExternalId($ExternalId) { 
         $this->ExternalId = $ExternalId;
    }

    public function getSource() { 
         return $this->Source;
    }
    public function setSource($Source) { 
         $this->Source = $Source;
    }

    public function getUrlResponse() { 
         return $this->UrlResponse;
    }
    public function setUrlResponse($UrlResponse) { 
         $this->UrlResponse = $UrlResponse;
    }

    public function getValidTime() { 
         return $this->ValidTime;
    }
    public function setValidTime($ValidTime) { 
         $this->ValidTime = $ValidTime;
    }
}
