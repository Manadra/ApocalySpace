<?php

class Top
{
	private $_topName;
	private $_usersList = array();		// Informations sur les utilisateurs
	private $_valueList = array();		// "Points" selon classement (niveau tech, res militaire, nb pop)

	/* Constructeur de la classe */
	public function __construct( $see = "demography", $startPosition = 0, $size = 10 ) {
		/* Compte les niveaux des technologies des utilisateurs */
		if( $see == "technology" )
		{
			$this->_topName = "Classement technologiques";
		}
		/* Compte le ressources dépensés en vaisseaux construit par les utilisateurs*/
		else if( $see == "military" )
		{
			$this->_topName = "Classement militaires";
		}
		/* Compte la population des utilisateurs */
		else 
		{
			$this->_topName = "Classement démographique";
			$this->_usersList = $this->getUsersList( $size, $startPosition );
		}
	}
	
	/** Récupère une liste de utilisateurs (selon $size [DEFAUT : 10]) pour le classement de type "Démographique"
	 * @param int $size				:	taille de la liste (plus elle est grande, plus la requête sera longue à effectuer !)
	 * @param int $startPosition	:	position de départ
	 */
	private function getUsersList( $size = 10, $startPosition = 0 )
	{
		/* Si on arrive sur la page de classement "principale",
			on effectue une recherche sur la moitié supérieur aux nombre d'habitants
			moyen retournée par MySql [SELECT AVG(pl_population)] */
		if( $startPosition == 0 )
		{
			$sql = MyPDO::get();
			$rq = $sql->prepare('
				SELECT planets.pl_population, users.id, users.username, users.factionName
				FROM planets
				JOIN users ON planets.pl_userId = users.id
				WHERE planets.pl_population > (SELECT AVG(pl_population) FROM planets)
			');
			$data = array();
			$rq->execute($data) or die(print_r($rq->errorInfo()));

			$array = array();
			while( $row = $rq->fetch() )
				$array[] = $row;
			
			/* Au cas où :
				si le nombre de retour est inférieur à la taille souhaitée,
				on check sur toute la BDD. Dans tous les cas, on renvoit les mêmes données. */
			if( count($array) < $size )
			{
				unset($array);
				$rq = $sql->prepare('
					SELECT planets.pl_population, users.id, users.username, users.factionName
					FROM planets
					JOIN users ON planets.pl_userId = users.id
				');
				$data = array();
				$rq->execute($data) or die(print_r($rq->errorInfo()));
				
				while( $row = $rq->fetch() )
					$array[] = $row;
			}
			return $array;
		}
		else {
		
		}
	}
}