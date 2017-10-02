<?php

namespace Dealer4dealer\Xcore\Plugin\Magento\Sales\Api\Data;

class OrderInterface
{
    protected $objectManager;

    private $extensionFactory;

    /**
     * OrderInterface constructor.
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Sales\Api\Data\OrderExtensionFactory $extensionFactory
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Sales\Api\Data\OrderExtensionFactory $extensionFactory
    )
    {
        $this->objectManager = $objectManager;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @api
     * @param \Magento\Sales\Api\Data\OrderInterface $subject
     * @param $result
     * @return \Magento\Sales\Api\Data\OrderExtensionInterface
     */
    public function afterGetExtensionAttributes(
        \Magento\Sales\Api\Data\OrderInterface $subject,
        $result
    ) {

        if ($result === null) {
            $result = $this->extensionFactory->create();
        }

        // Get the custom attributes
        $repo = $this->objectManager->get('Dealer4dealer\Xcore\Model\CustomAttributeRepository');
        $customOrderAttributes = $repo->getListByType('order');

        // Get the actual value of the custom attributes
        $customAttributes = [];
        foreach($customOrderAttributes as $customOrderAttribute) {
            $key = $customOrderAttribute['to'];
            $value = $subject->getData($customOrderAttribute['from']);
            $customAttributes[] = ['key' => $key, 'value' => $value];
        }

        // Set the Extension Attributes for Xcore Custom Attributes
        $result->setXcoreCustomAttributes($customAttributes);

        return $result;
    }
}