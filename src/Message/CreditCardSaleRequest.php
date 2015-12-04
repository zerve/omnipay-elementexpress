<?php
namespace Omnipay\ElementExpress\Message;

use Omnipay\ElementExpress\HasCardTrait;
use Omnipay\ElementExpress\HasTerminalTrait;
use Omnipay\ElementExpress\HasTransactionTrait;

/**
 * ElementExpress CreditCardSale Request
 */
class CreditCardSaleRequest extends AbstractRequest
{
    use HasCardTrait;
    use HasTerminalTrait;
    use HasTransactionTrait;

    /**
     * Get data
     *
     * @return \DOMDocument
     */
    public function getData()
    {
        // $this->validate('amount', 'card');
        // $this->getCard()->validate();
        return $this->domDocumentFactory('CreditCardSale', ...[
            $this->getApplication(),
            $this->getCredentials(),
            $this->getTransaction(),
            $this->getTerminal(),
            $this->getCard(),
        ]);
    }
}
