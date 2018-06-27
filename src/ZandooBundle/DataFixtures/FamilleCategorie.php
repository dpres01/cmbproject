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
		$cat2->setLibelle('electroménager')->setNumOrdre(2)->setActif(1)->setFamille($famille1);
		$manager->persist($cat2);
		$cat3 = new Categorie();
		$cat3->setLibelle('arts de la table')->setNumOrdre(3)->setActif(1)->setFamille($famille1);
		$manager->persist($cat3);
		$cat4 = new Categorie();
		$cat4->setLibelle('décoration')->setNumOrdre(4)->setActif(1)->setFamille($famille1);
		$manager->persist(cat4);
		$cat5 = new Categorie();
		$cat5->setLibelle('linge de maison')->setNumOrdre(5)->setActif(1)->setFamille($famille1);
		$manager->persist($cat5);
		$cat6 = new Categorie();
		$cat6->setLibelle('bricolage')->setNumOrdre(6)->setActif(1)->setFamille($famille1);
		$manager->persist($cat6);
		$cat7 = new Categorie();
		$cat7->setLibelle('Jardinage')->setNumOrdre(7)->setActif(1)->setFamille($famille1);
		$manager->persist($cat7);
		$cat8 = new Categorie();
		$cat8->setLibelle('Vêtements')->setNumOrdre(8)->setActif(1)->setFamille($famille1);
		$manager->persist($cat8);
		$cat9 = new Categorie();
		$cat9->setLibelle('Accessoires & Bagagerie')->setNumOrdre(9)->setActif(1)->setFamille($famille1);
		$manager->persist($cat8);
		$cat10 = new Categorie();
		$cat10->setLibelle('Montres & Bijoux')->setNumOrdre(10)->setActif(1)->setFamille($famille1);
		$manager->persist($cat9);
		$cat11 = new Categorie();
		$cat11->setLibelle('Equipement bébé')->setNumOrdre(11)->setActif(1)->setFamille($famille1);
		$manager->persist($cat10);
		$cat12 = new Categorie();
		$cat12->setLibelle('Vêtements bébé')->setNumOrdre(12)->setActif(1)->setFamille($famille1);
		$manager->persist($cat11);
		
		$famille2 = new Famille();
		$famille2->setLibelle('services')->setNumOrdre(2)->setActif(1);
		$cat13 = new Categorie();
		$cat13->setLibelle('Prestations de services')->setNumOrdre(13)->setActif(1)->setFamille($famille2);
		$manager->persist($cat13);
		$cat14 = new Categorie();
		$cat14->setLibelle('Billetterie')->setNumOrdre(14)->setActif(1)->setFamille($famille2);
		$manager->persist($cat14);
		$cat15 = new Categorie();
		$cat15->setLibelle('Evénements')->setNumOrdre(15)->setActif(1)->setFamille($famille2);
		$manager->persist($cat15);
		$cat16 = new Categorie();
		$cat16->setLibelle('Covoiturage')->setNumOrdre(16)->setActif(1)->setFamille($famille2);
		$manager->persist($cat16);
			
		$famille3 = new Famille();
		$famille3->setLibelle('materiel professionnel')->setNumOrdre(3)->setActif(1);
		$cat17 = new Categorie();
		$cat17->setLibelle('Matériel Agricole')->setNumOrdre(17)->setActif(1)->setFamille($famille3);
		$manager->persist($cat17);
		$cat18 = new Categorie();
		$cat18->setLibelle('Transport - Manutention')->setNumOrdre(18)->setActif(1)->setFamille($famille3);
		$manager->persist($cat18);
		$cat19 = new Categorie();
		$cat19->setLibelle('BTP - Chantier Gros-oeuvre')->setNumOrdre(19)->setActif(1)->setFamille($famille3);
		$manager->persist($cat19);
		$cat20 = new Categorie();
		$cat20->setLibelle('Outillage - Matériaux 2nd-oeuvre')->setNumOrdre(20)->setActif(1)->setFamille($famille3);
		$manager->persist($cat20);
		$cat21 = new Categorie();
		$cat21->setLibelle('Équipements Industriels')->setNumOrdre(21)->setActif(1)->setFamille($famille3);
		$manager->persist($cat21);
		$cat22 = new Categorie();
		$cat22->setLibelle('Restauration - Hôtellerie')->setNumOrdre(22)->setActif(1)->setFamille($famille3);
		$manager->persist($cat22);
		$cat23 = new Categorie();
		$cat23->setLibelle('Fournitures de Bureau')->setNumOrdre(23)->setActif(1)->setFamille($famille3);
		$manager->persist($cat23);
		$cat24 = new Categorie();
		$cat24->setLibelle('Commerces & Marchés')->setNumOrdre(24)->setActif(1)->setFamille($famille3);
		$manager->persist($cat24);
		$cat25 = new Categorie();
		$cat25->setLibelle('Matériel Médical')->setNumOrdre(25)->setActif(1)->setFamille($famille3);
		$manager->persist($cat25);
		
		$famille4 = new Famille();
		$famille4->setLibelle('multimedia')->setNumOrdre(4)->setActif(1);
		
		$famille5 = new Famille();
		$famille5->setLibelle('immobilier')->setNumOrdre(4)->setActif(1);
		
		$famille6 = new Famille();
		$famille6->setLibelle('emploi')->setNumOrdre(6)->setActif(1);
		
		$famille6 = new Famille();
		$famille6->setLibelle('autres')->setNumOrdre(6)->setActif(1);
	}
}
