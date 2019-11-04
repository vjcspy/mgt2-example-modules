<?php
/**
 * @author Interactiv4 Team
 * @copyright Copyright © Interactiv4 (https://www.interactiv4.com)
 */

namespace Iz\ExtensibleModelExtend\Model;


use Iz\ExtensibleModelExtend\Api\CustomPostRepositoryInterface;
use Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface;
use Magento\Framework\Exception\NoSuchEntityException;


/**
 * Class PostRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CustomPostRepository implements CustomPostRepositoryInterface
{
    /**
     * @var CustomPostFactory
     */
    private $customPostFactory;

    public function __construct(
        CustomPostFactory $customPostFactory
    )
    {
        $this->customPostFactory = $customPostFactory;
    }

    /**
     * @inheritdoc
     */
    public function save(CustomPostInterface $customPost)
    {
        /** @var \Iz\ExtensibleModelExtend\Model\ResourceModel\CustomPost $resource */
        $resource = $customPost->getResource();
        $resource->save($customPost);

        return $customPost;
    }

    /**
     * @inheritdoc
     */
    public function getById($customPostId)
    {
        // TODO: Implement getById() method.
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode = null)
    {
        /** @var CustomPost $customPost */
        $customPost = $this->customPostFactory->create()->load($value, $attributeCode);
        if (!$customPost->getId()) {
            throw new NoSuchEntityException(__('Unable to find custom post'));
        }
        return $customPost;
    }

    /**
     * @inheritdoc
     */
    public function delete(\Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface $customPost)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @inheritdoc
     */
    public function deleteById($customPostId)
    {
        // TODO: Implement deleteById() method.
    }

    /**
     * @inheritdoc
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement getList() method.
    }

    /**
     * @inheritdoc
     */
    public function getListPostByShortDescription($shortDescription)
    {
        // TODO: Implement getListPostByShortDescription() method.
    }
}
