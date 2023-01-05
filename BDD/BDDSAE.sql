drop table if exists PersonneConfiance,Utilisateur, PersonneContacte,Corbeille, Patient, Intervenant, Intervention, Admission, Soin,SoinPatientPredef, SoinPatient, Medecin, PatientMedecin, Prescription, PrescriptionPatient,radio,Biologie,couriel,ObservationMedical,TransmissionsCiblees,Scenario,ScenarioCorbeille,ScenarioEtudiant,ScenarioEvenement, Evenement;

create table PersonneConfiance
(
    idPcon serial not null primary key,
    nom text not null ,
    prenom text not null,
    telephone text not null ,
    lien text not null ,
    formulaire bool not null
);

create table PersonneContacte (
                                  idPtel serial not null primary key,
                                  nom text not null ,
                                  prenom text not null,
                                  telephone text not null ,
                                  lien text not null
);

create table Patient(
                        IPP numeric(13,0) not null primary key,
                        IEP serial not null,
                        Nom text not null ,
                        Prenom text not null ,
                        Date_de_Naissance date not null ,
                        Taille_cm int not null ,
                        Poids_kg float not null ,
                        Adresse text not null ,
                        Code_Postal text not null check ( Patient.code_postal ~ '^[0-9][0-9][0-9][0-9][0-9]$'),
                        Ville text not null ,
                        Telephone_Personnel text not null ,
                        Telephone_Professionnel text ,
                        Allergies text  ,
                        Antecedents text  ,
                        Obstericaux text  ,
                        Documents_Medicaux text  ,
                        Documents_Chirurgicaux text ,
                        idPcon serial not null unique references PersonneConfiance ON DELETE CASCADE,
                        idPtel serial not null unique references PersonneContacte ON DELETE CASCADE,
                        Mesure_de_Protection bool not null ,
                        Assistant_Social bool not null,
                        Mode_de_Vie text,
                        Synthese_Entree text not null,
                        Traitement_Domicile text,
                        Donnee_Physique_Psychologique text,
                        Mobilite int check(mobilite>=1 and mobilite<=3) not null,
                        Alimentation int check(alimentation>=1 and alimentation<=3) not null,
                        Hygiene int check(Hygiene>=1 and Hygiene<=3) not null,
                        Toilette int check(toilette>=1 and toilette<=3) not null,
                        Habit int check(Habit>=1 and Habit<=3) not null,
                        Continence int check(continence>=1 and continence<=3) not null
);

create table Intervenant (
                             idIntervenant serial primary key ,
                             nom text not null,
                             prenom text not null,
                             fonction text not null
);

create table Admission (
                           iep serial primary key,
                           dateDebut date not null,
                           dateFin date not null,
                           IPP numeric(13,0) not null references Patient ON DELETE CASCADE
);

create table Intervention (
                              idIntervention serial primary key ,
                              date date not null ,
                              compteRendu text not null,
                              IPP numeric(13,0) not null references Patient ON DELETE CASCADE,
                              idIntervenant serial not null references Intervenant ON DELETE CASCADE,
                              iep int not null references Admission ON DELETE CASCADE
);

create table Soin (
                      idSoin serial primary key,
                      nom text not null,
                      categorie text not null
);

CREATE TABLE SoinPatientPredef(
                                  idSPP serial primary key ,
                                  debut date not null,
                                  fin date,
                                  heure time not null,
                                  IPP numeric(13,0) not null references Patient ON DELETE CASCADE ,
                                  iep int not null references Admission ON DELETE CASCADE,
                                  idSoin int not null references Soin ON DELETE CASCADE
);

create table SoinPatient(
                            idSP int not null primary key ,
                            jour date not null ,
                            heure time not null ,
                            valeur text not null ,
                            effectuer boolean not null,
                            iep int not null references Admission ON DELETE CASCADE,
                            idSPP int not null references SoinPatientPredef ON DELETE CASCADE
);

create table Medecin (
                         idMedecin serial primary key ,
                         nom text not null ,
                         prenom text not null ,
                         adresse text not null ,
                         CP text not null check ( CP ~ '^[0-9][0-9][0-9][0-9][0-9]$'),
                         ville text not null
);

create table PatientMedecin (
                                IPP numeric(13,0)  references Patient ON DELETE CASCADE,
                                idMedecin serial  references Medecin ON DELETE CASCADE,
                                primary key (IPP, idMedecin),
                                type text not null,
                                lienMed text not null
);

create table Prescription (
                              idPrescription serial primary key ,
                              nom text not null ,
                              type text not null
);

create table Corbeille(
    IPPCorb numeric(13,0)  references Patient ON DELETE CASCADE primary key
);

create table PrescriptionPatient (
                                     idPP serial primary key,
                                     jour date not null ,
                                     heure text not null ,
                                     dateDebut date not null,
                                     traitement text not null ,
                                     fait boolean not null ,
                                     IPP numeric(13,0) not null references Patient ON DELETE CASCADE,
                                     idPrescription serial not null references Prescription ON DELETE CASCADE,
                                     iep int not null references Admission ON DELETE CASCADE
);

create table radio(
                      lien text primary key ,
                      nom text not null ,
                      IPPRadio numeric(13,0)  references Patient ON DELETE CASCADE not null
);

create table couriel(
                        lien text primary key ,
                        nom text not null ,
                        IPPCour numeric(13,0)  references Patient ON DELETE CASCADE not null
);

create table Biologie(
                         lien text primary key ,
                         nom text not null ,
                         IPPBio numeric(13,0)  references Patient ON DELETE CASCADE not null,
                         description text,
                         titre text not null
);

create table ObservationMedical(
                                   idOM serial primary key,
                                   dateOM date not null,
                                   rapport text not null,
                                   IPP numeric(13,0) references Patient on delete cascade not null,
                                   iep int not null references Admission ON DELETE CASCADE
);

create table TransmissionsCiblees(
                                     idOb serial primary key,
                                     date date not null ,
                                     initiale text,
                                     cible text not null ,
                                     donnee text,
                                     actions text,
                                     resultat text,
                                     IPP numeric(13,0) references Patient on DELETE cascade not null,
                                     iep int not null references Admission ON DELETE CASCADE
);

insert into PersonneConfiance
values (1, 'Berthe', 'Henry', '0671458653', 'Pere', false),
       (2, 'Dupont', 'Eric', '0745632514', 'Fere', true),
       (3, 'Armand', 'Chloé', '0786593102', 'Fille', true),
       (4, 'Clarry', 'Bertrand', '0625863517', 'Cousin', false),
       (5, 'Lavoisier', 'Anthonny', '0783592079', 'Fils', true),
       (6,'Edison','Tesla','0324859746','Ami',true);


insert into PersonneContacte
values (1, 'Poitier', 'Antoine', '0625226384', 'Voisin'),
       (2, 'Armand', 'Chloé', '0786593102', 'Fille'),
       (3, 'Berthe', 'Henry', '0671458653', 'Pere'),
       (4, 'James', 'Raphael', '0741586319', 'Conjoint'),
       (5, 'Beranger', 'Mathilde', '0655233974', 'Mere'),
       (6,'Hiroux','Jack','0324859746','Ami');

insert into Intervenant
values (1, 'Cartier', 'Charles', 'chirurgien'),
       (2, 'Brisot', 'Valentin', 'osteopathe'),
       (3, 'Bendoucha', 'Jaweed', 'psychologue'),
       (4, 'La Couronne', 'Adam', 'dentiste'),
       (5, 'Kappet', 'Andy', 'reeducateur');

insert into Patient
values (8000000000000, 1, 'Armand', 'Pierre', '1967-10-25', 182, 93, '20 rue du tiermonde', 42900, 'Saint-Etienne', '0778845621', null, 'chat,pollen,acharien', null, null, 'traitement pour allergies', null, 1, 1,false,false,'agrigulteur','main ouverte',null,null,3,2,1,3,2,1),
       (8000000000001, 2, 'Bernaville', 'Theo', '2003-03-18', 183, 70, '18 rue des tullipes', 59720, 'Ferriere', '0654479823', null, 'chat,latex', null, null, 'traitement pour allergies, insuffisance renale', null, 2, 2,false,true,null,'pied ouverte',null,null,3,2,2,3,2,2),
       (8000000000002, 3, 'Leveque', 'Aurelien', '2003-08-28', 186, 85, '09 rue desbraslongs', 59330, 'Hautmont', '0784635988', null, 'pollen, acharien', null,null, null, null, 3,3,true,false,'ouvrier','jambe casser','2 PO de dolipranne','depressif',3,2,1,3,2,1),
       (8000000000003, 4, 'Applencourt', 'Samuel', '2003-01-14', 176, 65, '56 rue desjuifs', 59330, 'Boussiere', '0632541596', null, 'acharien', null, null, null, null, 4, 4,false,false,null,'main ouverte',null,null,1,1,1,1,1,1),
       (8000000000004, 5, 'Anselot', 'Steven', '2003-04-10', 169, 65, '12 rue desnains', 59330, 'Hautont', '0631524969', null, null, null, null, null, 'operation appendicectomie', 5,5,false,false,'jardinier','renverser par une voiture',null,'tension arterielle',3,2,1,3,2,1),
       (8000000000005, 6, 'Joly', 'Marie', '1993-01-28', 158, 52, '15 rue Jean Jaures', 59620, 'Leval', '0784293017', null, 'chien, latex, coton', 'père diabétique, sous tension', null, null, null, 6, 6,false,false,null,'indigestion alimentaire','PANTOPRAZOLE 20mg 1cp/j,DAFLON 500mg 1cp/j,RILMENIDINE 1mg 2cp/j,DIAMICRON 60 mg 1cp/j','depresion, porte des lunette',3,3,3,3,2,3);

insert into Admission
values (1, '2010-04-12', '2010-04-12', 8000000000001),
       (2, '2012-08-24', '2012-08-24', 8000000000004),
       (3, '2012-10-14', '2012-12-15', 8000000000002),
       (4, '2012-12-25', '2012-12-25', 8000000000005),
       (5, '2013-02-03', '2013-02-17', 8000000000002);

insert into Intervention
values (1, '2010-04-12', 'blabla1', 8000000000001, 3,1),
       (2, '2012-08-24', 'blabla2', 8000000000004, 4,2),
       (3, '2012-10-15', 'blabla3', 8000000000002, 5,3),
       (4, '2012-12-25', 'blabla4', 8000000000005, 2,4),
       (5, '2013-02-04', 'blabla5', 8000000000002, 1,5);


insert into Soin
values (1, 'changement pansemants', 'post operation'),
       (2, 'repas', 'avant et post operation'),
       (3, 'douche', 'avant et post operation'),
       (4, 'dose medicamenteuse', 'post operation');

INSERT INTO SoinPatientPredef
VALUES (default,'2012-10-14',null,'12:00:00.00',8000000000002,3,4),
       (default,'2012-10-14',null,'08:00:00.00',8000000000002,3,2),
       (default,'2012-10-14',null,'12:00:00.00',8000000000002,3,3),
       (default,'2013-02-03',null,'12:00:00.00',8000000000002,5,1),
       (default,'2013-02-03',null,'12:00:00.00',8000000000002,5,2),
       (default,'2013-02-03',null,'20:00:00.00',8000000000002,5,3),
       (default,'2013-02-03',null,'12:00:00.00',8000000000002,5,4);

insert into SoinPatient
values (1, '2012-10-14', '18:00:00.00', 'une fois',true, 3,2),
       (2, '2012-10-14', '19:00:00.00', 'une fois',true, 3,2),
       (3, '2012-10-15', '08:00:00.00', 'une fois',true, 3,3),
       (4, '2012-10-15', '09:00:00.00', 'une fois',true, 3,2),
       (5, '2012-10-15', '09:05:00.00', 'une fois',true, 3,1),
       (6, '2013-02-03', '18:00:00.00', 'une fois',true, 5,6),
       (7, '2013-02-03', '19:00:00.00', 'une fois',true, 5,5),
       (8, '2013-02-04', '08:00:00.00', 'une fois',true, 5,6),
       (9, '2013-02-04', '09:00:00.00', 'une fois',true, 5,5),
       (10, '2013-02-04', '09:05:00.00', 'une fois',true, 5,7),
       (11, '2013-02-04', '17:00:00.00', 'une fois',true, 5,4),
       (12, '2013-02-04', '18:00:00.00', 'une fois',true, 5,5),
       (13, '2013-02-04', '19:00:00.00', 'une fois',true, 5,5);



insert into Medecin
values (1, 'Claviant', 'Marcel', '09 rue Despiet', '59540', 'Caudry'),
       (2, 'Monchard', 'Roland', '14 rue du litige', '59600', 'Mairieux'),
       (3, 'Bailleux', 'Christine', '28 rue Anatole', '59680', 'Ferriere-la-Grande'),
       (4, 'Moulin', 'Jean', '63 rue du Rempart', '59300', 'Valenciennes');

insert into PatientMedecin
values (8000000000000, 1, 'generaliste','traitant'),
       (8000000000001, 4, 'medecine sante publique et sociale','specialisé'),
       (8000000000002, 1, 'generaliste','referent'),
       (8000000000003, 3, 'generaliste','referent'),
       (8000000000004, 2, 'generaliste','referent');

insert into Prescription
values (1, 'antidouleurs', 'listes 1&2'),
       (2, 'morphine', 'classe stupéfiant'),
       (3, 'antidepresseurs', 'listes 1&2'),
       (4, 'cannabis', 'classe stupéfiant');



insert into PrescriptionPatient
values (1, '2012-10-14', '20h00','2000-1-12', 'deux doses medicamenteuses d_antidouleurs par intervalle de 6h00', true, 8000000000002, 1, 3),
       (2, '2012-10-14', '20h00', '2010-04-12', 'une dose medicamenteuse d_antidepresseurs', true, 8000000000002, 3, 3),
       (3, '2012-08-24', '16h00', '2010-08-24', 'une dose medicamenteuse d_antidouleurs', true, 8000000000004, 1 , 2),
       (4, '2010-04-10', '08h00', '2010-04-13', 'deux doses medicamenteuses de canabis avec intervalle de 10h00', true, 8000000000001, 4, 1);


create table Utilisateur (
                             login text primary key,
                             mdp text not null,
                             email text check ( email ~ '@' ) not null unique ,
                             roles text not null
);

insert into Utilisateur
values ('aurelien.leveque', 'leveque', 'Aurelien.Leveque@uphf.fr', 'etudiant'),
       ('steven.anselot', 'anselot', 'Steven.Anselot@uphf.fr', 'etudiant'),
       ('theo.bernaville', 'bernaville', 'Theo.Bernaville@uphf.fr', 'etudiant'),
       ('samuel.applencourt', 'applencourt', 'Samuel.Applencourt@uphf.fr', 'etudiant'),
       ('dorian.petit', '$2y$12$Z/gsoP/SkQMBSc0WXmWQnO2GfhNgnQe0erqMLuvjjuqNPIm4.vQaS', 'Dorian.Petit@uphf.fr', 'prof'),
       ('rtyu','$2y$12$oNKQlblFYAK169xZLtIsBeRb0loYOPb5xc92tj68G9/Qm8jI7f.G.','rtyu@uphf.fr','admin'),
       ('abcd','$2$12$aP7pS7yf1J9bG9aBL5mIN.0k6OeVKnDe3TyN598U/3jmVnXpAaJRK','abcd@uphf.fr','etudiant');

insert into TransmissionsCiblees
values (default,'2013-02-05','IA-ep','Alimentation','mange peu','voir avec diet',null,8000000000002, 5),
       (default,'2013-02-06','IA-ep','hygienne',null,null,'surveiller ses aller au toilet',8000000000002, 5),
       (default,'2012-12-25','Ab (ide)','douleur','le patient se plaint de douleur',null,null,8000000000005, 5),
       (default,'2012-10-14','Ab (ide)','douleur','le patient a mal sans pouvoir la localiser',null,null,8000000000002, 5),
       (default,'2012-08-24','Ab (ide)','douleur','le patient se plaint de douleur','mis sous antibio','en atente de résultat',8000000000004, 2);

insert into ObservationMedical
values (default,'2013-02-05','Patient agité taux de stress élévé',8000000000002, 5),
       (default,'2013-02-08','Patient calme taux de stress en baisse',8000000000002, 5),
       (default,'2012-12-25','Patient pret a partir',8000000000005, 4),
       (default,'2012-10-15','Patient pret a partir',8000000000002, 3),
       (default,'2012-08-24','Patient guerir et remis sur pieds',8000000000004, 2);

create table Evenement(
    idEvenement serial primary key ,
    nom text not null ,
    description text not null
);

create table Scenario(
    idScenario serial primary key ,
    nom text not null ,
    debut date not null ,
    fin date not null check ( debut<fin ),
    nbEv int not null,
    createur text references Utilisateur on delete cascade not null
);

create table ScenarioEvenement(
    idScenario serial references Scenario on delete cascade,
    idEvenement serial references Evenement on delete cascade,
    primary key (idScenario,idEvenement)
);

create table ScenarioEtudiant(
    idS serial references Scenario on delete cascade,
        idU text references Utilisateur on delete cascade,
        idE serial references Evenement on delete cascade,
        date timestamp not null ,
        primary key (idS,idU,idE,date)
);

create table ScenarioCorbeille(
                                 idSCorb serial references Scenario on delete cascade,
                                 primary key (idSCorb)
);



insert into Evenement
values (default,'epilepsie','votre patient fait une crise d epilepsie'),
       (default,'monter temperature','la temperature du patient a monter de deux degrés'),
       (default,'arret cardiaque','le patient a un arret cardiaque'),
       (default,'nouveau traitement','il faut donner une nouvelle de paracetamol a 18h00'),
       (default,'toilet','le patient vous appelle en urgence pour aller au toilet');


insert into Scenario
values (default,'Scenario 1','2022-12-07','2022-12-15',3,'dorian.petit'),
       (default,'Scenario 3','2023-02-07','2023-03-15',2,'dorian.petit');

insert into ScenarioEvenement
values (1,1),
       (1,2),
       (1,3),
       (1,4),
       (1,5),
       (2,3),
       (2,1),
       (2,5);
