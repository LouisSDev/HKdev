<?php


interface DatabaseEntity
{
    public function save();
    public function delete();
    public function createFromResults();
}