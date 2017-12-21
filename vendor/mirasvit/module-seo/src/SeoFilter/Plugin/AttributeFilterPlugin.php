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
 * @version   2.0.11
 * @copyright Copyright (C) 2017 Mirasvit (https://mirasvit.com/)
 */



namespace Mirasvit\SeoFilter\Plugin;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Mirasvit\SeoFilter\Api\Service\FriendlyUrlServiceInterface;
use Mirasvit\SeoFilter\Helper\Url as UrlHelper;
use Magento\Framework\UrlInterface;
use Mirasvit\SeoFilter\Api\Config\ConfigInterface as Config;
use Magento\Theme\Block\Html\Pager as HtmlPager;

class AttributeFilterPlugin
{
    /**
     * @param HtmlPager $htmlPagerBlock
     * @param CategoryRepositoryInterface $categoryRepository
     * @param FriendlyUrlServiceInterface $friendlyUrlService
     * @param UrlHelper $urlHelper
     * @param UrlInterface $url
     * @param Config $config
     */
    public function __construct(
        HtmlPager $htmlPagerBlock,
        CategoryRepositoryInterface $categoryRepository,
        FriendlyUrlServiceInterface $friendlyUrlService,
        UrlHelper $urlHelper,
        UrlInterface $url,
        Config $config
    ) {
        $this->htmlPagerBlock = $htmlPagerBlock;
        $this->categoryRepository = $categoryRepository;
        $this->friendlyUrlService = $friendlyUrlService;
        $this->urlHelper = $urlHelper;
        $this->url = $url;
        $this->config = $config;
        $this->storeId = $urlHelper->getStoreId();
    }

    /**
     * Get filter item url
     *
     * @param \Magento\Catalog\Model\Layer\Filter\Item $item
     * @return string
     */
    public function afterGetUrl(\Magento\Catalog\Model\Layer\Filter\Item $item)
    {
        if (!$this->config->isEnabled($this->storeId)
            || !$this->urlHelper->isCategoryPage()) {
                return $this->getOriginalUrl($item);
        }
        if ($item->getFilter()->getRequestVar() == 'cat') {
            $categoryUrl = $this->categoryRepository
                ->get($item->getValue(), $this->storeId)
                ->getUrl();

            return$this->urlHelper->addUrlParams($categoryUrl);
        }

        $filter = $item->getFilter();
        if (empty($filter)) {
            return $this->getOriginalUrl($item);
        }
        $attributeId =  $filter->getAttributeModel()->getAttributeId();
        $attributeCode = $filter->getAttributeModel()->getAttributeCode();
        $optionId = $item->getValue();
        if (!$attributeId || !$attributeCode || !$optionId) {
            return $this->getOriginalUrl($item);
        }

        $url = $this->friendlyUrlService->getFriendlyUrl($attributeCode, $attributeId, $optionId);

        return $this->urlHelper->addUrlParams($url);
    }

    /**
     * Get url for remove item from filter
     *
     * @param \Magento\Catalog\Model\Layer\Filter\Item $item
     * @return string
     */
    public function afterGetRemoveUrl(\Magento\Catalog\Model\Layer\Filter\Item $item)
    {
        if (!$this->config->isEnabled($this->storeId)
            || !$this->urlHelper->isCategoryPage()) {
                return $this-> getOriginalRemoveUrl($item);
        }

        $filter = $item->getFilter();
        if (empty($filter)) {
            return $this->getOriginalRemoveUrl($item);
        }
        $attributeId =  $filter->getAttributeModel()->getAttributeId();
        $attributeCode = $filter->getAttributeModel()->getAttributeCode();
        $optionId = $item->getValue();
        if (!$attributeId || !$attributeCode || !$optionId) {
            return $this->getOriginalRemoveUrl($item);
        }

        $url = $this->friendlyUrlService->getFriendlyUrl($attributeCode, $attributeId, $optionId, true);

        return $this->urlHelper->addUrlParams($url);
    }

    /**
     * @param \Magento\Catalog\Model\Layer\Filter\Item $item
     * @return string
     */
    protected function getOriginalUrl($item) {
        $query = [
            $item->getFilter()->getRequestVar() => $item->getValue(),
            // exclude current page from urls
            $this->htmlPagerBlock->getPageVarName() => null,
        ];

        return $this->url->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true, '_query' => $query]);
    }

    /**
     * @param \Magento\Catalog\Model\Layer\Filter\Item $item
     * @return string
     */
    protected function getOriginalRemoveUrl($item) {
        $query = [$item->getFilter()->getRequestVar() => $item->getFilter()->getResetValue()];
        $params['_current'] = true;
        $params['_use_rewrite'] = true;
        $params['_query'] = $query;
        $params['_escape'] = true;

        return $this->url->getUrl('*/*/*', $params);
    }
}