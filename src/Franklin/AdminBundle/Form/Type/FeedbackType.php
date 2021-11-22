<?php

namespace Franklin\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class FeedbackType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('rate')
			->add('feedback', 'textarea')
			->add('posquirurgico')
			->add('paciente', 'entity', array(
				'class' => 'UsuariosBundle:Paciente',
				'property' => 'email',
			));
      }
		

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Franklin\AdminBundle\Entity\Feedback',
			));
	}

	public function getName()
	{
		return 'feedback_table';
	}
}