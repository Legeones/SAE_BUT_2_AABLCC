drop table if exists PersonneConfiance, PersonneContacte, Patient, Intervenant, Intervention, Admission, Utilisateur, Soin, SoinPatient, Medecin, PatientMedecin, Prescription, PrescriptionPatient;

create table PersonneConfiance (
                                   idPcon serial not null primary key,
                                   nom text not null ,
                                   prenom text not null,
                                   tel text not null ,
                                   lien text not null ,
                                   formulaire bool not null
);

create table PersonneContacte (
                                  idPtel serial not null primary key,
                                  nom text not null ,
                                  prenom text not null,
                                  tel text not null ,
                                  lien text not null
);


create table Patient(
                        IPP numeric(13,0) not null primary key,
                        IEP serial not null,
                        nom text not null ,
                        prenom text not null ,
                        DDN date not null ,
                        taille_cm int not null ,
                        poids_kg float not null ,
                        adresse text not null ,
                        CP char(5) not null ,
                        ville text not null ,
                        telPersonnel text not null ,
                        telProfessionnel text ,
                        allergies text  ,
                        antecedents text  ,
                        obstericaux text  ,
                        doMedicaux text  ,
                        doChirurgicaux text ,
                        idPcon serial not null references PersonneConfiance,
                        idPtel serial not null references PersonneContacte
);

create table Intervenant (
                             idIntervenant serial not null primary key ,
                             nom text not null,
                             prenom text not null,
                             fonction text not null
);

create table Intervention (
                              idIntervention serial not null primary key ,
                              date date not null ,
                              compteRendu text not null,
                              IPP numeric(13,0) not null references Patient,
                              idIntervenant serial not null references Intervenant
);

create table Admission (
                           idAdmission serial not null primary key,
                           dateDebut date not null,
                           dateFin date not null,
                           IPP numeric(13,0) not null references Patient
);

create table Utilisateur (
                             login text not null primary key,
                             mdp text not null,
                             email text not null,
                             role text not null
);

create table Soin (
                      idSoin serial not null primary key,
                      nom text not null,
                      categorie text not null
);

create table SoinPatient(
                            idSP serial not null ,
                            jour date not null ,
                            heure text not null ,
                            valeur text not null ,
                            IPP numeric(13,0) not null references Patient,
                            idSoin serial not null references Soin
);

create table Medecin (
                         idMedecin serial not null primary key ,
                         nom text not null ,
                         prenom text not null ,
                         adresse text not null ,
                         CP text not null ,
                         ville text not null
);

create table PatientMedecin (
                                IPP numeric(13,0) not null references Patient,
                                idMedecin serial not null references Medecin,
                                primary key (IPP, idMedecin),
                                type text not null
);

create table Prescription (
                              idPrescription serial not null primary key ,
                              nom text not null ,
                              type text not null
);

create table PrescriptionPatient (
                                     idPP serial not null primary key,
                                     jour date not null ,
                                     heure text not null ,
                                     dateDebut date not null,
                                     traitement text not null ,
                                     fait boolean not null ,
                                     IPP numeric(13,0) not null references Patient,
                                     idPrescription serial not null references Prescription
);

insert into PersonneConfiance
values (1, 'Berthe', 'Henry', '0671458653', 'Pere', false),
       (2, 'Dupont', 'Eric', '0745632514', 'Fere', true),
       (3, 'Armand', 'Chloé', '0786593102', 'Fille', true),
       (4, 'Clarry', 'Bertrand', '0625863517', 'Cousin', false),
       (5, 'Lavoisier', 'Anthonny', '0783592079', 'Fils', true);

insert into PersonneContacte
values (1, 'Poitier', 'Antoine', '0625226384', 'Voisin'),
       (2, 'Armand', 'Chloé', '0786593102', 'Fille'),
       (3, 'Berthe', 'Henry', '0671458653', 'Pere'),
       (4, 'James', 'Raphael', '0741586319', 'Conjoint'),
       (5, 'Beranger', 'Mathilde', '0655233974', 'Mere');

insert into Intervenant
values (1, 'Cartier', 'Charles', 'chirurgien'),
       (2, 'Brisot', 'Valentin', 'osteopathe'),
       (3, 'Bendoucha', 'Jaweed', 'psychologue'),
       (4, 'La Couronne', 'Adam', 'dentiste'),
       (5, 'Kappet', 'Andy', 'reeducateur');

insert into Patient
values (8000000000000, 1, 'Armand', 'Pierre', '1967-10-25', 182, 93, '20 rue du tiermonde', 42900, 'Saint-Etienne', '0778845621', null, 'chat,pollen,acharien', null, null, 'traitement pour allergies', null, 3, 2),
       (8000000000001, 2, 'Bernaville', 'Theo', '2003-03-18', 183, 70, '18 rue des tullipes', 59720, 'Ferriere', '0654479823', null, 'chat,latex', null, null, 'traitement pour allergies, insuffisance renale', null, 4, 1),
       (8000000000002, 3, 'Leveque', 'Aurelien', '2003-08-28', 186, 85, '09 rue desbraslongs', 59330, 'Hautmont', '0784635988', null, 'pollen, acharien', null,null, null, null, 5,4),
       (8000000000003, 4, 'Applencourt', 'Samuel', '2003-01-14', 176, 65, '56 rue desjuifs', 59330, 'Boussiere', '0632541596', null, 'acharien', null, null, null, null, 2, 4),
       (8000000000004, 5, 'Anselot', 'Steven', '2003-04-10', 169, 65, '12 rue desnains', 59330, 'Hautont', '0631524969', null, null, null, null, null, 'operation appendicectomie', 1,3),
       (8000000000005, 6, 'Joly', 'Marie', '1993-01-28', 158, 52, '15 rue Jean Jaures', 59620, 'Leval', '0784293017', null, 'chien, latex, coton', 'père diabétique, sous tension', null, null, null, 4, 5);

insert into Intervention
values (1, '2010-04-12', 'blabla1', 8000000000001, 3),
       (2, '2012-08-24', 'blabla2', 8000000000004, 4),
       (3, '2012-10-15', 'blabla3', 8000000000002, 5),
       (4, '2012-12-25', 'blabla4', 8000000000005, 2),
       (5, '2013-02-04', 'blabla5', 8000000000002, 1);

insert into Admission
values (1, '2010-04-12', '2010-04-12', 8000000000001),
       (2, '2012-08-24', '2012-08-24', 8000000000004),
       (3, '2012-10-14', '2012-12-15', 8000000000002),
       (4, '2012-12-25', '2012-12-25', 8000000000005),
       (5, '2013-02-03', '2013-02-17', 8000000000002);

insert into Utilisateur
values ('aurelien.leveque', 'leveque', 'Aurelien.Leveque@uphf.fr', 'etudiant'),
       ('steven.anselot', 'anselot', 'Steven.Anselot@uphf.fr', 'etudiant'),
       ('theo.bernaville', 'bernaville', 'Theo.Bernaville@uphf.fr', 'etudiant'),
       ('samuel.applencourt', 'applencourt', 'Samuel.Applencourt@uphf.fr', 'etudiant'),
       ('dorian.petit', 'petit', 'Dorian.Petit@uphf.fr', 'enseignant');

insert into Soin
values (1, 'changement pansemants', 'post operation'),
       (2, 'repas', 'avant et post operation'),
       (3, 'douche', 'avant et post operation'),
       (4, 'dose medicamenteuse', 'post operation');

insert into SoinPatient
values (1, '2012-10-14', '18h00', 'une fois', 8000000000002, 3),
       (2, '2012-10-14', '19h00', 'une fois', 8000000000002, 2),
       (3, '2012-10-15', '08h00', 'une fois', 8000000000002, 3),
       (4, '2012-10-15', '09h00', 'une fois', 8000000000002, 2),
       (5, '2012-10-15', '09h05', 'une fois', 8000000000002, 4),
       (6, '2013-02-03', '18h00', 'une fois', 8000000000002, 3),
       (7, '2013-02-03', '19h00', 'une fois', 8000000000002, 2),
       (8, '2013-02-04', '08h00', 'une fois', 8000000000002, 3),
       (9, '2013-02-04', '09h00', 'une fois', 8000000000002, 2),
       (10, '2013-02-04', '09h05', 'une fois', 8000000000002, 4),
       (11, '2013-02-04', '17h00', 'une fois', 8000000000002, 1),
       (12, '2013-02-04', '18h00', 'une fois', 8000000000002, 3),
       (13, '2013-02-04', '19h00', 'une fois', 8000000000002, 2);

insert into Medecin
values (1, 'Claviant', 'Marcel', '09 rue Despiet', 59540, 'Caudry'),
       (2, 'Monchard', 'Roland', '14 rue du litige', 59600, 'Mairieux'),
       (3, 'Bailleux', 'Christine', '28 rue Anatole', 59680, 'Ferriere-la-Grande'),
       (4, 'Moulin', 'Jean', '63 rue du Rempart', 59300, 'Valenciennes');

insert into PatientMedecin
values (8000000000000, 1, 'generaliste'),
       (8000000000001, 4, 'medecine sante publique et sociale'),
       (8000000000002, 1, 'generaliste'),
       (8000000000003, 3, 'generaliste'),
       (8000000000004, 2, 'generaliste');

insert into Prescription
values (1, 'antidouleurs', 'listes 1&2'),
       (2, 'morphine', 'classe stupéfiant'),
       (3, 'antidepresseurs', 'listes 1&2'),
       (4, 'cannabis', 'classe stupéfiant');

insert into PrescriptionPatient
values (1, '2010-04-08', '20h00', '2010-04-12', 'deux doses medicamenteuses d_antidouleurs par intervalle de 6h00', true, 8000000000002, 1),
       (2, '2010-04-08', '20h00', '2010-04-12', 'une dose medicamenteuse d_antidepresseurs', true, 8000000000002, 3),
       (3, '2012-08-20', '16h00', '2010-08-24', 'une dose medicamenteuse d_antidouleurs', true, 8000000000004, 1),
       (4, '2010-04-10', '08h00', '2010-04-13', 'deux doses medicamenteuses de canabis avec intervalle de 10h00', true, 8000000000001, 4);

