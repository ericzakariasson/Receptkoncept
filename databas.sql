-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 22 maj 2016 kl 22:51
-- Serverversion: 5.6.17
-- PHP-version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `recipe`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `ingredient_id` int(255) NOT NULL AUTO_INCREMENT,
  `ingredient_name` varchar(32) NOT NULL,
  `ingredient_unit` varchar(16) NOT NULL DEFAULT 'g',
  PRIMARY KEY (`ingredient_id`),
  UNIQUE KEY `ingredient_name` (`ingredient_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumpning av Data i tabell `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `ingredient_name`, `ingredient_unit`) VALUES
(1, 'Bacon', 'g'),
(2, 'Morot', 'g'),
(3, 'Grädde', 'dl'),
(4, 'Lök', 'st'),
(5, 'Spaghetti', 'g'),
(6, 'Parmesanost', 'g'),
(7, 'Salt', ''),
(8, 'Peppar', ''),
(9, 'Ägg', 'st'),
(10, 'Äggulor', 'st'),
(11, 'Fettuccine', 'g'),
(12, 'Persilja', 'g'),
(13, 'Västerbottenost', 'g'),
(14, 'Sötpotatis', 'g'),
(15, 'Olivolja', 'dl'),
(16, 'Sockerärter', 'g'),
(17, 'Bladspenat', 'g'),
(18, 'Röd peppar', 'g'),
(19, 'Koriander', 'g'),
(20, 'Limejuice', 'dl'),
(21, 'Gul lök', 'st'),
(22, 'Butternutpumpa', 'st'),
(23, 'Blomkålshuvud', 'st'),
(24, 'Chili', 'st'),
(25, 'Vitlöksklyftor', 'st'),
(26, 'Kikärtor', 'g'),
(27, 'Babyspenat', 'g'),
(28, 'Naturell yoghurt', 'g'),
(29, 'Ris', 'dl'),
(30, 'Kryddnejlikor', 'st'),
(31, 'Flagad mandel', 'dl'),
(32, 'Ingefära', 'g'),
(33, 'Citron', 'st'),
(34, 'Chapatibröd', 'st'),
(35, 'Gurkmeja', 'tsk'),
(36, 'Senapsfrö', 'tsk'),
(37, 'Havssalt', ''),
(38, 'Papadums', 'st'),
(39, 'Öl', 'st');

-- --------------------------------------------------------

--
-- Tabellstruktur `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
  `recipe_id` int(255) NOT NULL AUTO_INCREMENT,
  `recipe_name` varchar(255) NOT NULL,
  `recipe_description` varchar(255) NOT NULL,
  `recipe_img` varchar(64) NOT NULL,
  `recipe_time` tinyint(4) NOT NULL,
  `vegetarian` tinyint(1) NOT NULL DEFAULT '0',
  `vegan` tinyint(1) NOT NULL DEFAULT '0',
  `lactose_free` tinyint(1) NOT NULL DEFAULT '0',
  `gluten_free` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`recipe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumpning av Data i tabell `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `recipe_name`, `recipe_description`, `recipe_img`, `recipe_time`, `vegetarian`, `vegan`, `lactose_free`, `gluten_free`) VALUES
(1, 'Pasta Carbonara', 'Gott och klassiskt recept på pasta carbonara, men på ett lite enklare sätt.', 'img/recipe_img/1.jpg', 30, 0, 0, 0, 0),
(2, 'Sötpotatissallad ”Sweet Garage potato salad” ', 'På jakt efter att variera den ack så klassiska potatissalladen? Då har du svaret i den här fräscha sötpotatissalladen med krispiga sockerärter, bladspenat, röd chili, koriander och lime. Perfekt till kyckling, korv och annat grillat.', 'img/recipe_img/2.jpg', 45, 1, 1, 1, 1),
(3, 'Jamie Olivers vegetariska currygryta', 'Den indiska vegogrytan rogan josh serverar Jamie med fluffigt ris, morotssallad, citronpickles, pappadums och chapati.', 'img/recipe_img/3.jpg', 30, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `recipe_ingredients`
--

CREATE TABLE IF NOT EXISTS `recipe_ingredients` (
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `amount_required` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`recipe_id`, `ingredient_id`, `amount_required`) VALUES
(1, 1, '150'),
(1, 4, '1'),
(1, 11, '125'),
(1, 8, ''),
(1, 7, ''),
(1, 6, '125'),
(1, 10, '2'),
(1, 3, '1'),
(1, 12, '50'),
(2, 14, '150'),
(2, 15, '0.0375'),
(2, 7, ''),
(2, 8, ''),
(2, 16, '37.5'),
(2, 17, '20'),
(2, 18, '20'),
(2, 19, '50'),
(2, 20, '0.0375'),
(3, 21, '0.5'),
(3, 22, '0.25'),
(3, 23, '0.25'),
(3, 24, '0.25'),
(3, 25, '1'),
(3, 19, '25'),
(3, 26, '100'),
(3, 27, '25'),
(3, 28, '125'),
(3, 29, '0.625'),
(3, 30, '1'),
(3, 31, '0.25'),
(3, 2, '150'),
(3, 32, '50'),
(3, 33, '0.25'),
(3, 34, '1'),
(3, 35, '0.25'),
(3, 15, '0.25'),
(3, 38, '1'),
(3, 39, '1'),
(3, 36, '0.5'),
(3, 37, '');

-- --------------------------------------------------------

--
-- Tabellstruktur `recipe_steps`
--

CREATE TABLE IF NOT EXISTS `recipe_steps` (
  `recipe_id` int(11) NOT NULL,
  `step_number` int(32) NOT NULL,
  `instructions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `recipe_steps`
--

INSERT INTO `recipe_steps` (`recipe_id`, `step_number`, `instructions`) VALUES
(1, 1, 'Skär baconen först på långsidan och sedan i småbitar på kortsidan. Sätt på en stekpanna på högsta värmen, använd ingen olja eller smör i pannan. Fräs först halva baconen (allt kommer inte få plats första gången).'),
(1, 2, 'När de börjar få en knaprig yta, utan att vara för hårda så tar du bort dem från pannan och häller av i ett durkslag med hushållspapper så att det värsta fettet försvinner. Stek sedan resten av baconet'),
(1, 3, 'Koka upp en kastrull med vatten till pastan. Häll i rikligt med salt. När vattnet kokar skall pastan i. Det står på förpackningen hur länge det skall vara i, ställ en äggklocka.'),
(1, 4, 'När pastan är klar så häller du av vattnet i ett durkslag. Allt vatten skall bort. Häll sedan tillbaka pastan i kastrullen och sedan i med den avfettade baconen.'),
(1, 5, 'Rör sedan ned en halv förpackning grädde, riven ost och 4-5 äggulor. Sist häller du i lite svartpeppar så att det blir små svarta prickar lite överallt, men inte för tätt. Rör runt och servera sedan på 4 olika tallrikar.'),
(1, 6, 'Toppa varje tallrik med en persiljekvist samt en äggula i ett halvt äggskal.'),
(2, 1, 'Sätt ugnen på 200°C'),
(2, 2, 'Sallad: Skala och skär sötpotatisen i cm-tjocka skivor. Lägg på en bakpappersklädd plåt. Blanda med olja, salt och peppar. Ställ in i mitten av ugnen ca 15 minuter.'),
(2, 3, 'Strimla sockerärterna.'),
(2, 2, 'Dressing: Dela, kärna ur och finhacka chilin. Blanda chili, koriander, limejuice, olja, salt och peppar.'),
(2, 5, 'Sallad: Varva sötpotatis, sockerärter och spenat. Ringla dressingen över.'),
(3, 1, 'Läs igenom hela receptet och förbered alla ingredienser och all utrustning som du behöver.'),
(3, 2, 'Fyll vattenkokaren med vatten och koka upp.'),
(3, 3, 'Sätt en stor kastrull eller gryta på hög värme.'),
(3, 4, 'Sätt ugnen på 180 grader. Ställ in matberedaren på grovrivning.'),
(3, 5, 'Skala och hacka löken och lägg i kastrullen med en skvätt vatten och rikligt med olivolja'),
(3, 6, 'Dela pumpan försiktigt på mitten (för att spara tid använder jag bara toppen som inte har några frön, men du kan spara botten till senare tillfälle) Skär längs med i fyra delar och skiva sedan i 1 cm stora bitar tvärs över. Du behöver inte skala.'),
(3, 7, 'Lägg bitarna i stekpannan med löken.'),
(3, 8, 'Ansa blomkålen och ta bort bladen. Skär i munsbitsstrora bitar och lägg dem i pannan (om du vill ha lite extra krydda kan du skiva ner färsk chili nu).'),
(3, 9, 'Krossa vitlöken med skalet på och finhacka koriandern med stjälkar och allt.'),
(3, 10, 'Spara några korianderblad till dekoration. Lägg allt i pannan tillsammans med en rejäl skvätt kokande vatten.'),
(3, 11, 'Tillsätt kryddpastan och kikärtorna med spadet från burken. Rör om väl och sätt sedan ett lock på grytan.'),
(3, 12, 'Låt stormkoka och rör om då och då.'),
(3, 13, 'Häll riset i en medelstor kastrull med en skvätt olivolja och några kryddnejlikor.'),
(3, 14, 'Tillsätt 2 koppar(samma storlek som koppen med ris) kokande vatten.'),
(3, 15, 'Tillsätt en nypa salt och sätt sedan på locket och låt koka på medelhög värme i ca 7 minuter. Fyll vattenkokaren med nytt vatten och koka upp.'),
(3, 16, 'Knyckla ihop ett stort ark smörpapper under rinnande vatten.'),
(3, 17, 'Släta ut arket igen och lägg chapatibröden i lager ovanpå. Stänk lite olivolja och pudra gurkmeja över varje bröd.\r\n'),
(3, 18, 'Slå in bröden i pappret och sätt in dem i mitten av ugnen.\r\n'),
(3, 19, 'Rosta mandelflagorna under omrörning i en liten stekpanna på medelhög värme, tills de får lite färg. Lägg mandeln i en liten skål.\r\n'),
(3, 20, 'Tvätta och ansa morötterna, riv dem grovt i matberedaren tillsammans med chilin(ta bort stjälk och frön först), en tredjedel av koriandern och skalad ingefära.\r\n'),
(3, 21, 'Lägg över i en serveringsskål.\r\n'),
(3, 22, 'Kolla till grytan och tillsätt lite vatten om det ser torrt ut. Rör om och sätt på locket igen.\r\n'),
(3, 23, 'Nu ska det ha gått 7 minuter, så ta bort riset från värmen och ställ åt sidan med locket på så att det får ånga till sig i 7 minuter till och bli riktigt fluffigt.\r\n'),
(3, 24, 'Ringla lite av den finare olivoljan(extra virgin) över salladen och strö över en nypa salt.\r\n'),
(3, 25, 'Riv över citronskal och pressa ner lite citronsaft. Blanda väl och toppa salladen med rostade mandelflagor och lite korianderblad.\r\n'),
(3, 26, 'Ta locket från grytan. Kolla av konsistensen och tillsätt med av det kokande vattnet om det behövs. Hur ”blöt” grytan ska vara bestämmer du själv – prova även att mosa en del av grönsakerna för att få lite variation i texturen.\r\n'),
(3, 27, 'Smaka upp med salt och rör ner spenaten.\r\n'),
(3, 28, 'Skär citronen i åtta delar, ta ur kärnorna och finhacka. Finhacka även chilifrukten.\r\n'),
(3, 29, 'Sätt tillbaka stekpannan som du rostade mandlarna i på plattan med medelhög till hög värme.\r\n'),
(3, 30, 'Ringla i lite olivolja och tillsätt senapsfrön, gurkmeja och hackad chili. Smula även ner den torkade chilin.\r\n'),
(3, 31, 'När det börjar fräsa i pannan tillsätter du den hackade citronen och en nypa salt, räkna till 10 och ta sedan pannan från plattan och häll över blandningen i en skål för att svalna.\r\n'),
(3, 32, 'Häll upp hälften av yoghurten i en liten skål.\r\n'),
(3, 33, 'Ringla över olivolja(extra virgin) och ställ fram på bordet med pappadums och skålen med citronpickles.\r\n'),
(3, 34, 'Ställ fram de varma chapatibröden direkt från ugnen.'),
(3, 35, 'Häll över currygrytan och riset i stora serveringsskålar.'),
(3, 36, 'Toppa grytan med resten av yoghurten och lite korianderblad.'),
(3, 37, 'Öppna en kall öl och hugg in!');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `passwordHash`) VALUES
(4, 'abc', 'mail@mail.com', '$2y$10$hDIsoGX8Us84hG6TX8Okw.3htCgRu0jTqpbHJDy096ureCkE887Q6'),
(5, 'kentagent1337', 'cp12ar@hotmail.com', '$2y$10$lUPC/Odo9PUlUP98wIrll.Y8EuN3Zu8u1tiBhZJt2Et5XOKmeQYHO'),
(16, 'kentA', 'hej@mauk.com', '$2y$10$8PVzhsK8FjzDiSn4jqUNnuHPCt9T0E2rxa10tbpkeQu4GNK4CNUn6'),
(18, 'hejsasaansans', 'mail@xn--msasco-zxa.com', '$2y$10$4Om.a4WF2etNxIBSh4CyTeCPYZ7wUbOiNYDIiMVrAIlugVJ0VdsW.'),
(19, 'ny', 'ny@ny.se', '$2y$10$sNgQoWPIR6w4vbpPWcr74OUSULya6zdSTcjXT7CRKStepPPZ2ZHTy'),
(20, 'ny1', 'ny1@mail.com', '$2y$10$pvpyQ7LlbBfHUnl0g7jDU.HP4rRFtk1XWMk6tPTrP6MAICS7NisTC'),
(22, 'hej', 'hej@hej.se', '$2y$10$417VXQz3oU9ONuVD1I3K2emYfRBBg9BW8shWRkoqlgKBSRm5OQdBW'),
(24, 'hejsan', 'hejsan@mail.com', '$2y$10$ClLyXuh.EzFEp1LSPHM9NOk0ny/HrmL5z3yoF4ZdxFpcgfFKOU6H.'),
(25, 'ny111', 'ny@mailss.com', '$2y$10$U7I1NinFBtp49VBhH.paruk/avro.9HP/CHMRBsbqNTI8inZNvSpe'),
(26, 'asasd', 'asdassad@masdsasad.com', '$2y$10$Sld8wZlG8wPVhrebdTU8delqancKdTo7m5M0CBF4k/LMcF686bRbS'),
(27, 'asdasfdssdfd', 'asdasdasvdv@madasds.com', '$2y$10$QmjDOVT0xjrqmlb4iNheduSpV9YTy7S0.EwLOXjhWpLuJeblwePBy');

-- --------------------------------------------------------

--
-- Tabellstruktur `user_ingredients`
--

CREATE TABLE IF NOT EXISTS `user_ingredients` (
  `user_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `user_ingredients`
--

INSERT INTO `user_ingredients` (`user_id`, `ingredient_id`) VALUES
(4, 18),
(4, 5),
(4, 1),
(4, 3),
(4, 35),
(4, 9),
(4, 15),
(4, 25),
(4, 19),
(4, 17),
(4, 27);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
