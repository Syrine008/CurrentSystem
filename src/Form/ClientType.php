<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Achat;
use App\Form\AchatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe')
            ->add('id_type')
            ->add('id_file')
            ->add('date_delivre')
            ->add('num_pass')
            ->add('date_naissance')
            ->add('nationalite')
            ->add('adresse')
            ->add('telephone')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
