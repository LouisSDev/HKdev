<?php


interface DatabaseEntity
{
    public function save($db);
    public function delete($db);
    public function createFromResults($data);
    public function getValid();
}