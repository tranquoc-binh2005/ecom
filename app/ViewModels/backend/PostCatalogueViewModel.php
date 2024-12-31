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
            $depth = 0; // Độ sâu mặc định ban đầu

            // Kiểm tra tất cả các "parent" node
            foreach ($this->postCatalogue as $parent) {
                if ($node['_lft'] >= $parent['_lft'] && $node['_rgt'] <= $parent['_rgt']) {
                    $depth++; // Tăng độ sâu nếu tìm thấy node cha
                }
            }

            // Trừ 1 để loại bỏ chính nó (tính đúng depth)
            $node['depth'] = $depth - 1;
        }

        return $this->postCatalogue;
    }
}
