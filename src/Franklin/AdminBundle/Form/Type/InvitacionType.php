<?php

namespace Franklin\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class InvitacionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('isActive', 'checkbox', array(
      			'data' => true
      		))
      		->add('fecha', 'datetime', array(
				'input' => 'datetime',
				'widget' => 'single_text',
				'format' => 'yyyy-MM-dd      HH:mm',
				'required' => false,
				))
      		->add('expira', 'datetime', array(
				'input' => 'datetime',
				'widget' => 'single_text',
				'format' => 'yyyy-MM-dd      HH:mm',
				'required' => false,
				))
			->add('paciente', 'entity', array(
				'class' => 'UsuariosBundle:Paciente',
				'property' => 'email',
			));
      }
		

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Franklin\AdminBundle\Entity\Invitacion',
			));
	}

	public function getName()
	{
		return 'invitacion_table';
	}
}