<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\HasCardTrait;
use Omnipay\ElementExpress\HasPaymentAccountTrait;
use Omnipay\ElementExpress\HasTerminalTrait;
use Omnipay\ElementExpress\HasTransactionTrait;

/**
 * ElementExpress CreditCardCredit Request
 */
class CreditCardCreditRequest extends AbstractTransactionRequest
{
    use HasCardTrait;
    use HasPaymentAccountTrait;
    use HasTerminalTrait;
    use HasTransactionTrait;

    /**
     * Get data
     *
     * @return \DOMDocument
     */
    public function getData()
    {
        // $this->validate('amount');
        return $this->domDocumentFactory('CreditCardCredit', ...[
            $this->getApplication(),
            $this->getCredentials(),
            $this->getTransaction(),
            $this->getTerminal(),
            $this->getPaymentAccount(),
            $this->getCard(),
        ]);
    }
}
