<?php

require_once '../utils.php';
require_once '../connect.php';
require_once '../model/Transaction.php';
require_once 'ConsumerRepository.php';
require_once 'ProductRepository.php';

class TransactionRepository
{
    protected $collection;
    protected $repoConsumer;
    protected $repoProduct;

    public function __construct()
    {
        global $database;

        $this->collection = $database->selectCollection('transaction');
        $this->repoConsumer = new ConsumerRepository();
        $this->repoProduct = new ProductRepository();
    }

    public function getAllConsumers()
    {
        return $this->repoConsumer->getAll();
    }

    public function getAllProducts()
    {
        return $this->repoProduct->getAll();
    }

    public function getById($id)
    {
        $document = $this->collection->findOne(['_id' => stringToObjectID($id)]);
        return $this->mapToTransaction($document);
    }

    public function getAll()
    {
        $documents = $this->collection->find();
        $products = [];

        foreach ($documents as $document) {
            $transaction = $this->mapToTransaction($document);
            if ($transaction) {
                $products[] = $transaction;
            }
        }

        return $products;
    }

    public function create(Transaction $transaction)
    {
        $data = $this->mapToDocument($transaction);
        $this->collection->insertOne($data);
    }

    public function update($id, Transaction $transaction)
    {
        $data = $this->mapToDocument($transaction);
        $this->collection->updateOne(['_id' => stringToObjectID($id)], ['$set' => $data]);
    }

    public function delete($id)
    {
        $this->collection->deleteOne(['_id' => stringToObjectID($id)]);
    }

    private function mapToTransaction($document)
    {
        if (!$document) {
            return null;
        }

        $products = [];
        foreach ($document->products as $product) {
            $transactionItem = new TransactionItem();
            $transactionItem->_id = $product->_id;
            $transactionItem->name = $product->name;
            $transactionItem->price = $product->price;
            $transactionItem->quantity = $product->quantity;
            $products[] = $transactionItem;
        }

        $transaction = new Transaction();
        $transaction->_id = (string)$document->_id;
        $transaction->consumer_id = $document->consumer_id;
        $transaction->consumer_name = $document->consumer_name;
        $transaction->products = $products;
        $transaction->total_price = $document->total_price;
        $transaction->created_at = $document->created_at;

        return $transaction;
    }   

    private function mapToDocument(Transaction $transaction)
    {
        return [
            '_id' => $transaction->_id ? stringToObjectID($transaction->_id) : generateObjectId(),
            'consumer_id' => $transaction->consumer_id,
            'consumer_name' => $transaction->consumer_name,
            'products' => $transaction->products,
            'total_price' => $transaction->total_price,
            'created_at' => $transaction->created_at,
            'updated_at' => $transaction->updated_at,
            'deleted_at' => $transaction->deleted_at,
        ];
    }
}
