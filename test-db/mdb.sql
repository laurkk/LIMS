-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Cze 2023, 16:31
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `addresses`
--

CREATE TABLE `addresses` (
  `idadresses` int(11) NOT NULL,
  `street` varchar(45) NOT NULL,
  `house_number` varchar(45) NOT NULL,
  `flat_number` varchar(45) DEFAULT NULL,
  `City_idtable1` int(11) NOT NULL,
  `postal_code_idpostal_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `addresses`
--

INSERT INTO `addresses` (`idadresses`, `street`, `house_number`, `flat_number`, `City_idtable1`, `postal_code_idpostal_code`) VALUES
(1, 'Różana', '3', NULL, 1, 2),
(2, 'Miodowa', '16', '6', 4, 3),
(3, 'Kleksowa', '10', '1', 2, 1),
(4, 'Czekoladowa', '60', '9', 3, 5),
(5, 'Batorego', '90', NULL, 2, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `city`
--

CREATE TABLE `city` (
  `idtable1` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `city`
--

INSERT INTO `city` (`idtable1`, `name`) VALUES
(1, 'Wrocław'),
(2, 'Warszawa'),
(3, 'Kraków'),
(4, 'Gdańsk');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `experiments`
--

CREATE TABLE `experiments` (
  `idexperiments` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `execution_date` date NOT NULL,
  `id_executor` int(11) NOT NULL,
  `result` longtext NOT NULL,
  `projects_idprojects` int(11) NOT NULL,
  `method_of_experiment_idmethod_of_experiment` int(11) NOT NULL,
  `used_equipment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `experiments`
--

INSERT INTO `experiments` (`idexperiments`, `name`, `description`, `execution_date`, `id_executor`, `result`, `projects_idprojects`, `method_of_experiment_idmethod_of_experiment`, `used_equipment`) VALUES
(1, 'Sekwencjonowanie DNA', 'Sekwencjonowanie DNA muszki owocówki', '2023-04-04', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis egestas sem, non sodales urna tristique lobortis. Curabitur vel rutrum turpis, elementum luctus elit. Donec ultricies ligula ut molestie ultricies. Quisque mi nisi, lobortis quis magna sed, efficitur sagittis velit. Maecenas sed tempor lacus. Sed facilisis eros et ante venenatis.', 1, 3, 3),
(2, 'Hodowla rzeżuchy', 'Czy rzeżucha wyrośnie na jałowym podłożu?', '2023-03-06', 10, 'Stwierdzono brak możliwości rzeżuchy to rośnięcia na jałowym podłożu. Trudno.', 4, 5, 1),
(3, 'Badanie składu oleju rozmarynowego na porost ', 'Rozmaryn był znany już w czasach starożytnośc', '2023-05-16', 7, ' Rozmaryn zawiera wiele substancji czynnych takich jak olejek eteryczny, flawonoidy (luteloina, genkawnina, glikozydy), garbniki, kwasy fenolowe oraz kwas rozmarynowy.', 3, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lab_equipment`
--

CREATE TABLE `lab_equipment` (
  `idlab_equipment` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `prod_date` date NOT NULL,
  `localisation` int(11) NOT NULL,
  `w_personal_data_id_personal_data` int(11) NOT NULL,
  `producer_idproducer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `lab_equipment`
--

INSERT INTO `lab_equipment` (`idlab_equipment`, `name`, `prod_date`, `localisation`, `w_personal_data_id_personal_data`, `producer_idproducer`) VALUES
(1, 'Maszyna Do Kawy', '2023-01-03', 5, 5, 1),
(2, 'Aparat Do Elektroforezy', '2022-12-15', 1, 4, 2),
(3, 'Wirówka', '2022-03-15', 2, 3, 3),
(4, 'Pipeta', '1980-01-01', 7, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login_data`
--

CREATE TABLE `login_data` (
  `iddane_logowania` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `w_personal_data_idwokers_data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `login_data`
--

INSERT INTO `login_data` (`iddane_logowania`, `user_name`, `password`, `mail`, `w_personal_data_idwokers_data`) VALUES
(1, 'PanCzekolada', 'Milka', 'fabrykaczekolady@kakao.pl', 5),
(2, 'StefanKrol', 'batory', 'stefankrol@polska.pl', 1),
(3, 'kleksik', 'kropka', 'akademia@kleks.pl', 2),
(4, 'michael', 'but', 'mikeljordan@bucik.pl', 3),
(6, 'dudzik', 'agatka', 'czolgista@armia.com', 4),
(7, 'katie34', 'godsavethe', 'princess@gmail.com', 7),
(9, 'lorik', '88888888', 'test@gmail.com', 9),
(10, 'testman', '$2y$10$FqZE8xmKoKEPb', '119587@student.upwr.edu.pl', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `material_of_sample`
--

CREATE TABLE `material_of_sample` (
  `idmaterial_of_sample` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `material_of_sample`
--

INSERT INTO `material_of_sample` (`idmaterial_of_sample`, `name`) VALUES
(1, 'DNA'),
(2, 'RNA'),
(3, 'mRNA'),
(4, 'Mocz'),
(5, 'Ślina');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `method_of_experiment`
--

CREATE TABLE `method_of_experiment` (
  `idmethod_of_experiment` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `method_of_experiment`
--

INSERT INTO `method_of_experiment` (`idmethod_of_experiment`, `name`, `description`) VALUES
(1, 'Elektroforeza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis egestas sem, non sodales urna tristique lobortis. Curabitur vel rutrum turpis, elementum luctus elit. Donec ultricies ligula ut molestie ultricies. Quisque mi nisi, lobortis quis magna sed, efficitur sagittis velit. Maecenas sed tempor lacus. Sed facilisis eros et ante venenatis.'),
(2, 'Ankieta', 'Lorem ipsum'),
(3, 'Wirowanie', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis egestas sem, non sodales urna tristique lobortis. Curabitur vel rutrum turpis, elementum luctus elit. Donec ultricies ligula ut molestie ultricies. Quisque mi nisi, lobortis quis magna sed, efficitur sagittis velit. Maecenas sed tempor lacus. Sed facilisis eros et ante venenatis.'),
(4, 'PCR', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis egestas sem, non sodales urna tristique lobortis. Curabitur vel rutrum turpis, elementum luctus elit. Donec ultricies ligula ut molestie ultricies. Quisque mi nisi, lobortis quis magna sed, efficitur sagittis velit. Maecenas sed tempor lacus. Sed facilisis eros et ante venenatis.'),
(5, 'Separowanie', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis egestas sem, non sodales urna tristique lobortis. Curabitur vel rutrum turpis, elementum luctus elit. Donec ultricies ligula ut molestie ultricies. Quisque mi nisi, lobortis quis magna sed, efficitur sagittis velit. Maecenas sed tempor lacus. Sed facilisis eros et ante venenatis.'),
(6, 'Mikroskopia elektronowa', 'Badanie mikroskopem elektronowym');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `patients`
--

CREATE TABLE `patients` (
  `idpatient` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `addresses_idadresses` int(11) NOT NULL,
  `sex_idtable1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `patients`
--

INSERT INTO `patients` (`idpatient`, `name`, `surname`, `phone_number`, `email`, `addresses_idadresses`, `sex_idtable1`) VALUES
(1, 'Michał', 'Krysta', '751459985', 'michalek@atom.com', 3, 2),
(2, 'Mucha', 'Muszyńska', '965536742', 'muszka@owocowka.com', 2, 3),
(3, 'Patryk', 'Brzezicha', '666666666', 'brzoza@sad.pl', 1, 1),
(4, 'Laur', 'Jarosz', '111222333', 'golddigger@money.com', 5, 1),
(5, 'Weronika', 'Basińska', '999888777', 'basior@basia.com', 4, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `position`
--

CREATE TABLE `position` (
  `idposition` int(11) NOT NULL,
  `position_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `position`
--

INSERT INTO `position` (`idposition`, `position_name`) VALUES
(1, 'dyrektor'),
(2, 'techniczny'),
(3, 'laborant'),
(4, 'serwisant'),
(6, 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `postal_code`
--

CREATE TABLE `postal_code` (
  `idpostal_code` int(11) NOT NULL,
  `code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `postal_code`
--

INSERT INTO `postal_code` (`idpostal_code`, `code`) VALUES
(1, '55-080'),
(2, '00-010'),
(3, '50-001'),
(4, '63-400'),
(5, '66-300');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `producer`
--

CREATE TABLE `producer` (
  `idproducer` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `producer`
--

INSERT INTO `producer` (`idproducer`, `name`) VALUES
(1, 'Fabryka Czekolady'),
(2, 'ABS'),
(3, 'LIZ'),
(4, 'LLS');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projects`
--

CREATE TABLE `projects` (
  `idprojects` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` longtext DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `key_words` varchar(90) NOT NULL,
  `budget` decimal(10,0) NOT NULL,
  `w_personal_data_idwokers_data` int(11) NOT NULL,
  `project_status_idproject_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `projects`
--

INSERT INTO `projects` (`idprojects`, `title`, `description`, `start_date`, `end_date`, `key_words`, `budget`, `w_personal_data_idwokers_data`, `project_status_idproject_status`) VALUES
(1, 'Lorem Ipsum', '\'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis egestas sem, non sodales urna tristique lobortis. Curabitur vel rutrum turpis, elementum luctus elit. Donec ultricies ligula ut molestie ultricies. Quisque mi nisi, lobortis quis magna sed, efficitur sagittis velit. Maecenas sed tempor lacus. Sed facilisis eros et ante venenatis.\'', '2023-04-01', NULL, 'lorem,ipsum', '50000', 3, 1),
(2, 'Klonowanie owcy Dolly', 'Komórki będące źródłem materiału genetycznego do klonowania (pierwowzór klona) zostały pobrane z gruczołu mlekowego dorosłej owcy rasy Finn-Dorset. Wyodrębniono z nich jądra komórkowe, które z kolei przeniesiono metodą transferu jądrowego do wcześniej pozbawionych jąder komórek jajowych owcy rasy Scottish Blackface. Udowodniono w ten sposób możliwość sklonowania całego organizmu na podstawie materiału genetycznego (z małymi wyjątkami) pobranego z dowolnej części jego ciała, z komórek w pełni zróżnicowanych somatycznie, które były zdolne odzyskać swoją pluripotencjalność i w rezultacie zapoczątkować rozwój całego organizmu.', '2023-05-01', '2023-06-05', 'owca, Dolly, klonowanie', '600000', 2, 3),
(3, 'Epigenetic response on mouses', 'Certain fears can be inherited through the generations, a provocative study of mice reports1. The authors suggest that a similar phenomenon could influence anxiety and addiction in humans. But some researchers are sceptical of the findings because a biological mechanism that explains the phenomenon has not been identified.', '2023-02-02', '2023-04-28', 'epigenetics, mouse, treatment, fear, response', '280000', 5, 2),
(4, 'Principles of Inheritance', 'Mendel studied the inheritance of seven different features in peas, including height, flower color, seed color, and seed shape.', '2020-10-04', '2021-01-18', 'peas, inheritance, principles, genetics, allels', '1300', 5, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projects_has_w_personal_data`
--

CREATE TABLE `projects_has_w_personal_data` (
  `id_project_personal_data` int(11) NOT NULL,
  `projects_idprojects` int(11) NOT NULL,
  `w_personal_data_id_personal_data` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `projects_has_w_personal_data`
--

INSERT INTO `projects_has_w_personal_data` (`id_project_personal_data`, `projects_idprojects`, `w_personal_data_id_personal_data`, `id_role`) VALUES
(1, 1, 1, 3),
(2, 1, 5, 2),
(3, 2, 3, 2),
(4, 2, 4, 3),
(5, 3, 2, 2),
(6, 3, 7, 3),
(7, 4, 7, 3),
(8, 4, 10, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project_status`
--

CREATE TABLE `project_status` (
  `idproject_status` int(11) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `project_status`
--

INSERT INTO `project_status` (`idproject_status`, `status`) VALUES
(1, 'Rozpoczęty'),
(2, 'Zakończony'),
(3, 'Przerwany');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'executor');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `samples`
--

CREATE TABLE `samples` (
  `idsamples` int(11) NOT NULL,
  `taking_date` date NOT NULL,
  `control` tinyint(4) NOT NULL,
  `patients_idpatient` int(11) NOT NULL,
  `experiments_idexperiments` int(11) NOT NULL,
  `material_of_sample_idmaterial_of_sample` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `samples`
--

INSERT INTO `samples` (`idsamples`, `taking_date`, `control`, `patients_idpatient`, `experiments_idexperiments`, `material_of_sample_idmaterial_of_sample`) VALUES
(1, '2023-03-01', 0, 2, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `service`
--

CREATE TABLE `service` (
  `idservice` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_date` date NOT NULL,
  `description` longtext NOT NULL,
  `serviceman_surname` varchar(45) NOT NULL,
  `lab_equipment_idlab_equipment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `service`
--

INSERT INTO `service` (`idservice`, `service_id`, `service_date`, `description`, `serviceman_surname`, `lab_equipment_idlab_equipment`) VALUES
(1, 123, '2023-05-04', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis egestas sem, non sodales urna tristique lobortis. Curabitur vel rutrum turpis, elementum luctus elit. Donec ultricies ligula ut molestie ultricies. Quisque mi nisi, lobortis quis magna sed, efficitur sagittis velit. Maecenas sed tempor lacus. Sed facilisis eros et ante venenatis.', 'Duda', 2),
(2, 123, '2023-06-20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis egestas sem, non sodales urna tristique lobortis. Curabitur vel rutrum turpis, elementum luctus elit. Donec ultricies ligula ut molestie ultricies. Quisque mi nisi, lobortis quis magna sed, efficitur sagittis velit. Maecenas sed tempor lacus. Sed facilisis eros et ante venenatis.', 'Duda', 1),
(3, 123, '2023-05-20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis egestas sem, non sodales urna tristique lobortis. Curabitur vel rutrum turpis, elementum luctus elit. Donec ultricies ligula ut molestie ultricies. Quisque mi nisi, lobortis quis magna sed, efficitur sagittis velit. Maecenas sed tempor lacus. Sed facilisis eros et ante venenatis.', 'Duda', 3),
(4, 123, '2023-06-06', 'Renowacja uszczelek', 'Linda', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sex`
--

CREATE TABLE `sex` (
  `idtable1` int(11) NOT NULL,
  `sex` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `sex`
--

INSERT INTO `sex` (`idtable1`, `sex`) VALUES
(1, 'Kobieta'),
(2, 'Mężczyzna'),
(3, 'Inne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `w_personal_data`
--

CREATE TABLE `w_personal_data` (
  `id_personal_data` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `position_idposition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `w_personal_data`
--

INSERT INTO `w_personal_data` (`id_personal_data`, `name`, `surname`, `position_idposition`) VALUES
(1, 'Stefan', 'Batory', 1),
(2, 'Ambroży', 'Kleks', 2),
(3, 'Michał', 'Jordan', 4),
(4, 'Andrzej', 'Duda', 4),
(5, 'Willy', 'Wonka', 6),
(7, 'Kate', 'Middelton', 2),
(9, 'Lorem', 'Ipsum', 2),
(10, 'Test', 'Testowy', 4),
(11, '', '', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`idadresses`,`City_idtable1`,`postal_code_idpostal_code`),
  ADD KEY `fk_addresses_City1_idx` (`City_idtable1`),
  ADD KEY `fk_addresses_postal_code1_idx` (`postal_code_idpostal_code`);

--
-- Indeksy dla tabeli `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`idtable1`);

--
-- Indeksy dla tabeli `experiments`
--
ALTER TABLE `experiments`
  ADD PRIMARY KEY (`idexperiments`,`projects_idprojects`,`method_of_experiment_idmethod_of_experiment`),
  ADD KEY `fk_experiments_projects1_idx` (`projects_idprojects`),
  ADD KEY `fk_experiments_method_of_experiment1_idx` (`method_of_experiment_idmethod_of_experiment`),
  ADD KEY `used_equipment` (`used_equipment`),
  ADD KEY `executor` (`id_executor`);

--
-- Indeksy dla tabeli `lab_equipment`
--
ALTER TABLE `lab_equipment`
  ADD PRIMARY KEY (`idlab_equipment`,`w_personal_data_id_personal_data`,`producer_idproducer`),
  ADD KEY `fk_lab_equipment_w_personal_data1_idx` (`w_personal_data_id_personal_data`),
  ADD KEY `fk_lab_equipment_producer1_idx` (`producer_idproducer`);

--
-- Indeksy dla tabeli `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`iddane_logowania`,`w_personal_data_idwokers_data`),
  ADD KEY `fk_login_data_w_personal_data1_idx` (`w_personal_data_idwokers_data`);

--
-- Indeksy dla tabeli `material_of_sample`
--
ALTER TABLE `material_of_sample`
  ADD PRIMARY KEY (`idmaterial_of_sample`);

--
-- Indeksy dla tabeli `method_of_experiment`
--
ALTER TABLE `method_of_experiment`
  ADD PRIMARY KEY (`idmethod_of_experiment`);

--
-- Indeksy dla tabeli `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`idpatient`,`addresses_idadresses`,`sex_idtable1`),
  ADD KEY `fk_patients_addresses1_idx` (`addresses_idadresses`),
  ADD KEY `fk_patients_sex1_idx` (`sex_idtable1`);

--
-- Indeksy dla tabeli `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`idposition`);

--
-- Indeksy dla tabeli `postal_code`
--
ALTER TABLE `postal_code`
  ADD PRIMARY KEY (`idpostal_code`);

--
-- Indeksy dla tabeli `producer`
--
ALTER TABLE `producer`
  ADD PRIMARY KEY (`idproducer`);

--
-- Indeksy dla tabeli `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`idprojects`,`w_personal_data_idwokers_data`,`project_status_idproject_status`),
  ADD KEY `fk_projects_w_personal_data1_idx` (`w_personal_data_idwokers_data`),
  ADD KEY `fk_projects_project_status1_idx` (`project_status_idproject_status`);

--
-- Indeksy dla tabeli `projects_has_w_personal_data`
--
ALTER TABLE `projects_has_w_personal_data`
  ADD PRIMARY KEY (`id_project_personal_data`),
  ADD KEY `fk_projects_has_w_personal_data_w_personal_data1_idx` (`w_personal_data_id_personal_data`),
  ADD KEY `fk_projects_has_w_personal_data_projects1_idx` (`projects_idprojects`),
  ADD KEY `role` (`id_role`);

--
-- Indeksy dla tabeli `project_status`
--
ALTER TABLE `project_status`
  ADD PRIMARY KEY (`idproject_status`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeksy dla tabeli `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`idsamples`,`patients_idpatient`,`experiments_idexperiments`,`material_of_sample_idmaterial_of_sample`),
  ADD KEY `fk_samples_patients1_idx` (`patients_idpatient`),
  ADD KEY `fk_samples_experiments1_idx` (`experiments_idexperiments`),
  ADD KEY `fk_samples_material_of_sample1_idx` (`material_of_sample_idmaterial_of_sample`);

--
-- Indeksy dla tabeli `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idservice`,`lab_equipment_idlab_equipment`),
  ADD KEY `fk_service_lab_equipment1_idx` (`lab_equipment_idlab_equipment`);

--
-- Indeksy dla tabeli `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`idtable1`);

--
-- Indeksy dla tabeli `w_personal_data`
--
ALTER TABLE `w_personal_data`
  ADD PRIMARY KEY (`id_personal_data`,`position_idposition`),
  ADD KEY `fk_w_personal_data_position1_idx` (`position_idposition`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `addresses`
--
ALTER TABLE `addresses`
  MODIFY `idadresses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `city`
--
ALTER TABLE `city`
  MODIFY `idtable1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `experiments`
--
ALTER TABLE `experiments`
  MODIFY `idexperiments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `lab_equipment`
--
ALTER TABLE `lab_equipment`
  MODIFY `idlab_equipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `login_data`
--
ALTER TABLE `login_data`
  MODIFY `iddane_logowania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `material_of_sample`
--
ALTER TABLE `material_of_sample`
  MODIFY `idmaterial_of_sample` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `method_of_experiment`
--
ALTER TABLE `method_of_experiment`
  MODIFY `idmethod_of_experiment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `patients`
--
ALTER TABLE `patients`
  MODIFY `idpatient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `position`
--
ALTER TABLE `position`
  MODIFY `idposition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `postal_code`
--
ALTER TABLE `postal_code`
  MODIFY `idpostal_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `producer`
--
ALTER TABLE `producer`
  MODIFY `idproducer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `projects`
--
ALTER TABLE `projects`
  MODIFY `idprojects` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `projects_has_w_personal_data`
--
ALTER TABLE `projects_has_w_personal_data`
  MODIFY `id_project_personal_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `project_status`
--
ALTER TABLE `project_status`
  MODIFY `idproject_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `samples`
--
ALTER TABLE `samples`
  MODIFY `idsamples` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `service`
--
ALTER TABLE `service`
  MODIFY `idservice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `sex`
--
ALTER TABLE `sex`
  MODIFY `idtable1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `w_personal_data`
--
ALTER TABLE `w_personal_data`
  MODIFY `id_personal_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_addresses_City1` FOREIGN KEY (`City_idtable1`) REFERENCES `city` (`idtable1`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_addresses_postal_code1` FOREIGN KEY (`postal_code_idpostal_code`) REFERENCES `postal_code` (`idpostal_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `experiments`
--
ALTER TABLE `experiments`
  ADD CONSTRAINT `executor` FOREIGN KEY (`id_executor`) REFERENCES `w_personal_data` (`id_personal_data`),
  ADD CONSTRAINT `fk_experiments_method_of_experiment1` FOREIGN KEY (`method_of_experiment_idmethod_of_experiment`) REFERENCES `method_of_experiment` (`idmethod_of_experiment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_experiments_projects1` FOREIGN KEY (`projects_idprojects`) REFERENCES `projects` (`idprojects`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `used_equipment` FOREIGN KEY (`used_equipment`) REFERENCES `lab_equipment` (`idlab_equipment`);

--
-- Ograniczenia dla tabeli `lab_equipment`
--
ALTER TABLE `lab_equipment`
  ADD CONSTRAINT `fk_lab_equipment_producer1` FOREIGN KEY (`producer_idproducer`) REFERENCES `producer` (`idproducer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lab_equipment_w_personal_data1` FOREIGN KEY (`w_personal_data_id_personal_data`) REFERENCES `w_personal_data` (`id_personal_data`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `login_data`
--
ALTER TABLE `login_data`
  ADD CONSTRAINT `fk_login_data_w_personal_data1` FOREIGN KEY (`w_personal_data_idwokers_data`) REFERENCES `w_personal_data` (`id_personal_data`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `fk_patients_addresses1` FOREIGN KEY (`addresses_idadresses`) REFERENCES `addresses` (`idadresses`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_patients_sex1` FOREIGN KEY (`sex_idtable1`) REFERENCES `sex` (`idtable1`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projects_project_status1` FOREIGN KEY (`project_status_idproject_status`) REFERENCES `project_status` (`idproject_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `w_personal_data_idwokers_data` FOREIGN KEY (`w_personal_data_idwokers_data`) REFERENCES `w_personal_data` (`id_personal_data`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `projects_has_w_personal_data`
--
ALTER TABLE `projects_has_w_personal_data`
  ADD CONSTRAINT `fk_projects_has_w_personal_data_projects1` FOREIGN KEY (`projects_idprojects`) REFERENCES `projects` (`idprojects`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_projects_has_w_personal_data_w_personal_data1` FOREIGN KEY (`w_personal_data_id_personal_data`) REFERENCES `w_personal_data` (`id_personal_data`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `samples`
--
ALTER TABLE `samples`
  ADD CONSTRAINT `fk_samples_experiments1` FOREIGN KEY (`experiments_idexperiments`) REFERENCES `experiments` (`idexperiments`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_samples_material_of_sample1` FOREIGN KEY (`material_of_sample_idmaterial_of_sample`) REFERENCES `material_of_sample` (`idmaterial_of_sample`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_samples_patients1` FOREIGN KEY (`patients_idpatient`) REFERENCES `patients` (`idpatient`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `fk_service_lab_equipment1` FOREIGN KEY (`lab_equipment_idlab_equipment`) REFERENCES `lab_equipment` (`idlab_equipment`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `w_personal_data`
--
ALTER TABLE `w_personal_data`
  ADD CONSTRAINT `fk_w_personal_data_position1` FOREIGN KEY (`position_idposition`) REFERENCES `position` (`idposition`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
