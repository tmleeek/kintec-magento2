<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-seo
 * @version   1.0.51
 * @copyright Copyright (C) 2017 Mirasvit (https://mirasvit.com/)
 */



namespace Mirasvit\Seo\Controller\Adminhtml\Template;

use Magento\Framework\Controller\ResultFactory;

class Add extends \Mirasvit\Seo\Controller\Adminhtml\Template
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $this->_initModel();

        $this->_initAction();

        $resultPage->getConfig()->getTitle()->prepend(__('Add Template'));

        $this->_addContent($resultPage->getLayout()->createBlock('\Mirasvit\Seo\Block\Adminhtml\Template\Edit'))
            ->_addLeft($resultPage->getLayout()->createBlock('\Mirasvit\Seo\Block\Adminhtml\Template\Edit\Tabs'));

        return $resultPage;
    }
}