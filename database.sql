SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `link` (`id`, `link`, `page_id`) VALUES
(1, 'space', 1),
(2, 'denebola', 2);

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mime` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `page` (`id`, `mime`, `title`, `text`) VALUES
(1, 'text/html', 'Space Pilot 3000', '<h1>Space Pilot 3000</h1>\r\n<p>Uh, is the puppy mechanical in any way? You seem malnourished. Are you suffering from intestinal parasites? Oh, I always feared he might run off like this. Why, why, why didn''t I break his legs? Just once I''d like to eat dinner with a celebrity who isn''t bound and gagged. Why would I want to know that? You lived before you met me?!</p>\r\n<h2>The Duh-Vinci Code</h2>\r\n<p>You seem malnourished. Are you suffering from intestinal parasites? OK, this has gotta stop. I''m going to remind Fry of his humanity the way only a woman can. Professor, make a woman out of me. Yep, I remember. They came in last at the Olympics, then retired to promote alcoholic beverages!</p>\r\n<ul>\r\n<li>I guess because my parents keep telling me to be more ladylike. As though!</li>\r\n<li>Well, then good news! It''s a suppository.</li>\r\n</ul>\r\n<h3>Anthology of Interest I</h3>\r\n<p>I am the man with no name, Zapp Brannigan! Oh God, what have I done? Incidentally, you have a dime up your nose. Stop it, stop it. It''s fine. I will ''destroy'' you!</p>\r\n<h4>Bendless Love</h4>\r\n<p>Also Zoidberg. It doesn''t look so shiny to me. Hello Morbo, how''s the family?</p>\r\n<ol>\r\n<li>In your time, yes, but nowadays shut up! Besides, these are adult stemcells, harvested from perfectly healthy adults whom I killed for their stemcells.</li>\r\n<li>You are the last hope of the universe.</li>\r\n<li>I daresay that Fry has discovered the smelliest object in the known universe!</li>\r\n</ol>\r\n<h5>The Birdbot of Ice-Catraz</h5>\r\n<p>Oh dear! She''s stuck in an infinite loop, and he''s an idiot! Well, that''s love for you. Throw her in the brig. I''ve been there. My folks were always on me to groom myself and wear underpants. What am I, the pope? I just told you! You''ve killed me! That''s a popular name today. Little "e", big "B"?</p>'),
(2, 'text/plain', 'Денебола', 'Денебола\r\n========\r\n\r\nМатериал из Википедии — свободной энциклопедии\r\n\r\nДенебо́ла (β Льва / β Leonis) — третья по яркости звезда в созвездии \r\nЛьва после Регула и Альгиебы. Это звезда спектрального класса А, \r\nрасположенная примерно в 36 световых годах от Земли. Её светимость \r\nв 12 раз превосходит солнечную. Видимый блеск составляет 2,14^m^.\r\n\r\n## Этимология\r\n\r\nНазвание звезды происходит от *Deneb Alased*, от арабской фразы **ذنب\r\nالاسد** *ðanab al-asad* «хвост льва», так как она символизирует хвост\r\nльва — таково положение звезды в созвездии Льва. В звездном\r\nатласе Ричарда Проктора 1871 года звезда была обозначена как *Deneb\r\nAleet*. Для древних китайских астрономов она была частью\r\nпятизвёздного *Woo Ti Tsi*: Трона Двенадцати Императоров.\r\nВ астрологии Денебола считалась предвестником несчастья и позора.\r\n\r\nВ Уранометрии, изданной Иоганном Байером в 1603 году, звезда была\r\nобозначена β Льва, как вторая по яркости звезда в созвездии Льва. В\r\n1725 Джон Флемстид обозначил эту звезду 94 Льва. (В отличие от Байера,\r\nФлемстид обозначал звёзды в порядке увеличения прямого восхождения, а не\r\nблеска). Дополнительные обозначения этой звезды были опубликованы в\r\nболее поздних звездных каталогах.\r\n\r\n## Свойства\r\n\r\nЭто относительно молодая звезда с возрастом, оцененным менее чем в 400\r\nмиллионов лет. Радиус звезды, определённой с помощью интерферометрии,\r\nприблизительно в 1,73 раза больше радиуса Солнца. Звезда имеет массу на\r\n75 % больше солнечной, поэтому её светимость намного больше солнечной, а\r\nсрок жизни на [главной последовательности][] — меньше.\r\n\r\nПоверхностная температура Денеболы составляет около 8500 K. Она имеет\r\nвысокую скорость вращения (как минимум 120 км/с), которая не так далека\r\nот этой величины для очень быстро вращающейся звезды Ахернар. По\r\nсравнению с ними, у Солнца намного меньшая скорость экваториального\r\nвращения — 2 км/с. Эта звезда является переменной звездой типа δ\r\nЩита, блеск звезды изменяется на 0,025 звёздной величины с периодом\r\nпорядка 2—3 часов.');

ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
