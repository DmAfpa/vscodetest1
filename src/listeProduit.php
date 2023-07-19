<?php
/*
  Il faut changer ligne 52 la configuration a la BDD

  Tout le code est dans le meme script afin de faciliter l'intégration dans votre projet.
  Toutefois, ce n'est pas la demande de l'ECF. Ne prenez pas ce code pour modele ... 

*/
namespace produitdmECF;
require 'D:/test_domi/VsCodePhpCours/vendor/autoload.php'; 

class Produit {

	public int 		  $id;
	private String 	$libelle;
	private int 	  $prix;
	private String 	$photo;

  public function __construct(int $id, String $libelle,float $prix, String $photo) { 
      $this->id = $id;
      $this->setLibelle($libelle);
      $this->setPrix($prix);
      $this->setPhoto($photo);
  }

	public function getId(): int {
		return $this->id;
	}
	public function getLibelle(): String {
		return $this->libelle;
	}
	public function setLibelle(String $libelle) {
		$this->libelle = $libelle;
	}

	public function getPrix() {
		return ($this->prix / 100);
	}
	public function setPrix($prix) {
		$this->prix = $prix * 100;
	}

	public function getPhoto(): String {
		return $this->photo;
	}
	public function setPhoto(String $photo) {
		$this->photo = $photo;
	}

  public function __toString() : string {
            return "Produit [". $this->id 	. "," 
                              . $this->getLibelle() . "," 
                              . $this->getPrix() . "," 
                              . $this->getPhoto() 
                            . "]";
  }
}

class Database {
  public function connect() : \PDO {
      try {
          $db = new \PDO('mysql:host=127.0.0.1;charset=utf8;dbname=projetecf','muller','codapppw');
      } catch (\PDOException $ex) {
          die('Erreur : ' .  $ex->getCode() . ' - ' . $ex->getMessage());
      }
      return $db;
  }
}

class DaoProduit {

  private \PDO $db;
  const GET_ALL_PRODUITS = 'select idP, libP, prixP, photoP from produitdm';

  public function __construct() {
      $this->db = (new Database())->connect();
  }
  public function getAllProduits(): \Ds\Vector {
      $statement = $this->db->query(self::GET_ALL_PRODUITS);
      $produits = new \Ds\Vector();
      while (($row = $statement->fetch())) {
          $produits[] = $this->rowToProduit($row);
      }
      return $produits;
  }
  private function rowToProduit($row) : Produit|null {
    try {
        $id       = $row['idP'];
        $libelle  = $row['libP'];
        $prix     = $row['prixP'];
        $photo    = $row['photoP'];
        $produit  = new Produit($id,$libelle,$prix,$photo);
    } catch (\Exception $e) {
        $produit = null;
    }
    return $produit;
  }
}
$daoProduit = new DaoProduit();
$produits = $daoProduit->getAllProduits();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
  <section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                  <h5 class="mb-3">Catalogue</h5>
                  <hr>
              </div>
              <div class="row">
              <?php
                $count = 0;
                foreach ($produits as $key => $produit) {
                  $count++;
              ?>
              <?php if ($count == 4) { $count = 1?>
              </div>
              <div class="row">
              <?php } ?>
                <div class="col-lg-4">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                          <div>
                            <img
                              src="../assets/img/<?=$produit->getPhoto() ?>"
                              class="img-fluid rounded-3" alt="Produit" style="width: 65px;">
                          </div>
                          <div class="ms-3">
                            <h5><?=$produit->getLibelle() ?></h5>
                            <p class="small mb-0"></p>
                          </div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                          <div style="width: 80px;">
                            <h5 class="mb-0"><?=number_format($produit->getPrix(),2,",") ?></h5>
                          </div>
                          <a href="produit.php?id=<?=$produit->getId() ?>" style="color: #cecece;"><i class="fa-solid fa-cart-shopping"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>    
              <?php
                }
              ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  
</body>
</html>