<?php
namespace App\ViewModels\backend;

class PostCatalogueViewModel
{
    protected $postCatalogue;
    public function __construct($postCatalogue)
    {
        $this->postCatalogue = $postCatalogue;
    }

    public function getPostCatalogues()
    {
        $this->postCatalogue->toArray();
        // Thêm cột depth vào từng node
        foreach ($this->postCatalogue as &$node) {
            $depth = 0;
            foreach ($this->postCatalogue as $parent) {
                if ($node['_lft'] >= $parent['_lft'] && $node['_rgt'] <= $parent['_rgt']) {
                    $depth++;
                }
            }

            $node['depth'] = $depth - 1;
        }

        return $this->postCatalogue;
    }
}
