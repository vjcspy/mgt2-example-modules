<?php
/**
 * @author Interactiv4 Team
 * @copyright Copyright © Interactiv4 (https://www.interactiv4.com)
 */

namespace Iz\ExtensibleModelExtend\Plugin;


use Iz\ExtensibleModel\Api\Data\PostExtensionFactory;
use Iz\ExtensibleModel\Api\Data\PostInterface;
use Iz\ExtensibleModel\Api\Data\PostSearchResultsInterface;
use Iz\ExtensibleModel\Api\PostRepositoryInterface;
use Iz\ExtensibleModelExtend\Api\CustomPostRepositoryInterface;
use Iz\ExtensibleModelExtend\Api\Data\CustomPostInterface;
use Iz\ExtensibleModelExtend\Api\Data\CustomPostInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class EntityRepositoryPlugin
 */
class PostRepositoryPlugin
{
    /**
     * @var CustomPostRepositoryInterface
     */
    private $customPostRepository;
    /**
     * @var PostInterfaceFactory|CustomPostInterfaceFactory
     */
    private $customPostFactory;
    /**
     * @var EntityExtensionFactory|PostExtensionFactory
     */
    private $postExtensionFactory;

    /**
     * PostRepositoryPlugin constructor.
     * @param PostExtensionFactory $entityExtensionFactory
     * @param CustomPostInterfaceFactory $customPostFactory
     * @param CustomPostRepositoryInterface $customPostRepository
     */
    public function __construct(
        PostExtensionFactory $entityExtensionFactory,
        CustomPostInterfaceFactory $customPostFactory,
        CustomPostRepositoryInterface $customPostRepository
    )
    {
        $this->postExtensionFactory = $entityExtensionFactory;
        $this->customPostFactory = $customPostFactory;
        $this->customPostRepository = $customPostRepository;
    }

    /**
     * @param PostRepositoryInterface $subject
     * @param PostInterface $result
     * @return PostInterface
     */
    public function afterGet(PostRepositoryInterface $subject, PostInterface $result)
    {
        /** @var PostExtensionInterface $extensionAttributes */
        $extensionAttributes = $result->getExtensionAttributes() ?: $this->postExtensionFactory->create();

        try {
            /** @var CustomPostInterface $customPost */
            $customPost = $this->customPostRepository->get($result->getId(), CustomPostInterface::FIELD_POST_ID);
        } catch (NoSuchEntityException $e) {
            $result->setExtensionAttributes($extensionAttributes);

            return $result;
        }
        $extensionAttributes->setShortDescription($customPost->getShortDescription());

        $result->setExtensionAttributes($extensionAttributes);

        return $result;
    }

    /**
     * @param PostRepositoryInterface $subject
     * @param PostSearchResultsInterface $entities
     * @return PostSearchResultsInterface
     */
    public function afterGetList(PostRepositoryInterface $subject, PostSearchResultsInterface $entities)
    {
        foreach ($entities->getItems() as $entity) {
            $this->afterGet($subject, $entity);
        }

        return $entities;
    }

    /**
     * @param PostRepositoryInterface $subject
     * @param PostInterface $result
     * @return PostInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function afterSave(PostRepositoryInterface $subject, PostInterface $result)
    {
        $extensionAttributes = $result->getExtensionAttributes() ?: $this->postExtensionFactory->create();
        if ($extensionAttributes !== null &&
            $extensionAttributes->getShortDescription() !== null
        ) {
            /** @var PostInterface $customPost */
            try {
                $customPost = $this->customPostRepository->get($result->getId(), CustomPostInterface::FIELD_POST_ID);
            } catch (NoSuchEntityException $e) {
                $customPost = $this->customPostFactory->create();
            }
            $customPost->setPostId($result->getId());
            $customPost->setShortDescription($extensionAttributes->getShortDescription());
            $this->customPostRepository->save($customPost);
        }

        return $result;
    }
}
