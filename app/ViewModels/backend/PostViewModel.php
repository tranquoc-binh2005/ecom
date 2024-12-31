<?php
namespace App\ViewModels\backend;

class PostViewModel
{
    protected $post;
    public function __construct($post)
    {
        $this->post = $post;
    }

    public function getPosts()
    {
        $this->post->toArray();
        // Thêm cột depth vào từng node
        foreach ($this->post as &$node) {
            $depth = 0; // Độ sâu mặc định ban đầu

            // Kiểm tra tất cả các "parent" node
            foreach ($this->post as $parent) {
                if ($node['_lft'] >= $parent['_lft'] && $node['_rgt'] <= $parent['_rgt']) {
                    $depth++; // Tăng độ sâu nếu tìm thấy node cha
                }
            }

            // Trừ 1 để loại bỏ chính nó (tính đúng depth)
            $node['depth'] = $depth - 1;
        }

        return $this->post;
    }
}
