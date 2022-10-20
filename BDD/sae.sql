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
                        DDN timestamp not null ,
                        admission date not null check (admission>DDN),
                        taille_cm int not null ,
                        poids_kg float not null ,
                        adresse text not null ,
                        CP text not null check ( CP ~ '^[0-9][0-9][0-9][0-9][0-9]$'),
                        ville text not null ,
                        telPersonnel text not null ,
                        telProfessionnel text not null,
                        allergies text not null ,
                        antecedents text not null ,
                        obstericaux text not null ,
                        doMedicaux text not null ,
                        doChirurgicaux text not null,
                        idPcon serial not null references PersonneConfiance unique,
                        idPtel serial not null references PersonneContacte unique
);

create table Intervenant (
                             idIntervenant serial primary key ,
                             nom text not null,
                             prenom text not null,
                             fonction text not null
);

create table Intervention (
                              idIntervention serial primary key ,
                              date date not null ,
                              compteRendu text not null,
                              IPP numeric(13,0) not null references Patient,
                              idIntervenant serial not null references Intervenant
);

create table Admission (
                           idAdmission serial primary key,
                           dateDebut date not null,
                           dateFin date not null,
                           IPP numeric(13,0) not null references Patient
);

create table Utilisateur (
    login text primary key,
    mdp text not null,
    email text check ( email ~ '@' ) not null unique ,
    roles text not null
);

create table Soin (
                      idSoin serial primary key,
                      nom text not null,
                      categorie text not null
);

create table SoinPatient(
                            idSP serial primary key ,
                            jour date not null ,
                            heure text not null ,
                            valeur text not null ,
                            IPP numeric(13,0) not null references Patient,
                            idSoin serial not null references Soin
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
                                IPP numeric(13,0)  references Patient,
                                idMedecin serial  references Medecin,
                                primary key (IPP, idMedecin),
                                type text not null
);

create table Prescription (
                              idPrescription serial primary key ,
                              nom text not null ,
                              type text not null
);

create table PrescriptionPatient (
                                     idPP serial primary key,
                                     jour date not null ,
                                     heure text not null ,
                                     dateDebut date not null,
                                     traitement text not null ,
                                     fait boolean not null ,
                                     IPP numeric(13,0) not null references Patient,
                                     idPrescription serial not null references Prescription
);
