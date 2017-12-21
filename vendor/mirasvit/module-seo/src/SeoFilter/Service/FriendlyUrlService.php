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


namespace Mirasvit\SeoFilter\Service;

use Mirasvit\SeoFilter\Api\Service\FriendlyUrlServiceInterface;
use Mirasvit\SeoFilter\Api\Data\RewriteInterface;
use Mirasvit\SeoFilter\Api\Service\RewriteServiceInterface;
use Mirasvit\SeoFilter\Helper\Url as UrlHelper;


class FriendlyUrlService implements FriendlyUrlServiceInterface
{
    /**
     * Cache for category rewrite suffix
     *
     * @var array
     */
    protected $categoryUrlSuffix = [];

    /**
     * @param RewriteServiceInterface $rewrite
     * @param UrlHelper $urlHelper
     */
    public function __construct(
        RewriteServiceInterface $rewrite,
        UrlHelper $urlHelper
    ) {
        $this->rewrite = $rewrite;
        $this->urlHelper = $urlHelper;
    }

    /**
     * Create friendly urls for Layered Navigation (add and remove filters)
     *
     * {@inheritdoc}
     */
    public function getFriendlyUrl($attributeCode, $attributeId, $optionId, $remove = false) {
        $filterUrlArray = [];
        $filterUrlArray[$attributeCode] = $this->rewrite->getRewriteForFilterOption($attributeCode, $attributeId, $optionId);
        $activeFilters = $this->rewrite->getActiveFilters();
        $filterUrlArray = array_merge($filterUrlArray, $activeFilters);
        if ($remove && isset($filterUrlArray[$attributeCode])) { //delete filter
            unset($filterUrlArray[$attributeCode]);
        }
        $filterUrlArray = $this->getPreparedFilterUrlArray($filterUrlArray);
        $filterUrlString = implode(RewriteInterface::FILTER_SEPARATOR, $filterUrlArray);
        $url = $this->getPreparedCurrentCategoryUrl($filterUrlString);

        return $url;
    }

    /**
     * @param string $filterUrlString
     * @return string
     */
    protected function getPreparedCurrentCategoryUrl($filterUrlString)
    {
        $suffix =  $this->urlHelper->getCategoryUrlSuffix();
        $url =  $this->urlHelper->getCurrentCategory()->getUrl();
        $url = preg_replace('/\?.*/', '', $url);
        $url = ($suffix) ? str_replace($suffix, '', $url) : $url;
        if (!empty($filterUrlString)) {
            $url .= '/' . $filterUrlString;
        }
        $url = $url . $suffix;

        return $url;
    }

    /**
     * @param string $filterUrlString
     * @return string
     */
    protected function getPreparedFilterUrlArray($filterUrlArray)
    {
        ksort($filterUrlArray);
        if (isset($filterUrlArray[RewriteInterface::PRICE])) {
            $price = $filterUrlArray[RewriteInterface::PRICE];
            unset($filterUrlArray[RewriteInterface::PRICE]);
            $filterUrlArray[RewriteInterface::PRICE] = $price;
        }

        return $filterUrlArray;
    }
}