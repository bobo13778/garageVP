
INSERT INTO services (name, description, picture) VALUES 
("Réparation de carrosserie", "Réparer régulièrement la carrosserie est essentiel dans l’entretien de votre véhicule. Elle permet de conserver la garantie du constructeur, mais aussi de préserver le capital esthétique de votre voiture. Selon la gravité d’une collision, une automobile peut être immobilisée pendant une longue durée, mais si le choc est mineur, certains éléments peuvent être rapidement remis en état et à moindre coût. Dans tous les cas, nous proposons à nos clients des devis listant toutes les réparations que nous pouvons effectuer. Avec la liste des réparations que nous proposons d’effectuer, ainsi que le prix de chacune, vous pourrez prendre une décision éclairée quant à l’entretien de votre véhicule personnel.", "/Images/services/carrosserie.jpg"),
("Réparations mécaniques", "En matière de réparation automobile, celles-ci sont incontournables. Les réparations mécaniques concernent le fonctionnement du moteur et de toutes les autres parties mécaniques du véhicule. Il peut ainsi s’agir de changer une pièce telle que : une durite, une courroie de distribution, une bougie d’allumage, des freins, des amortisseurs, des plaquettes, etc.", "/Images/services/mecanique.jpg"),
("Entretien de votre véhicule", "En apportant votre voiture dans un garage, la révision est effectuée par des professionnels qui vérifient et remplacent les pièces usées si nécessaire. Ils s'assurent également que les différents composants de votre auto fonctionnent de manière optimale, notamment le moteur, les pneus, les amortisseurs, les ressorts de suspension, le freinage et les roues, ou encore le pot de gaz d’échappement. Il est important de suivre les conseils de ces experts et de ne pas négliger la révision de votre véhicule pour prévenir l'usure prématurée des pièces et éviter des réparations coûteuses à long terme.", "/Images/services/entretien.jpg"),
("Véhicules d'occasion", "Nous proposons toute une gamme de véhicules d'occasion : voitures,motos, camions, etc... Tous nos véhicules d'occasion sont révisés et garantis, de plus vous bénéficierez de notre expertise pour toute modification souhaitée", "/Images/services/occasions.jpg");

INSERT INTO administrateurs (firstname, lastname, email, password) VALUES ('Vincent', 'Parrot', 'vparrot@test.fr', '$2y$10$zGZxV0tumoYDiKElJFVqu.MGhLAVX1g.U88cPJMG6ZUUJ7Kh693Oa');

INSERT INTO employes (firstname, lastname, email, password, moderator, poste) VALUES
('Jean', 'Michel', 'jean@michel.fr','$2y$10$kL4DZqthUTsg6qAYVcyqf.sgN5v3vwiChJXxKwiVQVLsIrfxkBUl6', '', 'mécanicien' ),
('jeanne', 'masse', 'jeanne@masse.fr','$2y$10$57HrJ/oFA0QMDtq8XtgUpuhmWhgj2UsirPyWDtBb.t6lJ8BKt9KHi', 1, 'Assistante'),
('jacques', 'dupont', 'jacques@dupont.fr','$2y$10$2rnmXUeh6teoANkTSCIsdOCKmKN6uhyCH0i04lNO.TL427ezi9gIu', 0, 'carrossier');


INSERT INTO horaires (id, day, morningStart, morningEnd, morningIsClosed, afternoonStart, afternoonEnd, afternoonIsClosed) VALUES
(1, 'Lundi', '08:45', '12:00', '', '14:00', '18:00', ''),
(2, 'Mardi', '08:45', '12:00', '', '14:00', '18:00', ''),
(3, 'Mercredi', '08:45', '12:00', '', '14:00', '18:00', ''),
(4, 'Jeudi', '08:45', '12:00', '', '14:00', '18:00', ''),
(5, 'Vendredi', '08:45', '12:00', '', '14:00', '18:00', ''),
(6, 'Samedi', '08:45', '12:00', '', '00:00', '00:00', 1),
(7, 'Dimanche', '00:00', '00:00', 1, '00:00', '00:00', 1);

INSERT INTO temoignages (name, content, grade, toValidate, createdAt) VALUES
('Jean Dupont', 'Vraiment bien accueilli', 4, '', '2023-09-20 20:20:20'),
('Michelle Vincent', 'Très bon garage, je recommande', 5, '', '2023-08-18 15:30:20'),
('Marcel Priou', 'Un peu lent', 2, 1, '2022-12-20 09:50:20'),
('Bertand Futard', 'Très bon service, tout est parfait', 5, 1, '2022-09-08 08:45:20'),
('Roger Latuille', 'Ma voiture est comme neuve, merci à vous', 4, 1, '2021-05-14 15:20:20');

INSERT INTO photos (src) VALUES 
('./Images/annonces/2061.jpg'),
('./Images/annonces/2062.jpg'),
('./Images/annonces/2063.jpg'),
('./Images/annonces/c41.jpg'),
('./Images/annonces/c42.jpg'),
('./Images/annonces/c43.jpg'),
('./Images/annonces/c44.jpg'),
('./Images/annonces/mercedes1.jpg'),
('./Images/annonces/mercedes2.jpg'),
('./Images/annonces/mercedes3.jpg'),
('./Images/annonces/mercedes4.jpg'),
('./Images/annonces/polo1.jpg'),
('./Images/annonces/polo2.jpg'),
('./Images/annonces/polo3.jpg'),
('./Images/annonces/polo4.jpg');

INSERT INTO vehicules (title, description, price, mainpictureId, year, mileage, gearbox, color, doors, seats, width, height, length, trunkVolume, power, fiscalPower, co2Emission, fuel) VALUES
('Peugeot 206', 'Voiture en très bon état, carrosserie impeccable', 15000, 1, 2015, 26000, 'automatique', 'blanche', 5, 5, 1.9, 1.55, 3.95, 300, 90, 5, 140, 'essence'),
('Citroen C4', 'Première main, kilométrage faible', 18000, 4, 2019, 28000, 'manuelle', 'noir', 5, 5, 2.05, 1.75, 4.20, 350, 100, 5, 150, 'diesel'),
('Mercedes classe A', 'Véhicule récent, petits travaux de carrosserie à prévoir', 12300, 8, 2012, 89000, 'manuelle', 'bleue', 5, 5, 1.7, 1.80, 3.60, 250, 90, 5, 110, 'essence'),
('Volkswagen Polo hybride', 'Très peu roulé, état neuf', 35000, 12, 2022, 12000, 'automatique', 'rouge', 3, 5, 1.8, 1.65, 3.80, 350, 90, 5, 140, 'hybride essence');

UPDATE photos SET vehiculeId = 1 WHERE id = 2;
UPDATE photos SET vehiculeId = 1 WHERE id = 3;
UPDATE photos SET vehiculeId = 2 WHERE id = 5;
UPDATE photos SET vehiculeId = 2 WHERE id = 6;
UPDATE photos SET vehiculeId = 2 WHERE id = 7;
UPDATE photos SET vehiculeId = 3 WHERE id = 9;
UPDATE photos SET vehiculeId = 3 WHERE id = 10;
UPDATE photos SET vehiculeId = 3 WHERE id = 11;
UPDATE photos SET vehiculeId = 4 WHERE id = 13;
UPDATE photos SET vehiculeId = 4 WHERE id = 14;
UPDATE photos SET vehiculeId = 4 WHERE id = 15;