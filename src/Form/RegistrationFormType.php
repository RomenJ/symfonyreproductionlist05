<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //Importante
        $entity = $builder->getData();
        
        /* Los admin son como los vampiros, sólo un admin puede hacer un admin
        */
        $rolesChoices = [
            'User' => 'ROLE_USER',
        ];
        
        if ($entity->getRoles() === ['ROLE_ADMIN']) {
            $rolesChoices['Admin'] = 'ROLE_ADMIN';
        }


        $builder
            ->add('username')
            ->add('email')
            ->add('telephone')
        
            ->add('roles', ChoiceType::class, [
                'choices' => $rolesChoices,
                'expanded' => true,
                'multiple' => true,
                'data' => $entity->getRoles() // Current roles assigned..
            ])



            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
