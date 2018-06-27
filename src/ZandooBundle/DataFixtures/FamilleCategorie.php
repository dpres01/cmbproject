<?php
namespace ZandooBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZandooBundle\Entity\Famille;
use ZandooBundle\Entity\Categorie;

class FamilleCategorie{
	public function load(ObjectManager $manager)
    {
		$famille1 = new Famille();
		$famille1->setLibelle('maison')->setNumOrdre(1)->setActif(1);
		$manager->persist($famille1);
		
		$cat1 = new Categorie();
		$cat1->setLibelle('ameublement')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat1);
		$cat2 = new Categorie();
		$cat2->setLibelle('electroménager')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat2);
		$cat3 = new Categorie();
		$cat3->setLibelle('arts de la table')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat3);
		$cat4 = new Categorie();
		$cat4->setLibelle('décoration')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist(cat4);
		$cat5 = new Categorie();
		$cat5->setLibelle('linge de maison')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat5);
		$cat6 = new Categorie();
		$cat6->setLibelle('bricolage')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat6);
		$cat7 = new Categorie();
		$cat7->setLibelle('Jardinage')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat7);
		$cat8 = new Categorie();
		$cat8->setLibelle('Vêtements')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat8);
		$cat8 = new Categorie();
		$cat8->setLibelle('Accessoires & Bagagerie')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat8);
		$cat9 = new Categorie();
		$cat9->setLibelle('Montres & Bijoux')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat9);
		$cat10 = new Categorie();
		$cat10->setLibelle('Equipement bébé')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat10);
		$cat11 = new Categorie();
		$cat11->setLibelle('Vêtements bébé')->setNumOrdre(1)->setActif(1)->setFamille($famille1);
		$manager->persist($cat11);
		
		$famille2 = new Famille();
		$famille2->setLibelle('services')->setNumOrdre(2)->setActif(1);
		$cat12 = new Categorie();
		$cat12->setLibelle('Prestations de services')->setNumOrdre(1)->setActif(1)->setFamille($famille2);
		$manager->persist($cat12);
		$cat13 = new Categorie();
		$cat13->setLibelle('Billetterie')->setNumOrdre(1)->setActif(1)->setFamille($famille2);
		$manager->persist($cat13);
		$cat14 = new Categorie();
		$cat14->setLibelle('Evénements')->setNumOrdre(1)->setActif(1)->setFamille($famille2);
		$manager->persist($cat14);
		$cat15 = new Categorie();
		$cat15->setLibelle('Covoiturage')->setNumOrdre(1)->setActif(1)->setFamille($famille2);
		$manager->persist($cat15);
		
		
		$famille3 = new Famille();
		$famille3->setLibelle('materiel professionnel')->setNumOrdre(3)->setActif(1);
		
		$famille4 = new Famille();
		$famille4->setLibelle('multimedia')->setNumOrdre(4)->setActif(1);
		
		$famille5 = new Famille();
		$famille5->setLibelle('immobilier')->setNumOrdre(4)->setActif(1);
		
		$famille5 = new Famille();
		$famille5->setLibelle('emploi')->setNumOrdre(6)->setActif(1);
	}
}
