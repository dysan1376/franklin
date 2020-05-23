<?php

namespace Franklin\PortadaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class DescripcionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('title')
			->add('locale', 'choice', array(
				'choices' => array(
					'es' => 'Español',
					'en' => 'Inglés',
					'pt' => 'Portugués',
					'it' => 'Italiano'
				),
				'expanded' => false,
				'multiple' => false,
			))
			->add('descripcion');
      }
		

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Franklin\PortadaBundle\Entity\Descripcion',
			));
	}

	public function getName()
	{
		return 'descripcion_table';
	}
}