<?php

namespace Franklin\UsuariosBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PacienteType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('email')
			->add('isSubscribed')
			->add('fecha');
      }
		

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Franklin\UsuariosBundle\Entity\Paciente',
			));
	}

	public function getName()
	{
		return 'paciente_table';
	}
}