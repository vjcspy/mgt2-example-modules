<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/16
 * @website https://swiftotter.com
 **/

namespace Chapter5\BackendCustomization\Ui\Component\Grid\Column;

class CombinedName extends \Magento\Ui\Component\Listing\Columns\Column
{
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        /**
         * this is a great place for per-column data manipulation. For example, we could
         * combine the first and last name here and would not have to create a custom component.
         * However, for the sake of learning, we are going to full distance.
         **/

        return $dataSource;
    }
}