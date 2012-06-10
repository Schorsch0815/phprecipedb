-- Adminer 3.3.4 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `tbl_ingredient` (`id`, `name`, `unit_usage`, `cologne_phony_code`, `soundex_code`) VALUES
(1,	'Hühnchen',	5,	'0646',	'H525'),
(2,	'Butter',	1,	'127',	'B360'),
(3,	'Zucker',	9,	'847',	'Z260'),
(4,	'Mehl',	9,	'65',	'M400'),
(5,	'Hefe',	8,	'03',	'H100'),
(6,	'Milch',	10,	'654',	'M420'),
(7,	'Wasser',	10,	'387',	'W260'),
(8,	'Hackfleisch (gemischt)',	1,	'043584682',	'H214'),
(9,	'Vanillezucker',	8,	'365847',	'V542'),
(10,	'Salz',	9,	'858',	'S420'),
(11,	'Öl',	10,	'5',	'L000'),
(12,	'Hackfleisch (Rind)',	1,	'04358762',	'H214'),
(13,	'Hühnchenfilet',	4,	'0646352',	'H525');


INSERT INTO `tbl_unit` (`id`, `short_desc`, `description`, `unit_type_id`, `is_base_unit`, `base_unit_factor`) VALUES
(1,	'g',	'Gramm',	1,	1,	1),
(2,	'ml',	'Milliliter',	2,	1,	1),
(3,	'St',	'Stück',	3,	1,	1),
(4,	'kg',	'Kilogramm',	1,	0,	1000);

INSERT INTO `tbl_unit_type` (`id`, `name`) VALUES
(1,	'Gewichtsangabe'),
(2,	'Flüssigkeitmenge'),
(3,	'Stück'),
(4,	'Andere Einheit');


-- 2012-04-11 08:36:40
