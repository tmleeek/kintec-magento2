<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2016-03-31 10:27:14
 * @@Function:
 */

namespace Magiccart\Magicproduct\Controller\Index;

class Ajax extends \Magiccart\Magicproduct\Controller\Ajax
{
    /**
     * Default customer account page.
     */
    public function execute()
    {
    	// if ($this->getRequest()->getQuery('ajax')) {
	        $this->_view->loadLayout();
	        $this->_view->renderLayout();
	        $info = $this->getRequest()->getParam('info');
	        $type = $this->getRequest()->getParam('type');
	        $tmp = $info['timer'] ? 'category/gridtimer.phtml':'category/grid.phtml';
	        $products = $this->_view->getLayout()->createBlock('Magiccart\Magicproduct\Block\Product\GridProduct')
					            ->setCfg($info)
					           	->setActivated($type)
					           	->setTemplate($tmp)
					           	->toHtml();
	        $this->getResponse()->setBody( $products );
	    // }
    }
}
