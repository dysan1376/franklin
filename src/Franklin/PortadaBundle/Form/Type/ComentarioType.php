<?php

namespace Franklin\PortadaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ComentarioType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
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
			->add('comentario', 'textarea', array(
			    'attr' => array('style' => 'height:100px'),
			));
      }
		

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Franklin\PortadaBundle\Entity\Comentario',
			));
	}

	public function getName()
	{
		return 'comentario_table';
	}
}