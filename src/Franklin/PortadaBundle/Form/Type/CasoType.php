<?php

namespace Franklin\PortadaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Franklin\PortadaBundle\Entity\Descripcion;

use Franklin\PortadaBundle\Form\Type\DescripcionType;


class CasoType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('picture')
			->add('hover')
			->add('descripcion', 'collection', array(
                'type'           => new DescripcionType(),
                'by_reference'   => false,
                'allow_delete'   => true,
                'allow_add'      => true,
                'prototype'		 => true,
                ))
			->add('fecha', 'datetime', array(
				'input' => 'datetime',
				'widget' => 'single_text',
				'format' => 'yyyy-MM-dd      HH:mm',
				'required' => false,
				));
      }
		

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Franklin\PortadaBundle\Entity\Caso',
			));
	}

	public function getName()
	{
		return 'caso_table';
	}
}