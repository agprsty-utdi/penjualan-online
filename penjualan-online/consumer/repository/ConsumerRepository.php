<?php

require_once '../connect.php';
require_once '../utils.php';
require_once 'model/Consumer.php';

class ConsumerRepository
{
    protected $collection;

    public function __construct()
    {
        global $database;

        $this->collection = $database->selectCollection('consumer');
    }

    public function getById($id)
    {
        $document = $this->collection->findOne(['_id' => stringToObjectID($id)]);
        return $this->mapToConsumer($document);
    }

    public function getAll()
    {
        $documents = $this->collection->find();
        $consumers = [];

        foreach ($documents as $document) {
            $consumer = $this->mapToConsumer($document);
            if ($consumer) {
                $consumers[] = $consumer;
            }
        }

        return $consumers;
    }

    public function create(Consumer $consumer)
    {
        $data = $this->mapToDocument($consumer);
        $this->collection->insertOne($data);
    }

    public function update($id, Consumer $consumer)
    {
        $data = $this->mapToDocument($consumer);
        $this->collection->updateOne(['_id' => stringToObjectID($id)], ['$set' => $data]);
    }

    public function delete($id)
    {
        $this->collection->deleteOne(['_id' => stringToObjectID($id)]);
    }

    private function mapToConsumer($document)
    {
        if (!$document) {
            return null;
        }

        $consumer = new Consumer();
        $consumer->_id = (string)$document->_id;
        $consumer->name = $document->name;
        $consumer->email = $document->email;
        $consumer->address = $document->address;
        $consumer->phone_number = $document->phone_number;
        $consumer->gender = $document->gender;
        $consumer->created_at = $document->created_at;

        return $consumer;
    }

    private function mapToDocument(Consumer $consumer)
    {
        return [
            '_id' => $consumer->_id ? stringToObjectID($consumer->_id) : generateObjectId(),
            'name' => $consumer->name,
            'email' => $consumer->email,
            'address' => $consumer->address,
            'phone_number' => $consumer->phone_number,
            'gender' => $consumer->gender,
            'created_at' => $consumer->created_at,
            'updated_at' => $consumer->updated_at,
            'deleted_at' => $consumer->deleted_at,
        ];
    }
}
