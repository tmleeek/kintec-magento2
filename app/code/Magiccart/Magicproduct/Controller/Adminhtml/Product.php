<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2016-01-26 18:56:21
 * @@Function:
 */

namespace Magiccart\Magicproduct\Controller\Adminhtml;

abstract class Product extends \Magiccart\Magicproduct\Controller\Adminhtml\Magicproduct
{
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magiccart_Magicproduct::magicproduct_product');
    }
}