<?php

class BulkOrderItem
{
    // Properties
    public $productId;
    public $name;
    public $largeSize;
    public $mediumSize;
    public $smallSize;
    public $total;

    function __construct($productId, $name, $largeSize, $mediumSize, $smallSize, $total)
    {
        $this->productId = $productId;
        $this->name = $name;
        $this->largeSize = $largeSize;
        $this->mediumSize = $mediumSize;
        $this->smallSize = $smallSize;
        $this->total = $total;
    }
}
