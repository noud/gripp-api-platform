<?php

namespace App\Form\Type;

use App\Form\Data\LoginData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class LoginType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class,
            [
                'label' => 'login.label.username',
                'translation_domain' => 'login',
            ]
        )
        ->add('password', PasswordType::class,
            [
                'label' => 'login.label.password',
                'translation_domain' => 'login',
            ]
        )
        ->add('_csrf_token', HiddenType::class);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LoginData::class,
        ]);
    }
}
