<?php

namespace Dotdigitalgroup\Email\Observer\Customer;

class NewAutomation implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Dotdigitalgroup\Email\Model\Automation
     */
    protected $_automation;

    /**
     * NewAutomation constructor.
     *
     * @param \Dotdigitalgroup\Email\Model\Automation $automation
     */
    public function __construct(
        \Dotdigitalgroup\Email\Model\Automation $automation
    ) {
        $this->_automation = $automation;
    }

    /**
     * If it's configured to capture on shipment - do this.
     *
     * @param \Magento\Framework\Event\Observer $observer
     *
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        //New Automation enrolment to queue
        $this->_automation->newCustomerAutomation($customer);
        return $this;
    }
}