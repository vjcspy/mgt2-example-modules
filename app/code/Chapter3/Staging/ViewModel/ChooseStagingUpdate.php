<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/09
 * @website https://swiftotter.com
 **/

namespace Chapter3\Staging\ViewModel;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Staging\Model\UpdateRepository;
use Magento\Staging\Model\VersionManager;
use Magento\Store\Model\StoreManagerInterface;

class ChooseStagingUpdate implements ArgumentInterface
{
    /** @var UpdateRepository */
    private $updateRepository;

    /** @var SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /** @var VersionManager */
    private $versionManager;

    /** @var StoreManagerInterface */
    private $storeManager;

    public function __construct(
        UpdateRepository $updateRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        VersionManager $versionManager,
        StoreManagerInterface $storeManager
    ) {
        $this->updateRepository = $updateRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->versionManager = $versionManager;
        $this->storeManager = $storeManager;
    }

    public function getUpdates()
    {
        return $this->updateRepository->getList(
            $this->searchCriteriaBuilder
                ->addFilter('id', $this->versionManager->getCurrentVersion()->getId(), 'gteq')
                ->create()
        );
    }

    public function getCurrentVersionId()
    {
        return $this->versionManager->getVersion()->getId();
    }

    public function getCurrentStoreId()
    {
        return $this->storeManager->getStore()->getCode();
    }
}