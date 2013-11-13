<?php

namespace Banko\Bundle\CompteBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * MouvementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MouvementRepository extends EntityRepository
{
   /**
    * 
    * Retourne le montant du compte courant passé en paramètre
    */
    public function getMontantCompteCourant($compte_id)
    {
    	$qb = $this->_em->createQueryBuilder()
    		->select('SUM(m.credit) AS totalCreditTraite, SUM(m.debit) AS totalDebitTraite')
    		->from("BankoCompteBundle:Mouvement", "m")
    		->where("m.compte = '".$compte_id."'")
    		->andWhere('m.traite = 1');

        return $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);	
    }
    
       /**
    * 
    * Retourne le montant du compte prévisionnel
    */
    public function getMontantComptePrevisionnel($compte_id)
    {
    	$qb = $this->_em->createQueryBuilder()
    		->select('SUM(m.credit) AS totalCredit, SUM(m.debit) AS totalDebit')
    		->from("BankoCompteBundle:Mouvement", "m")
    		->where("m.compte = '".$compte_id."'");

        return $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);	
    }
}
