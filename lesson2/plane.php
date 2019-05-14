<?php

class Plane
{
    private $blackBox;

    public function __construct()
    {
        $this->blackBox = new BlackBox;
    }

    public function flyAndCrush()
    {
        $this->flyProcess();
        $this->crushProcess();
    }

    protected function flyProcess()
    {
        $this->addLog('Fly-fly-fly');
    }

    private function crushProcess()
    {
        $this->addLog('Crushhhh');
    }

    protected function addLog($message)
    {
        $this->blackBox->addLog($message);
    }

    public function getBoxForEngineer(Engineer $engineer)
    {
        $engineer->setBox($this->blackBox);
    }
}

class BlackBox
{
    private $data = [];

    public function addLog($message)
    {
        $this->data[] = $message;
    }

    public function getDataByEngineer(Engineer $engineer)
    {
        return $this->data;
    }
}

class Engineer
{
    private $box = null;

    public function setBox(BlackBox $blackBox)
    {
        $this->box = $blackBox;
    }

    public function takeBox(Plane $plane)
    {
        $plane->getBoxForEngineer($this);

        return $this;
    }

    public function decodeBox()
    {
        echo '<pre>'; print_r($this->box); '</pre>';
    }
}

class SupperPlane extends Plane
{
    protected function flyProcess()
    {
        $this->addLog('Viiiiiiizhs');
    }
}

function main()
{
    $plane1 = new Plane;
    $enginer = new Engineer;

    $plane1->flyAndCrush();

    $plane2 = new SupperPlane;

    $plane2->flyAndCrush();

    $enginer->takeBox($plane1)->decodeBox();
    $enginer->takeBox($plane2)->decodeBox();

}

main();
