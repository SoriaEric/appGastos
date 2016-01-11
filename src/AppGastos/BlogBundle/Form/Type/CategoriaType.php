<?php
namespace AppGastos\BlogBundle\Form\Type;

//use App\Utility\MyService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of CategoriaType
 *
 * @author ignacio
 */
class CategoriaType extends AbstractType
{
//    private $myService;
//
//    public function __construct(MyService $myService)
//    {
//        $this->myService = $myService;
//    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // You can now use myService.
        $builder
            ->add('titulo', TextType::class)
            ->add('descripcion', TextareaType::class)
            ->add('posicion', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Guardar'))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(
        'data_class' => 'AppGastos\BlogBundle\Entity\Categoria',
    ));
}
    
//    public function getName()
//    {
//        return 'categoria';
//    }
}
