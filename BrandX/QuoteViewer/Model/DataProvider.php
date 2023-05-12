<?php

namespace BrandX\QuoteViewer\Model;

use Magento\Quote\Model\ResourceModel\Quote\Collection;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    public function __construct($name, $primaryFieldName, $requestFieldName, Collection $collection, array $meta = [], array $data = [])
    {
        $this->collection = $collection;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }


}
