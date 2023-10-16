<?php

namespace Omnipay\Transfermovil;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Http\Client;
use GuzzleHttp\Client as GuzzleHttpClient;

class BaseGateway extends AbstractGateway
{
    protected $endpointURL = 'https://200.13.144.60:5001/';

    /**
     * Create a new gateway instance
     *
     * @param Client          $httpClient  A HTTP client to make API calls with
     * @param HttpRequest     $httpRequest A Symfony HTTP request object
     */
    public function __construct(Client $httpClient = null, HttpRequest $httpRequest = null)
    {
        $httpClient = $httpClient ?: new Client(new GuzzleHttpClient(['verify'=>false]));
        $this->httpClient = $httpClient ?: $this->getDefaultHttpClient();
        $this->httpRequest = $httpRequest ?: $this->getDefaultHttpRequest();
        $this->initialize();
    }


    public function getName()
    {
        return 'BaseGateway';
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
    
   /**
     * Create Request
     *
     * This overrides the parent createRequest function ensuring that the OAuth
     * 2.0 access token is passed along with the request data -- unless the
     * request is a AccessTokenRequest in which case no token is needed.  If no
     * token is available then a new one is created (e.g. if there has been no
     * token request or the current token has expired).
     *
     * @param  string  $class
     * @return \Omnipay\Enzona\Message\AbstractRestRequest
     */
    public function createRequest($class, array $parameters = [])
    {
        $parameters['Username'] = $this->getUsername();
        $parameters['Password'] = $this->getPassword();
        $parameters['EntityId'] = $this->getEntityId();

        return parent::createRequest($class, $parameters);
    }

    public function acceptNotification($options = [])
    {
        return false;
    }

    public function authorize(array $parameters = [])
    {
        return false;
    }

    public function completeAuthorize(array $parameters = [])
    {
        return false;
    }

    public function capture(array $parameters = [])
    {
        return false;
    }

    public function refund(array $parameters = [])
    {
        return false;
    }

    public function fetchTransaction(array $parameters = [])
    {
        return false;
    }

    public function void(array $parameters = [])
    {
        return false;
    }

    public function createCard(array $parameters = [])
    {
        return false;
    }

    public function updateCard(array $parameters = [])
    {
        return false;
    }

    public function deleteCard(array $parameters = [])
    {
        return false;
    }
    public function purchase(array $parameters = [])
    {
        return false;
    }
    public function completePurchase(array $parameters = [])
    {
        return false;
    }
}
?>
