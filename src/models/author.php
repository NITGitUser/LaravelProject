<?php

class AuthorModel
{

    public $id;
    public $name;
    public $last_name;
    protected function readValue(string $prompt): string
    {
        return readline($prompt);
    }
    public function __construct($data = null)
    {
        if ($data != null) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->last_name = $data['last_name'];
        } else {
            $this->id = uniqid();
            $this->name = $this->readValue('Enter author name: ');
            $this->last_name = $this->readValue('Enter author last name: ');
        }
    }
}
