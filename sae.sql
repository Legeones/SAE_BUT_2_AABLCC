drop table if exists PersonneConfiance, PersonneContacte, Patient, Intervenant, Intervention, Admission, Utilisateur, Soin, SoinPatient, Medecin, PatientMedecin, Prescription, PrescriptionPatient;

create table PersonneConfiance (
                                   idPcon int not null primary key,
                                   nom text not null ,
                                   prenom text not null,
                                   tel text not null ,
                                   lien text not null ,
                                   formulaire bool not null
);

create table PersonneContacte (
                                  idPtel int not null primary key,
                                  nom text not null ,
                                  prenom text not null,
                                  tel text not null ,
                                  lien text not null
);


create table Patient(
                        IPP int not null primary key,
                        IEP int not null,
                        nom text not null ,
                        prenom text not null ,
                        DDN timestamp not null ,
                        taille_cm int not null ,
                        poids_kg float not null ,
                        adresse text not null ,
                        CP int not null ,
                        ville text not null ,
                        telPersonnel text not null ,
                        telProfessionnel text not null,
                        allergies text not null ,
                        antecedents text not null ,
                        obstericaux text not null ,
                        doMedicaux text not null ,
                        doChirurgicaux text not null,
                        idPcon int not null references PersonneConfiance,
                        idPtel int not null references PersonneContacte
);

create table Intervenant (
                             idIntervenant int not null primary key ,
                             nom text not null,
                             prenom text not null,
                             fonction text not null
);

create table Intervention (
                              idIntervention int not null primary key ,
                              date timestamp not null ,
                              compteRendu text not null,
                              IPP int not null references Patient,
                              idIntervenant int not null references Intervenant
);

create table Admission (
                           idAdmission int not null primary key,
                           dateDebut date not null,
                           dateFin date not null,
                           Ipp int not null references Patient
);

create table Utilisateur (
                             login text not null primary key,
                             mdp text not null,
                             email text not null,
                             role text not null
);

create table Soin (
                      idSoin int not null primary key,
                      nom text not null,
                      categorie text not null
);

create table SoinPatient(
                            idSP int not null ,
                            jour date not null ,
                            heure text not null ,
                            valeur text not null ,
                            IPP int not null references Patient,
                            idSoin int not null references Soin
);

create table Medecin (
                         idMedecin int not null primary key ,
                         nom text not null ,
                         prenom text not null ,
                         adresse text not null ,
                         CP text not null ,
                         ville text not null
);

create table PatientMedecin (
                                IPP int not null references Patient,
                                idMedecin int not null references Medecin,
                                primary key (IPP, idMedecin),
                                type text not null
);

create table Prescription (
                              idPrescription int not null primary key ,
                              nom text not null ,
                              type text not null
);

create table PrescriptionPatient (
                                     idPP int not null primary key,
                                     jour date not null ,
                                     heure text not null ,
                                     dateDebut date not null,
                                     traitement text not null ,
                                     fait boolean not null ,
                                     IPP int not null references Patient,
                                     idPrescription int not null references Prescription
);



