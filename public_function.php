<?php 

//include('./config.php');

function getAllArticle()
{ global $bdd;
	$reponse = $bdd->query('SELECT * FROM article');
	return $reponse;
}

function getDifferentCategory()
{
	global $bdd;
	$reponse=$bdd->query('SELECT * FROM categorie');
	return $reponse;
}

function getArticleByCategory($id)
{
	global $bdd;
	$reponse=$bdd->query('SELECT * FROM article WHERE idCategorie=$id');
}


/*function getCart()
{ global $bdd;
	$reponse = $bdd->query('
		SELECT DISTINCT COUNT(distinct article.nom) as nbArticle ,SUM(panier.quantite*article.prix)as prixTotal,article.nom,article.description,panier.quantite,article.image1,article.prix
		FROM panier,article,client 
		Where panier.idClient=3 /*panier.idClient*//* AND 
			panier.idArticle=article.id ; ')
	;
	return $reponse;
}*/
function getCartItem()
{
	global $bdd;
	$reponse = $bdd->query('SELECT DISTINCT panier.id,article.nom,panier.quantite,article.image1,article.prix,SUM(panier.quantite*article.prix)as prixT FROM panier,article,client Where panier.idClient=3 AND panier.idArticle=article.id GROUP BY(panier.id)')
	;
	return $reponse;
}
function countArticle()
{
	global $bdd;
	$reponse=$bdd->query('SELECT COUNT(panier.idClient) as nbArticle from panier
   where panier.idClient=3 /*client.id*/;');
	return $reponse;
}
function MakeCartTotal()
{
	global $bdd;
	$reponse=$bdd->query('SELECT SUM(panier.quantite*article.prix) as prixTotal from panier,article
   where panier.idClient=3 and panier.idArticle=article.id /*client.id*/;');
	return $reponse;
}
function getArticleById($id)
{
	$reponse = $bdd->query('SELECT * FROM article WHERE id=$id');
	return $reponse;
}

function updateCart($nb,$id)
{
	global $bdd;
	$req=$bdd->prepare('UPDATE  panier SET quantite=:nb where id=:ID');
	$req->execute(
				array(
						'nb' => $nb,
						'ID' => $id,
					)
				);
}
