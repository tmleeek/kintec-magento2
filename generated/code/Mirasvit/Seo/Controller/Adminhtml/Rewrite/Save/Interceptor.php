<?php
namespace Mirasvit\Seo\Controller\Adminhtml\Rewrite\Save;

/**
 * Interceptor class for @see \Mirasvit\Seo\Controller\Adminhtml\Rewrite\Save
 */
class Interceptor extends \Mirasvit\Seo\Controller\Adminhtml\Rewrite\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Seo\Model\RewriteFactory $rewriteFactory, \Magento\Framework\Registry $registry, \Magento\Framework\View\DesignInterface $design, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($rewriteFactory, $registry, $design, $context);
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
