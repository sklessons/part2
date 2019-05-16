<?php

class Forge
{
    public function burn($object)
    {
        $flame = $object->burn();
        echo $flame->render((string)$object) . '<br />';
    }
}


interface Flame
{
    public function render($name);
}


class BlueFlame implements Flame
{
    public function render($name)
    {
        return $name . " <span style='color:#070bff'>BlueFlame</span>";
    }
}

class RedFlame implements Flame
{
    public function render($name)
    {
        return $name . " <span style='color:#f00'>RedFlame</span>";
    }
}

class Smoke implements Flame
{
    public function render($name)
    {
        return $name . " <span style='color:#ddd'>Smoke</span>";
    }
}

trait HelpToString
{
    public function __toString()
    {
        return get_class($this);
    }
}

//универсально + полиморфизм
trait RandomFlame
{
    protected $flames = [
        'Smoke', 'BlueFlame', 'RedFlame'
    ];

    public function burn()
    {
        return new $this->flames[array_rand($this->flames, 1)];
    }
}


// 5 objects
class Piano
{
    use HelpToString;

    public function burn()
    {
        return new Smoke;
    }
}

class Apple
{
    use HelpToString;

    public function burn()
    {
        return new RedFlame;
    }
}

class Plain
{
    use HelpToString;

    public function burn()
    {
        return new BlueFlame;
    }
}

class Toy
{
    use HelpToString;

    public function burn()
    {
        return new BlueFlame;
    }
}

class Book
{
    use HelpToString;

    public function burn()
    {
        return new Smoke;
    }
}
// end



// наслаждаемся еще полиморфизмом
class Bang implements Flame
{
    public function render($name)
    {
        return $name . " <span style='color:#d6cb2b'>BAAANG!!!</span>";
    }
}

class Space
{
    use HelpToString;
    use RandomFlame;

    public function __construct()
    {
        array_push($this->flames, 'Bang');
    }
}

$forge = new Forge;

$forge->burn(new Piano);
$forge->burn(new Plain);
$forge->burn(new Toy);
$forge->burn(new Book);
$forge->burn(new Apple);

$forge->burn(new Space);
