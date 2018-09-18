<?php

interface Idade
{
    public function getAge() :int;
}

class Pessoa implements Idade
{
    public function getAge() :int
    {
        return 30;
    }
}

class Exemplo implements ArrayAccess
{
    private $idade;

    public function __construct() {
        $this->container = array(
            "one"   => 1,
            "two"   => 2,
            "three" => 3,
        );
    }

    public function setIdade(Idade $idade) :Exemplo
    {
        $this->idade = $idade->getAge();
        return $this;
    }

    public function getIdade() :int
    {
        return $this->idade;
    }

    public function __toString()
    {
        return 'Essa classe é só um exemplo';
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}

$exemplo = new Exemplo;
$idade = $exemplo->setIdade(new Pessoa)->getIdade();

var_dump($idade);
var_dump($exemplo['three']);
