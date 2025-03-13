<?php
require 'src/models/author.php';

class ResourceModel
{
    public $id;
    public $name;
    public $description;
    protected function readValue(string $prompt): string
    {
        return readline($prompt);
    }
    public function showDetails($id = null): void
    {
        $showHeader = false;
        if ($id == 0) {
            $showHeader = true;
        }
        if ($showHeader) {
            echo "ID\tNAME\tDESCRIPTION\n";
        }
        echo "{$id}\t{$this->name}\t{$this->description}\n";
    }
}

class BookModel extends ResourceModel
{
    public $author;
    public $publisher;
    public $publisher_date;

    public function showDetails($id = null): void
    {
        $showHeader = false;
        if ($id == 0) {
            $showHeader = true;
        }
        if ($showHeader) {
            echo "ID\tNAME\tDESCRIPTION\tAUTHOR\tPUBLISHER\tPUBLISHER DATE\n";
        }

        echo "{$id}\t{$this->name}\t{$this->description}\t\t{$this->author->name}\t{$this->publisher}\t\t{$this->publisher_date}\n";
    }
    public function __construct($data = null)
    {
        if ($data != null) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->description = $data['description'];
            $this->author = new AuthorModel($data['author']);
            $this->publisher = $data['publisher'];
            $this->publisher_date = $data['publisher_date'];
        } else {
            $this->id = uniqid();
            $this->name = $this->readValue('Enter book name: ');
            $this->description = $this->readValue('Enter book description: ');
            $this->author = new AuthorModel();
            $this->publisher = $this->readValue('Enter book publisher: ');
            $this->publisher_date = $this->readValue('Enter book publisher date: ');
        }
    }
}
class OthersModel extends ResourceModel
{
    public $brand;
    public function showDetails($id = null): void
    {
        $showHeader = false;
        if ($id == 0) {
            $showHeader = true;
        }
        if ($showHeader) {
            echo "ID\tNAME\tDESCRIPTION\tBRAND\n";
        }
        echo "{$id}\t{$this->name}\t{$this->description}\t\t{$this->brand}\n";
    }
    public function __construct($data = null)
    {
        if ($data != null) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->description = $data['description'];
            $this->brand = $data['brand'];
        } else {
            $this->id = uniqid();
            $this->name = $this->readValue('Enter resource name: ');
            $this->description = $this->readValue('Enter resource description: ');
            $this->brand = $this->readValue('Enter resource brand: ');
        }
    }
}
