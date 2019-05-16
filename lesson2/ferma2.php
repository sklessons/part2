<?php

ini_set('error_reporting', E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class Animal
{
    public $voice;

    public $step = 'top-top';

    public function __construct()
    {
        $this->walk();
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

class Bird extends Animal
{
    public $fly = 'vzih';

    public function tryToFly()
    {
        echo $this->fly . '<br />';
    }

    public function walk()
    {
        return $this->tryToFly();
    }
}

class Hoff extends Animal
{

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

    // protected static function random($arr, $list)
    // {
    //     $key = rand(0, count($arr) - 1);
    //
    //     if (in_array($key, $list)) {
    //         return self::random($arr, $list);
    //     } else {
    //         return $key;
    //     }
    // }

    public function rollCall()
    {
        shuffle($this->animals);

        foreach ($this->animals as $animal) {
            $animal->say();
        }
    }

}

class BirdFarm extends Farm
{
    public function showAnimalsCount()
    {
        return count($this->getAnimals());
    }

    public function addAnimal(Animal $animal)
    {
        parent::addAnimal($animal);

        echo 'Птиц на ферме: ' . $this->showAnimalsCount() . '<br />';
    }
}

class HoffFarm extends Farm
{

}

class Fermer
{
    public function addAnimal(Farm $farm, Animal $animal)
    {
        return $farm->addAnimal($animal);
    }

    public function rollCall(Farm $farm)
    {
        return $farm->rollCall($farm);
    }

    public function check(Farm $farm)
    {
        return $farm->getAnimals();
    }
}

class Pig extends Hoff
{
    public $voice = 'Pig'; //string
}

class Cow extends Hoff
{
    public $voice = 'Cow';
}

class Chicken extends Bird
{
    public $voice = 'Chicken';
}

class Goose extends Bird
{
    public $voice = 'Goose';
}

class Turkey extends Bird
{
    public $voice = 'Turkey';
}

class Horse extends Hoff
{
    public $voice = 'Horse';
}


function main() : void
{
    $hoff = new HoffFarm;
    $bird = new BirdFarm;

    $fermer = new Fermer();

    $fermer->addAnimal($hoff, new Cow);
    $fermer->addAnimal($hoff, new Pig);
    $fermer->addAnimal($hoff, new Pig);

    $fermer->addAnimal($bird, new Chicken);
    $fermer->addAnimal($bird, new Turkey);
    $fermer->addAnimal($bird, new Turkey);
    $fermer->addAnimal($bird, new Turkey);

    $fermer->addAnimal($hoff, new Horse);
    $fermer->addAnimal($hoff, new Horse);

    $fermer->addAnimal($bird, new Goose);

    $fermer->rollCall($bird);
    $fermer->rollCall($hoff);

    #echo '<pre>';
    #print_r($fermer->check($hoff));
    #echo '</pre>';

    echo '<pre>';
    var_dump('12345');
    echo '</pre>';
}

main();

//также на птичей ферме можно сделать так:
class ExtBirdFarm extends Farm
{

    public function check()
    {
        echo 'Птиц на ферме: ' . count($this->getAnimals()) . '<br />';

        return $this;
    }


    public function addAnimal(Animal $animal)
    {
        parent::addAnimal($animal);

        return $this;
    }
}

// с полиморфизмом без parent
class ExtBirdFarmTwo extends ExtBirdFarm
{
    public function addAnimal(Animal $animal)
    {
        $this->animals[] = $animal;

        return $this->check;
    }
}

//тогда
$birdExt = new ExtBirdFarm;
//$fermer->addAnimal($birdExt, new Turkey)->check();
