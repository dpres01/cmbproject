<?php

namespace ZandooBundle\Repository;
use ZandooBundle\Entity\Annonce;
use ZandooBundle\Entity\Critere;

/**
 * AnnonceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnnonceRepository extends \Doctrine\ORM\EntityRepository
{   
    const MAX_RESULT = 20;
    public function findAnnonceByCritere($critere)
    {   
        $qb = $this->createQueryBuilder('a')
                ->addSelect('img','user')
                ->leftJoin('a.images', 'img')
                ->leftJoin('a.categorie', 'cat')
                ->leftJoin('a.utilisateur', 'user')
                ->andWhere('a.actif = 1');
         !is_null($critere->getOffset()) ?  $critere->setOffset((intval($critere->getOffset()) - 1) * $this::MAX_RESULT) : null ;
         $this->filtrerByCritere($critere, $qb);
         $qb->orderBy('a.id','DESC');
         //dump($critere,$qb->getQuery()->getResult(),$qb->getQuery()->getSQL(),$qb->getQuery()->getParameters());die;
        return  $qb->getQuery()->getResult();
    }
    // nb annonce dans la bdd 
    public function countAllAnnonce($critere) {
        $critere->setOffset('');
        $qb = $this->createQueryBuilder('a');
        $this->filtrerByCritere($critere,$qb);
        return $qb->select('COUNT(a)')->getQuery() ->getSingleScalarResult();
    }
    
    public function nbAnnoncesByCategorie(){
        $qb = $this->createQueryBuilder('a')
                ->addSelect('cat','fam','COUNT(a)')
                ->leftJoin('a.categorie', 'cat')
                ->leftJoin('cat.famille', 'fam') ;
        $qb->groupBy('a.categorie');
        return  $qb->getQuery()->getResult();
    }
    
    private function filtrerByCritere ($critere,$qb){
        
        if(!is_null($critere->getPrixInf()) && !is_null($critere->getPrixSup()) ){
            $qb->andWhere($qb->expr()->between('a.prix', ':prixInf',':prixSup'));
            $qb->setParameters(array('prixInf'=> $critere->getPrixInf(),'prixSup'=>$critere->getPrixSup()));
           
        }
        if(!is_null($critere->getPrixInf()) && is_null($critere->getPrixSup()) ){
            $qb->andWhere($qb->expr()->gte('a.prix', ':prix'));
            $qb->setParameter(':prix', $critere->getPrixInf()); 
        }
        if(is_null($critere->getPrixInf()) && !is_null($critere->getPrixSup()) ){
            $qb->andWhere($qb->expr()->lte('a.prix', ':prix'));
            $qb->setParameter(':prix', $critere->getPrixSup()); 
        }
        if(!is_null($critere->getType())){
            $qb->andWhere($qb->expr()->eq('a.type', ':type'));
            $qb->setParameter(':type', $critere->getType()); 
        }
        
        if(!is_null($critere->getIdUtilisateur())){
            $qb->andWhere($qb->expr()->eq('a.utilisateur', ':id'));
            $qb->setParameter(':id', $critere->getIdUtilisateur()); 
        }
        if(!is_null($critere->getCategorie()) && $critere->getCategorie()!='0'){
            $qb->andWhere($qb->expr()->eq('a.categorie', ':cat'));
            $qb->setParameter(':cat', $critere->getCategorie()); 
        }
        if(!is_null($critere->getTitre())&& !empty($critere->getTitre())){
            $qb->andWhere($qb->expr()->like('lower(a.titre)', ':titre'));
            if(is_null($critere->getTitreUniquement())){
                $qb->orWhere($qb->expr()->like('lower(a.description)', ':titre'));
            }           
            $qb->setParameter(':titre', '%'.strtolower($critere->getTitre()).'%'); 
        }
        if(!is_null($critere->getOffset())){
            $qb->setFirstResult($critere->getOffset())->setMaxResults($this::MAX_RESULT); 
        }
        return $qb;
    }
    
}
