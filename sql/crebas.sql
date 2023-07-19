use testdomi;
set SQL_SAFE_UPDATES = 0;
/*
	UC : Gérer le catalogue
*/
 
drop table if exists produitdm;
create table produitdm (
	idP			integer primary key,
	libP		varchar(50),      
	prixP		decimal(8,2),
	photoP  	varchar(50)
);
insert into produitdm values (1,'Affichette', 105.20, 'img1.jpg');
insert into produitdm values (2,'Plantes',42.50, 'img2.jpg');
insert into produitdm values (3,'Decoration porte', 55.50, 'img3.jpg');
insert into produitdm values (4,'Luminaire', 207.00, 'img4.jpg');
insert into produitdm values (5,'Assiette BB', 32.00, 'img5.jpg');
insert into produitdm values (6,'Gant de toilette Personnalisable', 15.48, 'img6.jpg');
insert into produitdm values (7,'Gant de Toilette blanc', 15.48, 'img7.jpg');
insert into produitdm values (8,'Assiette incrustée', 23.00, 'img8.jpg');
insert into produitdm values (9,'Vase design', 187.00, 'img9.jpg');
insert into produitdm values (10,'Vase haut', 187.00, 'img10.jpg');
insert into produitdm values (11,'Vase déconstruit', 289.00, 'img11.jpg');
insert into produitdm values (12,'Tasse long', 440.00, 'img12.jpg');
insert into produitdm values (13,'Mug', 28.99, 'img13.jpg');
insert into produitdm values (14,'Bonjour le matin', 28.99, 'img14.jpg');
insert into produitdm values (15,'Panier', 28.99, 'img15.jpg');
insert into produitdm values (16,'Corbeille', 107.00, 'img16.jpg');
insert into produitdm values (17,'Organisateur', 148.00, 'img17.jpg');
insert into produitdm values (18,'Deco fleur', 450.00, 'img18.jpg');


-- select idP, libP, prixP, photoP from produitdm;