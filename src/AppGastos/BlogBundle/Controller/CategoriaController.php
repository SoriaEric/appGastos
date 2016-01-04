<?php

namespace AppGastos\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppGastos\BlogBundle\Entity\Categoria;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//use AppGastos\BlogBundle\Form\Type\CategoriaType;
//use Symfony\Component\Form\FormBuilderInterface;

class CategoriaController extends Controller {

    /**
     * 
     * @return type
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('AppGastosBlogBundle:Categoria')
                ->getAllOrderedByName();



        return $this->render('AppGastosBlogBundle:Categoria:index.html.twig', array(
                    'titulo' => 'Categorías del blog',
                    'menuActive' => 'categorias', //Coloca calse active al botón del menú categorías
                    'modalEliminar' => True, //Para pintar el modal que elimina una categoría
                    'modalEditar' => True, //Para pintar el modal que elimina una categoría                    
                    'categorias' => $categorias
                        )
        );
    }

    /**
     * 
     * @param type $categoriaTitulo
     * @return type
     * @throws type
     */
    public function verAction($categoriaTitulo) {
        $categoria = new Categoria();
        if (!$categoria) {
            throw $this->createNotFoundException('Esta categoría no existe');
        }

        return $this->render('AppGastosBlogBundle:Categoria:ver.html.twig');
    }

    /**
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function editarAction($id) {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('AppGastosBlogBundle:Categoria')
                ->findOneById($id);
        if (!$categoria) {
            throw $this->createNotFoundException('Esta categoría no existe');
        }
//        $form = $this->createForm(CategoriaType::class, $categoria);

        $form = $this->createFormBuilder($categoria)
                ->setAction($this->generateUrl('blog_editar_Confirmar_categoria'))
                ->add('titulo', TextType::class)
                ->add('descripcion', TextareaType::class)
                ->add('posicion', IntegerType::class)
                ->add('save', SubmitType::class, array('label' => 'Guardar'))
                ->getForm();

        //Crear el form de libros web y segir los pasos.





        return $this->render('AppGastosBlogBundle:Categoria:editar.html.twig', array(
                    'form' => $form->createView(),
                    'titulo' => 'Editar una categoría',
                    'menuActive' => 'categorias', //Coloca calse active al botón del menú categorías
        ));
    }

    /**
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function editarConfirmarAction(Request $request) {

        $categoria = new Categoria();

        $form = $this->createFormBuilder($categoria)
                ->add('titulo', TextType::class)
                ->add('descripcion', TextareaType::class)
                ->add('posicion', IntegerType::class)
                ->add('save', SubmitType::class, array('label' => 'Guardar'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($categoria);
            $em->flush();
            return $this->redirectToRoute('blog_categorias');
        }

        return $this->render('AppGastosBlogBundle:Categoria:editar.html.twig', array(
                    'form' => $form->createView(),
                    'titulo' => 'Editar una categoría',
                    'menuActive' => 'categorias', //Coloca calse active al botón del menú categorías
        ));



        
        
        
        
        
//
//
//        $em = $this->getDoctrine()->getManager();
//        $categoria = $em->getRepository('AppGastosBlogBundle:Categoria')
//                ->findOneById($id);
//        if (!$categoria) {
//            throw $this->createNotFoundException('Esta categoría no existe');
//        }
////        $form = $this->createForm(CategoriaType::class, $categoria);
//
//        $em->persist($categoria);
//        $em->flush();
//
//        return $this->redirectToRoute('blog_categorias');
    }

    /**
     * Función que elimina una categoría
     *
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function eliminarAction($id) {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('AppGastosBlogBundle:Categoria')
                ->findOneById($id);
        if (!$categoria) {
            throw $this->createNotFoundException('Esta categoría no existe');
        }
        $em->remove($categoria);
        $em->flush();
        //Le pasamos el mesaje de todo ok y lo mandamos a home
        $this->addFlash(
                'done', 'Se ha eliminado la categoría ' . $categoria->getTitulo() . ' correctamente.'
        );

        return $this->redirectToRoute('blog_categorias');
    }

    public function insertarAction() {
        $categoria = new Categoria;
        $categoria->setTitulo('una categoria');
        $categoria->setDescripcion('Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años');
        $categoria->setPosicion();
        $em = $this->getDoctrine()->getManager();
        $em->persist($categoria);
        $em->flush();

        //Le pasamos el mesaje de todo ok y lo mandamos a home
        $this->addFlash(
                'done', 'Se ha insertado la categoría ' . $categoria->getTitulo() . ' correctamente.'
        );
        return $this->redirectToRoute('blog_categorias');
    }

}

//return $this->redirectToRoute('homepage');
//throw new \Exception('Something went wrong!');
