<?php

namespace App\Form;

use App\Entity\Listareproduccion;
use App\Entity\Temazo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class ListareproduccionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulolista')
        //    ->add('user')    
          //  ->add('canciones', ClienteAutocompleteField::class)
            //->add('temazo', TemazoAutocompleteField::class)
       
            ->add('canciones', TemazoAutocompleteField::class,[
                // looks for choices from this entity
            
                // used to render a select box, check boxes or radios
                 'multiple' => true,
                // 'autocomplete' => true,
                
            ])

           /* 
            ->add('canciones',EntityType::class, [
                // looks for choices from this entity
                'class' => Temazo::class,
                // used to render a select box, check boxes or radios
                 'multiple' => true,
                 'expanded' => true,
                 'autocomplete' => true,
                
            ])*/


            

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Listareproduccion::class,
        ]);
    }
}
