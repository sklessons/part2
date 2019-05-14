<?php

ini_set('error_reporting', E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class Animal
{
    public $voice;

    public $step = 'top-top';

    public function __construct($farm = false)
    {
        if ($farm)
        {
            $this->walk();
        }
    }

    public function say()
    {
        echo $this->voice . '<br />';
    }

    public function walk()
    {
        echo $this->step . '<br />';
    }

}

class Farm
{
    protected $animals;

    public function getAnimals()
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal)
    {
        $this->animals[] = $animal;
    }

    public static function random($arr, $list)
    {
        $key = rand(0, count($arr) - 1);

        if (in_array($key, $list)) {
            return self::random($arr, $list);
        } else {
            return $key;
        }
    }

    public function rollCall()
    {
        shuffle($this->$animals);

        foreach ($this->$animals as $animal) {
            $animal->say();
        }

    }

}

class Pig extends Animal
{
    public $voice = 'Pig'; //string
}

class Cow extends Animal
{
    public $voice = 'Cow';
}

class Chicken extends Animal
{
    public $voice = 'Chicken';
}

$farm = new Farm();

$farm->addAnimal(new Cow);
$farm->addAnimal(new Pig);
$farm->addAnimal(new Pig);
$farm->addAnimal(new Chicken);

echo '<pre>';
print_r($farm->rollCall());
echo '</pre>';
