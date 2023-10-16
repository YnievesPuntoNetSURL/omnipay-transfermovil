<?php

namespace Omnipay\Transfermovil\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractRequest;

abstract class AbstractRequestImp extends AbstractRequest
{
    protected $endpointURL = 'https://200.13.144.60:15001';

    public function getData()
    {
        //return $this->getExternalReference();
    }

    public function setEntityId($value)
    {
        return $this->setParameter('entity_Id', $value);
    }

    public function getEntityId()
    {
        return $this->getParameter('entity_Id');
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    protected function getEndpoint($service, $endpoint = '')
    {
        if ($endpoint != '') {
            $service .= $endpoint;
        }

        return $this->endpointURL.$service;
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        $data['data'] = (array_key_exists("data",$data)) ? $data['data'] ?: [] : [];
        // Guzzle HTTP Client createRequest does funny things when a GET request
        // has attached data, so don't send the data if the method is GET.
        $options = JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK;
        
        if ($this->getHttpMethod() == 'GET') {
            $requestUrl = $this->getEndpoint($data['service'], $data['endpoint']).'?'.http_build_query($data['data']);
            $body = null;
        } else {
            $requestUrl = $this->getEndpoint($data['service'], $data['endpoint']);
            $body = $this->toJSON($data['data'], $options);
        }

        // Might be useful to have some debug code here, Enzona especially can be
        // a bit fussy about data formats and ordering.  Perhaps hook to whatever
        // logging engine is being used.
        // TODO: Uncomment to debug request
        // echo 'Data == '.json_encode($data)."\n";
        // echo 'Request URL == '.$requestUrl."\n";
        // echo 'Body == '.$body."\n";
        try {
            date_default_timezone_set("America/Havana");

            $passwd_string = $this->getUsername().date('jnY')."externalpayment".$this->getEntityId();
            $hashed_passwd=hash('sha512', $passwd_string, true);
            $base64_encoded_passwd=base64_encode($hashed_passwd);

            $headers = [
                'Accept' => 'application/json',
                'Username' => $this->getUsername(),
                'Password' => $base64_encoded_passwd,
                'Source' => $this->getEntityId(),
                'Content-type' => 'application/json',
            ];
            
            $httpResponse = $this->httpClient->request(
                $this->getHttpMethod(),
                $requestUrl,
                $headers,
                $body
            );
            
            // Empty response body should be parsed also as and empty array
            $body = (string) $httpResponse->getBody()->getContents();
            $jsonToArrayResponse = ! empty($body) ? json_decode($body, true) : [];

            return $this->response = $this->createResponse($jsonToArrayResponse, $httpResponse->getStatusCode());
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: '.$e->getMessage(),
                $e->getCode()
            );
        }
    }

    public function toJSON($data, $options = 0)
    {
        if (version_compare(phpversion(), '5.4.0', '>=') === true) {
            return json_encode($data, $options);
        }

        return str_replace('\\/', '/', json_encode($data, $options));
    }

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new RestResponse($this, $data, $statusCode);
    }
}
