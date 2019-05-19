<?php

namespace Franklin\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class BlogType extends AbstractType
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
			->add('keywords')
			->add('tag', 'choice', array(
				'choices' => array(
					'plástica' => 'Plástica',
					'información' => 'Información',
					'tendencias' => 'Tendencias',
					'otros' => 'Otros'
				),
				'required' => true
			))
			->add('type', 'choice', array(
				'choices' => array(
					'default' => 'Default',
					'image' => 'Image',
					'text' => 'Text',
					'video' => 'Video',
					'quote' => 'Quote'
				),
				'required' => true
			))
			->add('title')
			->add('subtitle')
			->add('description')
			->add('text')
			->add('appendText')
			->add('cover')
			->add('altCover')
			->add('background')
			->add('altBackground')
			->add('first')
			->add('altFirst')
			->add('second')
			->add('altSecond')
			->add('third')
			->add('altThird')
			->add('youtubeVideoLink')
			->add('fechaCreacion')
			->add('fechaActualizacion')
			->add('programar', 'checkbox', array(
				    'data' => false,
				    'required' => false
				))
			->add('fechaProgramada', 'datetime', array(
				'input' => 'datetime',
				'widget' => 'single_text',
				'format' => 'yyyy-MM-dd      HH:mm',
				'required' => false,
				));
      }
		

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Franklin\BlogBundle\Entity\Blog',
			));
	}

	public function getName()
	{
		return 'blog_table';
	}
}