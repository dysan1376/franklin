<?php

namespace Franklin\PortadaBundle\Entity;

/**
 * ReviewRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReviewRepository extends \Doctrine\ORM\EntityRepository
{
	public function findAllDesc() 
	{

		$em = $this->getEntityManager();

		$dql = 'SELECT o
				FROM PortadaBundle:Review o
				ORDER BY o.id DESC';

		$consulta = $em->createQuery($dql);
		
		$result = $consulta->getResult();
        return $result;

	}
}
