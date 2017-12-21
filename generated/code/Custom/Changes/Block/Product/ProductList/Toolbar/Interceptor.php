<?php
namespace Custom\Changes\Block\Product\ProductList\Toolbar;

/**
 * Interceptor class for @see \Custom\Changes\Block\Product\ProductList\Toolbar
 */
class Interceptor extends \Custom\Changes\Block\Product\ProductList\Toolbar implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Catalog\Model\Session $catalogSession, \Magento\Catalog\Model\Config $catalogConfig, \Magento\Catalog\Model\Product\ProductList\Toolbar $toolbarModel, \Magento\Framework\Url\EncoderInterface $urlEncoder, \Magento\Catalog\Helper\Product\ProductList $productListHelper, \Magento\Framework\Data\Helper\PostHelper $postDataHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $catalogSession, $catalogConfig, $toolbarModel, $urlEncoder, $productListHelper, $postDataHelper, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getPagerUrl($params = array())
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPagerUrl');
        if (!$pluginInfo) {
            return parent::getPagerUrl($params);
        } else {
            return $this->___callPlugins('getPagerUrl', func_get_args(), $pluginInfo);
        }
    }
}
