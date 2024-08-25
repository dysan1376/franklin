<?php

namespace Franklin\PortadaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Franklin\PortadaBundle\Entity\Descripcion;

use Franklin\PortadaBundle\Form\Type\DescripcionType;


class ServicioType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('slug')
			->add('slugEs')
			->add('slugEn')
			->add('slugPt')
			->add('slugIt')
			->add('locale', 'choice', array(
				'choices' => array(
					'es' => 'Español',
					'en' => 'English',
					'pt' => 'Português',
					'it' => 'Italiano'
				),
				'required' => true
			))
			->add('title')
			->add('subtitle')
			->add('keywords', 'textarea', array(
			    'attr' => array('style' => 'height:100px'),
			))
			->add('description', 'textarea', array(
			    'attr' => array('style' => 'height:100px'),
			))
			->add('paragraphOne', 'textarea', array(
			    'attr' => array('style' => 'height:100px'),
			))
			->add('paragraphTwo', 'textarea', array(
			    'attr' => array('style' => 'height:100px'),
			))
			->add('paragraphThree', 'textarea', array(
			    'attr' => array('style' => 'height:100px'),
			))
			->add('paragraphFour', 'textarea', array(
			    'attr' => array('style' => 'height:100px'),
			))
			->add('imageUrlMain')
			->add('imageAltMain')
			->add('imageUrlSecondary')
			->add('imageAltSecondary')
			->add('appendText', 'textarea', array(
			    'attr' => array('style' => 'height:100px'),
			))
			->add('mpn')
			->add('ratingValue')
			->add('reviewCount')
			->add('priceMin')
			->add('priceMax')
			->add('currency', 'choice', array(
				'choices' => array(
					'$' => 'USD Dollar',
					'€' => 'Euro'
				),
				'required' => true
			))
			->add('honorarios', 'choice', array(
				'choices' => array(
					'TIPO1' => 'Tipo 1',
					'TIPO2' => 'Tipo 2',
					'TIPO3' => 'Tipo 3',
					'TIPO4' => 'Tipo 4'
				),
				'required' => true
			));
      }
		

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Franklin\PortadaBundle\Entity\Servicio',
			));
	}

	public function getName()
	{
		return 'caso_table';
	}
}