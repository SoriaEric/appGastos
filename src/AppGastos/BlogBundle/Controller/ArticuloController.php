<?php

namespace AppGastos\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticuloController extends Controller
{
     public function indexAction()
    {
        return $this->render('AppGastosBlogBundle:Articulo:index.html.twig');
    }
    
    public function verAction()
    {
        return $this->render('AppGastosBlogBundle:Articulo:ver.html.twig');
    }
    
    public function editarAction()
    {
        return $this->render('AppGastosBlogBundle:Articulo:editar.html.twig');
    }
    
    public function nuevoAction()
    {
        return $this->render('AppGastosBlogBundle:Articulo:nuevo.html.twig');
    }
    
    public function eliminarAction()
    {
        return $this->render('AppGastosBlogBundle:Articulo:eliminar.html.twig');
    }
}
