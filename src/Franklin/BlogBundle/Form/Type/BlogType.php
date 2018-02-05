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
			->add('locale')
			->add('keywords')
			->add('tag')
			->add('type')
			->add('title')
			->add('subtitle')
			->add('description')
			->add('text')
			->add('appendText')
			->add('imageUrlCover')
			->add('imageAltCover')
			->add('imageUrlOne')
			->add('imageAltOne')
			->add('imageUrlTwo')
			->add('imageAltTwo')
			->add('imageUrlThree')
			->add('imageAltThree')
			->add('imageUrlFour')
			->add('imageAltFour')
			->add('youtubeVideoLink')
			->add('fechaCreacion')
			->add('fechaActualizacion');
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