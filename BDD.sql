CREATE TABLE utililisateur(
   utilisateur_id INT,
   nom VARCHAR(255),
   telephone VARCHAR(50),
   adresse VARCHAR(250),
   date_naissance DATE,
   photo VARCHAR(50),
   pseudo VARCHAR(50),
   prenom VARCHAR(255),
   email VARCHAR(255),
   password VARCHAR(256),
   PRIMARY KEY(utilisateur_id)
);

CREATE TABLE role(
   id_role INT,
   libelle VARCHAR(50),
   PRIMARY KEY(id_role)
);

CREATE TABLE avis(
   avis_id INT,
   commentaire VARCHAR(50),
   note VARCHAR(50),
   statut VARCHAR(50),
   PRIMARY KEY(avis_id)
);

CREATE TABLE marque(
   marque_id INT,
   libelle VARCHAR(50),
   PRIMARY KEY(marque_id)
);

CREATE TABLE configuration(
   id_configuration INT,
   utilisateur_id INT NOT NULL,
   PRIMARY KEY(id_configuration),
   FOREIGN KEY(utilisateur_id) REFERENCES utililisateur(utilisateur_id)
);

CREATE TABLE voiture(
   voiture_id INT,
   modele VARCHAR(50),
   immatriculation VARCHAR(50),
   energie VARCHAR(50),
   couleur VARCHAR(50),
   date_premmiere_immatriculation VARCHAR(50),
   marque_id INT NOT NULL,
   utilisateur_id INT NOT NULL,
   PRIMARY KEY(voiture_id),
   FOREIGN KEY(marque_id) REFERENCES marque(marque_id),
   FOREIGN KEY(utilisateur_id) REFERENCES utililisateur(utilisateur_id)
);

CREATE TABLE covoiturage(
   covoiturage_id INT,
   date_depart DATE,
   heure_depart VARCHAR(50),
   lieu_arrivee VARCHAR(50),
   lieu_depart VARCHAR(50),
   date_arrivee DATE,
   heure_arrivee VARCHAR(50),
   statut VARCHAR(50),
   nb_place INT,
   prix_personne INT,
   voiture_id INT NOT NULL,
   PRIMARY KEY(covoiturage_id),
   FOREIGN KEY(voiture_id) REFERENCES voiture(voiture_id)
);

CREATE TABLE parametre(
   parametre_id INT,
   propriete VARCHAR(50),
   valeur VARCHAR(50),
   id_configuration INT NOT NULL,
   PRIMARY KEY(parametre_id),
   FOREIGN KEY(id_configuration) REFERENCES configuration(id_configuration)
);

CREATE TABLE posseder(
   utilisateur_id INT,
   id_role INT,
   PRIMARY KEY(utilisateur_id, id_role),
   FOREIGN KEY(utilisateur_id) REFERENCES utililisateur(utilisateur_id),
   FOREIGN KEY(id_role) REFERENCES role(id_role)
);

CREATE TABLE deposer(
   utilisateur_id INT,
   avis_id INT,
   PRIMARY KEY(utilisateur_id, avis_id),
   FOREIGN KEY(utilisateur_id) REFERENCES utililisateur(utilisateur_id),
   FOREIGN KEY(avis_id) REFERENCES avis(avis_id)
);

CREATE TABLE participer(
   utilisateur_id INT,
   covoiturage_id INT,
   PRIMARY KEY(utilisateur_id, covoiturage_id),
   FOREIGN KEY(utilisateur_id) REFERENCES utililisateur(utilisateur_id),
   FOREIGN KEY(covoiturage_id) REFERENCES covoiturage(covoiturage_id)
);