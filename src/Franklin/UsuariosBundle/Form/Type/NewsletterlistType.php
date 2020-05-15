<?php

namespace Franklin\UsuariosBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class NewsletterlistType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('email')
			->add('isActive')
			->add('fecha');
      }
		

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Franklin\UsuariosBundle\Entity\Newsletterlist',
			));
	}

	public function getName()
	{
		return 'newsletterlist_table';
	}
}