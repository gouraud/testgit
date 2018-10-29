
<?php
//rajout d'un commentaire
class Adherent

{
	private $_num;
	private $_nom;
	private $_prenom;
 	
 public function hydrate(array $donnees) //va hydrater l'objet adherent avec les bonnes valeurs des attributs

  {
	$num=(int) $donnees['num'];
    $this->setNum($num);
    $this->setNom($donnees['nom']);
	$this->setPrenom($donnees['prenom']);
    print("fonction hydrate</br>");

  }
  
 
  
  public function setNum($num)
  {
  	$num=(int) $num;
  	if ($num>=0)
  		{
  			$this->_num=$num;
  		}
  	else
  	{
  		echo 'erreur sur la cle';
  	}
	
	
  }
  public function setNom($nom)
  {
  	$this->_nom=$nom;
  }
  
public function setPrenom($prenom)
  {
  	$this->_prenom=$prenom;
  }
  
public function getNum()
	{
		return $this->_num;
	}   
	
public function getNOm()
	{
		return $this->_nom;
	}   
	
public function getPrenom()
	{
		return $this->_prenom;
	}   
  
}	

class GestionBaseLivres

{

  private $_Mabase; // Instance de la base de données


  public function __construct($Mabase) //constructeur de la classe

  {

    $this->setDb($Mabase);

  }
  
  
  public function setDb(PDO $Mabase) //setter de l'attribut base
  {
    $this->_db = $Mabase;
  }
  
  public function getAdherent($num)
  {
    $num = (int) $num;

    $q = $this->_db->query('SELECT num, nom, prenom FROM adherent WHERE num = '.$num);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return $donnees;
  }

}


try
{
$db = new PDO('mysql:host=localhost;dbname=biblio2016','test' ,'' );
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
print("connexion base OK</br>");
//$db = new PDO('mysql:host=localhost;dbname=biblio2016', 'root', '');
$base = new GestionBaseLivres($db);
$don=$base->getAdherent(1);
$adherent= new Adherent;
$adherent->hydrate($don);
echo $adherent->getNum();
