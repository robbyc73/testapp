<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NameController extends Controller
{
    public function indexAction($name,$surname)
    {
        return $this->render('TestBundle:Default:index.html.twig', array('name' => $name, 'surname' => $surname));
    }
}
