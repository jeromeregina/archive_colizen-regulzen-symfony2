<?php

namespace Regulzen\CoreBundle\SoapClient;

use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Regulzen\CoreBundle\SoapClient\Exception\WebServiceResultException;

class RegulzenWebService
{
    protected $client;


    protected $wsdlLocation;


    protected $loginInfo;


    public function __construct(array $config)
    {
        foreach (array("wsdl_location","customer","password") as $required) {
            if (!isset($config[$required])||$config[$required]=="") {
                throw new MissingOptionsException("missing '$required' parameter for regulzen webservice");
            }
        }
        $this->wsdlLocation=$config["wsdl_location"];
        unset($config["wsdl_location"]);
        $this->loginInfo=$config;
    }


    /**
     *
     * @return SoapClient
     */
    public function getClient()
    {
        if (!$this->client instanceof \SoapClient)
            $this->client = new \SoapClient($this->wsdlLocation);

        return $this->client;
    }


    /**
     *
     * @param  int     $customerCenter
     * @param  long    $shipmentNumber
     * @param  boolean $asArray
     * @return mixed
     */
    public function getShipmentTrace($customerCenter, $shipmentNumber, $asArray=false)
    {
        $params=array(
                        'customer_center'=>$customerCenter,
                        'shipmentnumber'=>$shipmentNumber,
                        )+$this->loginInfo;

        return $this->getResults(($asArray)?'getShipmentTraceAsArray':'getShipmentTrace',$params);
    }


    /**
     *
     * @param  int    $customerCenter
     * @param  string $DPDReference
     * @return array
     */
    public function getShipmentTraceByDPDReferenceGlobal($customerCenter,$DPDReference)
    {
        $params=array(
                        'customer_center'=>$customerCenter,
                        'dpd_reference'=>$DPDReference,
                        )+$this->loginInfo;

        return $this->getResults('getShipmentTraceByDPDReferenceGlobalAsArray',$params);
    }


    /**
     *
     * @param  int       $customerCenter
     * @param  string    $reference
     * @param  \DateTime $shippingDate
     * @param  boolean   $asArray
     * @return mixed
     */
    public function getShipmentTraceByReference($customerCenter, $reference, \DateTime $shippingDate, $asArray=false)
    {
        $params=array(
                        'customer_center'=>$customerCenter,
                        'reference'=>$reference,
                        'shipping_date'=>$shippingDate->format('d.m.Y'),
                        )+$this->loginInfo;

        return $this->getResults(($asArray)?'getShipmentTraceByReferenceAsArray':'getShipmentTraceByReference',$params);
    }



    /**
     *
     * @param  int       $customerCenter
     * @param  type      $reference
     * @param  \DateTime $shippingDate
     * @param  long      $shippingCustomer
     * @param  boolean   $asArray
     * @return mixed
     */
    public function getShipmentTraceByReferenceGlobal($customerCenter, $reference, \DateTime $shippingDate, $shippingCustomer, $asArray=false)
    {
        $params=array(
                        'customer_center'=>$customerCenter,
                        'reference'=>$reference,
                        'shipping_date'=>$shippingDate->format('d.m.Y'),
                        'shipping_customer'=>$shippingCustomer,
                        )+$this->loginInfo;

        return $this->getResults(($asArray)?'getShipmentTraceByReferenceGlobalAsArray':'getShipmentTraceByReferenceGlobal',$params);
    }


    /**
     *
     * @param  int       $customerCenter
     * @param  type      $reference
     * @param  \DateTime $shippingDate
     * @param  long      $shippingCustomer
     * @param  int       $shippingCustomerCenter
     * @return array
     */
    public function getShipmentTraceByReferenceGlobalWithCenter($customerCenter, $reference, \DateTime $shippingDate, $shippingCustomer, $shippingCustomerCenter)
    {
        $params=array(
                        'customer_center'=>$customerCenter,
                        'reference'=>$reference,
                        'shipping_date'=>$shippingDate->format('d.m.Y'),
                        'shipping_customer'=>$shippingCustomer,
                        'shipping_customer_center'=>$shippingCustomerCenter,
                        )+$this->loginInfo;

        return $this->getResults('getShipmentTraceByReferenceGlobalWithCenterAsArray',$params);
    }


    protected function getResults($apiFunction,$params)
    {
        $result=$this->getClient()->{$apiFunction}($params)->{$apiFunction.'Result'};
        if (isset($result->LastError)&&$result->LastError!="")
            throw new WebServiceResultException($result->LastError);

        return $result;
    }
}
