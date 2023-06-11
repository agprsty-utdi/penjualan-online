<?php

require_once '../connect.php';
require_once '../utils.php';
require_once '../model/Product.php';

class ProductRepository
{
    protected $collection;

    public function __construct()
    {
        global $database;

        $this->collection = $database->selectCollection('product');
    }

    public function getById($id)
    {
        $document = $this->collection->findOne(['_id' => stringToObjectID($id)]);
        return $this->mapToProduct($document);
    }

    public function getAll()
    {
        $documents = $this->collection->find();
        $products = [];

        foreach ($documents as $document) {
            $product = $this->mapToProduct($document);
            if ($product) {
                $products[] = $product;
            }
        }

        return $products;
    }

    public function create(Product $product)
    {
        $data = $this->mapToDocument($product);
        $this->collection->insertOne($data);
    }

    public function update($id, Product $product)
    {
        $data = $this->mapToDocument($product);
        $this->collection->updateOne(['_id' => stringToObjectID($id)], ['$set' => $data]);
    }

    public function delete($id)
    {
        $this->collection->deleteOne(['_id' => stringToObjectID($id)]);
    }

    private function mapToProduct($document)
    {
        if (!$document) {
            return null;
        }

        $product = new Product();
        $product->_id = (string)$document->_id;
        $product->name = $document->name;
        $product->price = $document->price;
        $product->stock = $document->stock;
        $product->created_at = $document->created_at;

        return $product;
    }   

    private function mapToDocument(Product $product)
    {
        return [
            '_id' => $product->_id ? stringToObjectID($product->_id) : generateObjectId(),
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
            'deleted_at' => $product->deleted_at,
        ];
    }
}
