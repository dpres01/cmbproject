<?php

namespace ZandooBundle\Repository;

/**
 * AnnonceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContactRepository extends \Doctrine\ORM\EntityRepository
{
    public function findMessageByUtilisateur($id){
       $qb = $this->createQueryBuilder('m');
               $qb->addSelect('a')
                  ->Join('m.annonce', 'a')   
                  ->andWhere('a.utilisateur = :id') 
                  ->setParameter(':id', $id);
        return $qb->getQuery()->getResult();
    }
}
