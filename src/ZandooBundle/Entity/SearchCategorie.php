<?php
namespace ZandooBundle\Entity;

class SearchCategorie
{    
    public static $SELECT_GROUP = array(
		1 => 'EMPLOI',
		2 => 'VEHICULES',
		3 => 'IMMOBILIER',
		4 => 'VACANCES',
		5 => 'MULTIMEDIA',
		6 => 'MATERIEL PROFESSIONNEL',
		7 => 'SERVICES',
		8 => 'MAISON',
		9 => 'AUTRES',
		10 => '',
            );
	
	 public static $SELECT_GROUP_OPTION = array(
		1  => 1,
		2  => 2,
		3  => 2,
		4  => 2,
		5  => 2,
		6  => 2,
		7  => 2,
		8  => 2,
		9  => 2,
		10 => 2, 
		11 => 3,
		12 => 3,
		13 => 3,
		14 => 3,
		15 => 3,
		16 => 4,
		17 => 4,
		18 => 4,
		19 => 4,
		20 => 4,
		21 => 5,
		22 => 5,
		23 => 5,
		24 => 5,
		25 => 5,
		26 => 5,
		27 => 5,
		28 => 5,
		29 => 5,
		30 => 5,
		31 => 5,
		32 => 5,
		33 => 5,
		34 => 5,
		35 => 6,
		36 => 6,
		37 => 6,
		38 => 6,
		39 => 6,
		40 => 6,
		41 => 6,
		42 => 6,
		43 => 6,
		44 => 7,
		45 => 7,
		46 => 7,
		47 => 7,
		48 => 7,
		49 => 8,
		50 => 8,
		51 => 8,
		52 => 8,
		53 => 8,
		54 => 8,
		55 => 8,
		56 => 8,
		57 => 8,
		58 => 8,
		59 => 8,
		60 => 8,
		61 => 8,
		62 => 9,
    );
	
    //Variable généré avec un script php une fois récupéré donnée depuis la table categorie de la BDD.
    //voir fin fichier exemple du script
    public static $SELECT_OPTION = array(
		1  => 'Offres d\'emploi',
		2  => 'Voitures',
		3  => 'Motos',
		4  => 'Caravaning',
		5  => 'Utilitaires',
		6  => 'Equipement Auto',
		7  => 'Equipement Moto',
		8  => 'Equipement Caravane',
		9  => 'Nautisme',
		10 => 'Equipement Nautisme', 
		11 => 'Ventes immobilières',
		12 => 'Immobilier neuf',
		13 => 'Locations',
		14 => 'Colocations',
		15 => 'Bureaux & Commerces',
		16 => 'Locations & Gîtes',
		17 => 'Chambres d\'hôtes',
		18 => 'Campings',
		19 => 'Hôtels',
		20 => 'Hébergements insolites',
		21 => 'Informatique',
		22 => 'Consoles & Jeux vidéo',
		23 => 'Image & Son',
		24 => 'Téléphonie',
		25 => 'DVD / Films',
		26 => 'CD / Musique',
		27 => 'Livres',
		28 => 'Animaux',
		29 => 'Vélos',
		30 => 'Sports & Hobbies',
		31 => 'Instruments de musique',
		32 => 'Collection',
		33 => 'Jeux & Jouets',
		34 => 'Vins & Gastronomie',
		35 => 'Matériel Agricole',
		36 => 'Transport - Manutention',
		37 => 'BTP - Chantier Gros-oeuvre',
		38 => 'Outillage - Matériaux 2nd-oeuvre',
		39 => 'Équipements Industriels',
		40 => 'Restauration - Hôtellerie',
		41 => 'Fournitures de Bureau',
		42 => 'Commerces & Marchés',
		43 => 'Matériel Médical',
		44 => 'Prestations de services',
		45 => 'Billetterie',
		46 => 'Evénements',
		47 => 'Cours particuliers',
		48 => 'Covoiturage',
		49 => 'Ameublement',
		50 => 'Electroménager',
		51 => 'Arts de la table',
		52 => 'Décoration',
		53 => 'Linge de maison',
		54 => 'Bricolage',
		55 => 'Jardinage',
		56 => 'Vêtements',
		57 => 'Chaussures',
		58 => 'Accessoires & Bagagerie',
		59 => 'Montres & Bijoux',
		60 => 'Equipement bébé',
		61 => 'Vêtements bébé',
		62 => 'Autres',
    );
	
   /**
	*	
	*	$cnt = 0;
	*	foreach($categorie AS $key => $val)
	*	{
	*		$cnt++; 
	*		echo $cnt." => '".ucfirst($val)."',<br/>";
	*	}
	*
	**/
	
	public function getSelectGroup()
	{  
	    return self::$SELECT_GROUP;
	}
	
	public function getSelectGroupOption()
	{
	    return self::$SELECT_GROUP_OPTION;
	}
	
	public function getSelectOption()
	{
	    return self::$SELECT_OPTION;
	}
}

