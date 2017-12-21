<?php
namespace Dotdigitalgroup\Email\Controller\Quoteproducts\Upsell;

/**
 * Interceptor class for @see \Dotdigitalgroup\Email\Controller\Quoteproducts\Upsell
 */
class Interceptor extends \Dotdigitalgroup\Email\Controller\Quoteproducts\Upsell implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Dotdigitalgroup\Email\Helper\Data $data, \Magento\Framework\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($data, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
