<?php

namespace Colizen\AdminBundle\SoapClient;

use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Colizen\AdminBundle\SoapClient\Exception\WebServiceResultException;

class ColizenWebService {
    protected $client;
    protected $wsdlLocation;
    protected $loginInfo;
    public function __construct(array $config) {
        foreach (array("wsdl_location","customer","password") as $required){
            if (!isset($config[$required])||$config[$required]==""){
                throw new MissingOptionsException("missing '$required' parameter for colizen webservice");
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
    public function getClient(){
        if (!$this->client instanceof \SoapClient)
            $this->client = new \SoapClient($this->wsdlLocation);
        return $this->client;
    }
    /**
     * 
     * @param int $customerCenter
     * @param long $shipmentNumber
     * @param boolean $asArray
     * @return mixed
     */
    public function getShipmentTrace($customerCenter, $shipmentNumber, $asArray=false){
        $params=array(
                        'customer_center'=>$customerCenter,
                        'shipmentnumber'=>$this->formatShipmentNumber($shipmentNumber),
                        )+$this->loginInfo;
        return $this->getResults(($asArray)?'getShipmentTraceAsArray':'getShipmentTrace',$params);
    }
    /**
     * 
     * @param int $customerCenter
     * @param long $shipmentNumber
     * @param string $DPDReference
     * @return array
     */
    public function getShipmentTraceByDPDReferenceGlobal($customerCenter, $shipmentNumber,$DPDReference){
        $params=array(
                        'customer_center'=>$customerCenter,
                        'shipmentnumber'=>$this->formatShipmentNumber($shipmentNumber),
                        'dpd_reference'=>$DPDReference,
                        )+$this->loginInfo;
        return $this->getResults('getShipmentTraceByDPDReferenceGlobalAsArray',$params);
    }
    /**
     * 
     * @param int $customerCenter
     * @param long $shipmentNumber
     * @param string $reference
     * @param \DateTime $shippingDate
     * @param boolean $asArray
     * @return mixed
     */
    public function getShipmentTraceByReference($customerCenter, $shipmentNumber, $reference, \DateTime $shippingDate, $asArray=false){
        $params=array(
                        'customer_center'=>$customerCenter,
                        'shipmentnumber'=>$this->formatShipmentNumber($shipmentNumber),
                        'reference'=>$reference,
                        'shipping_date'=>$shippingDate->format('d.m.Y'),
                        )+$this->loginInfo;
        return $this->getResults(($asArray)?'getShipmentTraceByReferenceAsArray':'getShipmentTraceByReference',$params);
    }
    /**
     * 
     * @param int $customerCenter
     * @param long $shipmentNumber
     * @param type $reference
     * @param \DateTime $shippingDate
     * @param long $shippingCustomer
     * @param boolean $asArray
     * @return mixed
     */
    public function getShipmentTraceByReferenceGlobal($customerCenter, $shipmentNumber, $reference, \DateTime $shippingDate, $shippingCustomer, $asArray=false){
        $params=array(
                        'customer_center'=>$customerCenter,
                        'shipmentnumber'=>$this->formatShipmentNumber($shipmentNumber),
                        'reference'=>$reference,
                        'shipping_date'=>$shippingDate->format('d.m.Y'),
                        'shipping_customer'=>$shippingCustomer,
                        )+$this->loginInfo;
        return $this->getResults(($asArray)?'getShipmentTraceByReferenceGlobalAsArray':'getShipmentTraceByReferenceGlobal',$params);
    }
    /**
     * 
     * @param int $customerCenter
     * @param long $shipmentNumber
     * @param type $reference
     * @param \DateTime $shippingDate
     * @param long $shippingCustomer
     * @param int $shippingCustomerCenter
     * @return array
     */
    public function getShipmentTraceByReferenceGlobalWithCenter($customerCenter, $shipmentNumber, $reference, \DateTime $shippingDate, $shippingCustomer, $shippingCustomerCenter){
        $params=array(
                        'customer_center'=>$customerCenter,
                        'shipmentnumber'=>$this->formatShipmentNumber($shipmentNumber),
                        'reference'=>$reference,
                        'shipping_date'=>$shippingDate->format('d.m.Y'),
                        'shipping_customer'=>$shippingCustomer,
                        'shipping_customer_center'=>$shippingCustomerCenter,
                        )+$this->loginInfo;
        return $this->getResults('getShipmentTraceByReferenceGlobalWithCenterAsArray',$params);
    }
    protected function formatShipmentNumber($shipmentNumber){
        return is_string($shipmentNumber)?preg_replace('/\D/','',$shipmentNumber):$shipmentNumber;
    }
    protected function getResults($apiFunction,$params){
        $result=$this->getClient()->{$apiFunction}($params)->{$apiFunction.'Result'};
        if (isset($result->LastError)&&$result->LastError!="")
            throw new WebServiceResultException($result->LastError);
        return $result;
    }
}
