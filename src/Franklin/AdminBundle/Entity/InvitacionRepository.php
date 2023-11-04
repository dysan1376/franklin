<?php

namespace Franklin\AdminBundle\Entity;

/**
 * InvitacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InvitacionRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllDesc() 
    {

        $em = $this->getEntityManager();

        $dql = 'SELECT o
                FROM AdminBundle:Invitacion o
                ORDER BY o.id DESC';

        $consulta = $em->createQuery($dql);
        
        $result = $consulta->getResult();
        return $result;

    }
}