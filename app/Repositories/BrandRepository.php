<?php
namespace App\Repository;

use App\ProductBrand;

class BrandRepository {
    protected $brand;

    public function __construct(ProductBrand $brand) {
        $this->brand = $brand;
    }

    public function all() {
        return $this->brand->all();
    }

    public function find($id) {
        return $this->brand->find($id);
    }

    public function create($att) {

    }
}