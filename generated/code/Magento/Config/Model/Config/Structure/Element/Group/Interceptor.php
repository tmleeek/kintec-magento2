<?php
namespace Magento\Config\Model\Config\Structure\Element\Group;

/**
 * Interceptor class for @see \Magento\Config\Model\Config\Structure\Element\Group
 */
class Interceptor extends \Magento\Config\Model\Config\Structure\Element\Group implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Module\Manager $moduleManager, \Magento\Config\Model\Config\Structure\Element\Iterator\Field $childrenIterator, \Magento\Config\Model\Config\BackendClone\Factory $cloneModelFactory, \Magento\Config\Model\Config\Structure\Element\Dependency\Mapper $dependencyMapper)
    {
        $this->___init();
        parent::__construct($storeManager, $moduleManager, $childrenIterator, $cloneModelFactory, $dependencyMapper);
    }

    /**
     * {@inheritdoc}
     */
    public function isExpanded()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isExpanded');
        if (!$pluginInfo) {
            return parent::isExpanded();
        } else {
            return $this->___callPlugins('isExpanded', func_get_args(), $pluginInfo);
        }
    }
}
