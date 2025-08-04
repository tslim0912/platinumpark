<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Traits;

use App\Category;
use App\ProductCategory;
use App\SKUCategory;

trait NetworkTraits {

    // get maximum treeview layer
    protected $maximum_network_treeview_level = '1000000';

    public function getNetwork($networks) {

        $network_tree = [];

        foreach ($networks as $key => $network) {
            $network_tree[$key]["id"] = $network->id;
            $network_tree[$key]["parent_id"] = $network->parent_id;
            $network_tree[$key]["name_en"] = $network->name_en;
            $network_tree[$key]["name_cn"] = $network->name_cn;
            $network_tree[$key]["type"] = $network->type;
            $network_tree[$key]["sequence"] = $network->sequence;
            $network_tree[$key]["is_show_on_nav"] = $network->is_show_on_nav;
            $network_tree[$key]["created_at"] = $network->created_at;
        }

        return $this->buildTree($network_tree, 0, 1);
    }

    public function getProductCategoryNetwork($product, $is_disabled = 0) {

        $network_tree = [];

        $category = Category::orderBy("id", "asc")->get();
        $productCategory = ProductCategory::where("product_id", $product->id)
                ->get()
                ->pluck("category_id")
                ->toArray();

        foreach ($category as $key => $network) {
            $network_tree[$key]["id"] = $network->id;
            $network_tree[$key]["parent_id"] = $network->parent_id;
            $network_tree[$key]["name_en"] = $network->name_en;
            $network_tree[$key]["name_cn"] = $network->name_cn;
            $network_tree[$key]["type"] = $network->type;
            $network_tree[$key]["sequence"] = $network->sequence;
            $network_tree[$key]["is_checked"] = (in_array($network->id, $productCategory)) ? true : false;
            $network_tree[$key]["is_disabled"] = $is_disabled;
            $network_tree[$key]["created_at"] = $network->created_at;
        }

        $network_tree_details = $this->buildTree($network_tree, 0, 1);

        return $network_tree_details;
    }

    public function getSKUCategoryNetwork($sku, $is_disabled = 0) {

        $network_tree = [];

        $category = Category::orderBy("id", "asc")->get();
        $skuCategory = SKUCategory::where("sku_id", $sku->id)
                ->get()
                ->pluck("category_id")
                ->toArray();

        foreach ($category as $key => $network) {
            $network_tree[$key]["id"] = $network->id;
            $network_tree[$key]["parent_id"] = $network->parent_id;
            $network_tree[$key]["name_en"] = $network->name_en;
            $network_tree[$key]["name_cn"] = $network->name_cn;
            $network_tree[$key]["type"] = $network->type;
            $network_tree[$key]["sequence"] = $network->sequence;
            $network_tree[$key]["is_checked"] = (in_array($network->id, $skuCategory)) ? true : false;
            $network_tree[$key]["is_disabled"] = $is_disabled;
            $network_tree[$key]["created_at"] = $network->created_at;
        }

        $network_tree_details = $this->buildTree($network_tree, 0, 1);

        return $network_tree_details;
    }

    public function buildTree(array $elements, $parent_id = 0, $count = 1) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parent_id) {
                if ($count <= $this->maximum_network_treeview_level) {
                    $children = $this->buildTree($elements, $element['id'], $count + 1);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
        }
        return $branch;
    }

}
