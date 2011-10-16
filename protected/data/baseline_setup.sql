-- Adminer 3.2.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `tbl_ingredient` (`id`, `name`) VALUES
(1,     'Hühnchen',               5),
(2,     'Butter',                 1),
(3,     'Zucker',                 1),
(4,     'Mehl',                   1),
(5,     'Hefe',                   5),
(6,     'Milch',                  2),
(7,     'Wasser',                 2),
(8,     'Hackfleisch (gemischt)', 1),
(9,     'Vanillezucker',          5),
(10,    'Salz',                   5),
(11,    'Öl',                     2);

INSERT INTO `tbl_unit` (`id`, `short_desc`, `description`, `unit_type_id`, `is_base_unit`, `base_unit_factor`) VALUES
(1,     'g',        'Gramm',        2,    1,    1),
(2,     'ml',       'Milliliter',   3,    1,    1),
(3,     'Stk',      'Stück',        4,    1,    1),
(4,     'kg',       'Kilogramm',    1,    0,    1000);

INSERT INTO `tbl_unit_type` (`id`, `name`) VALUES
(1,    ''),
(2,    'Gewicht'),
(3,    'Flüssigkeit'),
(4,    'Stück');

-- 2011-04-02 06:30:09
