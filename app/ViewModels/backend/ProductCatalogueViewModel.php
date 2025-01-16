<?php
namespace App\ViewModels\backend;

class ProductCatalogueViewModel
{
    protected $productCatalogue;
    public function __construct($productCatalogue)
    {
        $this->productCatalogue = $productCatalogue;
    }

    public function getProductCatalogue()
    {
        $this->productCatalogue->toArray();
        foreach ($this->productCatalogue as &$node) {

            $depth = 0;
            foreach ($this->productCatalogue as $parent) {
                if ($node['_lft'] >= $parent['_lft'] && $node['_rgt'] <= $parent['_rgt']) {
                    $depth++;
                    $node['countChildren'] = ($parent['_rgt'] - $node['_lft'] - 1) / 2;
                }
            }

            $node['depth'] = $depth - 1;
        }

        return $this->productCatalogue;
    }

}
