<?php
namespace Omnipay\ElementExpress;

use Omnipay\ElementExpress\Model\Card;

trait HasCardTrait
{
    abstract public function getParameters();
    abstract public function getParameter($key);
    abstract public function setParameter($key, $value);

    /**
     * Unlike other getModel() methods, the Card object is initialized using
     * data from the Omnipay 'card' parameter which is an object in the Omnipay
     * domain.
     */
    public function getCard()
    {
        $model = new Card();
        $parameters = $this->getParameters();
        if ($card = $this->getParameter('card')) {
            $parameters = array_merge($parameters, $card->getParameters());
        }
        return $model->initialize($parameters);
    }

    // The following mutators/accessors correspond to parameters that have
    // Omnipay equivalents. These are named with the Omnipay convention and
    // mapped to the ElementExpress domain in the model.

    public function getNumber()
    {
        return $this->getParameter('number');
    }

    public function setNumber($value)
    {
        return $this->setParameter('number', $value);
    }

    public function getExpiryMonth()
    {
        return $this->getParameter('expiryMonth');
    }

    public function setExpiryMonth($value)
    {
        return $this->setParameter('expiryMonth', $value);
    }

    public function getExpiryYear()
    {
        return $this->getParameter('expiryYear');
    }

    public function setExpiryYear($value)
    {
        return $this->setParameter('expiryYear', $value);
    }

    public function getCvv()
    {
        return $this->getParameter('cvv');
    }

    public function setCvv($value)
    {
        return $this->setParameter('cvv', $value);
    }

    // The following mutators/accessors correspond to parameters that are
    // unique to the ElementExpress domain.

    public function getEncryptedTrack1Data()
    {
        return $this->getParameter('EncryptedTrack1Data');
    }

    public function setEncryptedTrack1Data($value)
    {
        return $this->setParameter('EncryptedTrack1Data', $value);
    }

    public function getEncryptedTrack2Data()
    {
        return $this->getParameter('EncryptedTrack2Data');
    }

    public function setEncryptedTrack2Data($value)
    {
        return $this->setParameter('EncryptedTrack2Data', $value);
    }

    public function getCardDataKeySerialNumber()
    {
        return $this->getParameter('CardDataKeySerialNumber');
    }

    public function setCardDataKeySerialNumber($value)
    {
        return $this->setParameter('CardDataKeySerialNumber', $value);
    }

    public function getEncryptedFormat()
    {
        return $this->getParameter('EncryptedFormat');
    }

    public function setEncryptedFormat($value)
    {
        return $this->setParameter('EncryptedFormat', $value);
    }
}