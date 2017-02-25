-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                5.6.31 - MySQL Community Server (GPL)
-- Sunucu İşletim Sistemi:       Win32
-- HeidiSQL Sürüm:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- blog için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `blog`;

-- tablo yapısı dökülüyor blog.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

-- blog.categories: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Siyaset'),
	(2, 'Spor'),
	(8, 'Magazin'),
	(9, 'Tarih');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- tablo yapısı dökülüyor blog.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `visible` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

-- blog.comments: ~6 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `comment`, `datetime`, `ip`, `visible`) VALUES
	(9, 1, 'Asasdas ', 'admin@sirridemirtas.com', 'asdasdasd', '2004-07-20 00:00:00', '127.0.0.1', 1),
	(14, 1, 'Barack Obama ', 'b@obama.com', 'asdnaksjdnksa jnkasjnd jndkj anaskjd naskj dnaskdnk sndka na', '2005-07-20 00:00:00', '127.0.0.1', 1),
	(15, 2, 'Marcus Antonius', 'marcus@antonius.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto cupiditate, tempora dolore id dignissimos rem cumque sunt dolores ipsa facilis.', '2016-06-13 16:27:52', '127.0.0.1', 1),
	(16, 2, 'Mr. Smith', 'mr.smith@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto cupiditate, tempora dolore id dignissimos rem cumque sunt dolores ipsa facilis.', '2016-06-15 17:31:55', '127.0.0.1', 1),
	(17, 2, 'Admin', 'admin@localhost.com', 'Inventore corporis quibusdam iusto, sequi, placeat laudantium eum quisquam omnis quos quasi molestias!', '2016-06-18 17:34:44', '127.0.0.1', 1),
	(40, 2, 'john doe', 'asdsa@asd.com', 'asdasda aÄ±shdasl asdlaksj laksj d', '2017-01-29 16:20:34', '::1', 0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- tablo yapısı dökülüyor blog.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `readable` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

-- blog.messages: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `name`, `email`, `message`, `date`, `time`, `ip`, `readable`) VALUES
	(38, 'Jon Snow', 'jonsnow@winterfell.com', 'I now nothing.', '2030-06-20', '00:00:00', '127.0.0.1', '0'),
	(67, 'Eddard Stark ', 'ned@winterfell.com', 'Winter is coming.', '2002-07-20', '15:50:22', '127.0.0.1', '0'),
	(104, 'J. R. R. Tolkien ', 'jrr@tolkien.com', 'Yüzüklerin Efendisi (İng. The Lord of the Rings) İngiliz filolojist ve Oxford Üniversitesi profesörü J. R. R. Tolkien&#39;in yazdığı epik fantezi türündeki romandır. Hikaye Tolkien&#39;in çocuklar için yazdığı 1937 tarihli Hobbit&#39;in devamı olarak başlamıştı ancak sonunda ondan çok daha büyük bir eser haline geldi. Çoğu II. Dünya Savaşı&#39;nda olmak üzere 1937 ve 1949 yılları arasında aşamalar halinde yazıldı. 150 milyonun üstündeki satış sayısıyla tüm zamanların en çok satan ikinci romanıdır.', '2006-07-20', '15:12:51', '127.0.0.1', '0');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- tablo yapısı dökülüyor blog.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL DEFAULT '00:00:00',
  `readable` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

-- blog.notifications: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- tablo yapısı dökülüyor blog.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_time` datetime NOT NULL,
  `tags` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'publish',
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(10) NOT NULL DEFAULT '0',
  `comment_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- blog.posts: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `content`, `url`, `datetime`, `edit_time`, `tags`, `status`, `ip`, `password`, `views`, `comment_status`) VALUES
	(1, 'Hello World!', 'A "Hello, World!" program is a computer program that outputs or displays "Hello, World!" to the user. Being a very simple program in most programming languages, it is often used to illustrate the basic syntax of a programming language for a working program. It is often the very first program people write when they are new to the language.\r\n\r\nSource: <a href="https://en.wikipedia.org/wiki/%22Hello,_World!%22_program">Wikipedia</a>', 'hello-world', '2017-02-13 18:55:21', '2017-02-13 17:56:26', 'hello world', 'publish', '', '', 77, 'open'),
	(2, 'Greek Mythology', 'Greek mythology, as in other ancient cultures, was used as a means to explain the environment in which humankind lived, the natural phenomena they witnessed and the passing of time through the days, months, and seasons. Myths were also intricately connected to religion in the Greek world and explained the origin and lives of the gods, where humanity had come from and where it was going after death, and gave advice on the best way to lead a happy life. Finally, myths were used to re-tell historical events so that people could maintain contact with their ancestors, the wars they fought, and the places they explored.\r\n\r\n<h3>The Telling of Myths</h3>\r\nIn modern usage the term â€˜mythâ€™ perhaps has negative connotations suggesting a lack of authenticity and reliability. However, it should not be assumed that myths were whole-heartedly believed in nor should it be assumed that the Greeks were wholly sceptical of them. Probably, the Greek myths, as with any religious or non-written sources, were believed by some and discounted by others. Myths were certainly used for religious and educational purposes but also may well have had a simple aesthetic function of entertainment. What is certain is that the myths were both familiar and popular with a wide section of Greek society through their common representation in art, whether that be sculpture on public buildings or scenes painted on pottery. \r\n\r\nWithout wide-spread literacy, the passing on of myths was first done orally, probably by Minoan and Mycenaean bards from the 18th century BCE onwards. This of course allows for the possibility that with each re-telling of a particular myth, it is embellished and improved upon to increase audience interest or incorporate local events and prejudices. However, this also is a modern interpretation, for it is also possible that the telling of myths followed certain rules of presentation, and a knowledgeable audience may not have willingly accepted ad hoc adaptations to a familiar tale. Over centuries though, and with increasing contact between city-states, it is difficult to imagine that local stories did not become mixed with others to create a myth with several diverse origins.\r\n\r\nThe next development in the presentation of myths was the creation of poems in Ionia and the celebrated poems of Homer and Hesiod around the 8th century BCE. For the first time mythology was presented in written form. Homerâ€™s Iliad recounts the final stages of the Trojan War - perhaps an amalgamation of many conflicts between Greeks and their eastern neighbours in the late Bronze Age (1800-1200 BCE) - and the Odyssey recounts the protracted voyage home of the hero Odysseus following the Trojan War. Hesiodâ€™s Theogony gives a genealogy of the gods, and his Works and Days describes the creation of man. Not only are gods described with typically human feelings and failings but also heroes are created, often with one divine parent and the other mortal, thus providing a link between man and the gods.  \r\n\r\nThe next principal representation of myths was through pottery from the 8th century BCE onwards. A myriad of mythical scenes decorate ceramics of all shapes and function and must surely have spread the myths to a wider audience.\r\n\r\nThe myths continued to be popular through the centuries, and major public buildings such as the Parthenon at Athens, the Temple of Zeus at Olympia, and the Temple to Apollo at Delphi were decorated with larger-than-life sculpture representing celebrated scenes from mythology. In the 5th century BCE the myths were presented in the new format of theatre, especially in the works of the three tragedians Aeschylus, Sophocles, and Euripides. At the same time, from the 6th century BCE the first documented scepticism and even rejection of the myths began with the pre-Socratic philosophers who searched for a more scientific explanation for phenomena and events. Finally, in the 5th century BCE the first historians Herodotus and Thucydides sought to document as accurately as possible and record for posterity a less subjective view of events and so the modern subject of history was born.  \r\n\r\n<h3>Greek Myths - an Overview</h3>\r\nBroadly speaking, the imaginative Greeks created myths to explain just about every element of the human condition. The creation of the world is explained through two stories where a son usurps the place of his father - Cronus from Ouranos and Zeus from Cronus - perhaps referring to the eternal struggle which exists between different generations and family members. The Olympian gods led by Zeus twice defeated the sources of chaos represented by the Titans and the Giants. These gods then, rule manâ€™s destiny and sometimes directly interfere - favourably or otherwise. Indeed, the view that events are not humanâ€™s to decide is further evidenced by the specific gods of Fate and Destiny. A further mythological explanation of the seemingly random nature of life is the blind god Pluto who randomly distributes wealth. The gods also illustrated that misdemeanours would be punished, e.g., Prometheus for stealing fire and giving it to man. The origin of other skills such as medicine and music are also explained as â€˜divineâ€™ gifts, for example, Apollo passing on to his son Asklepios medicinal knowledge for manâ€™s benefit. Finally, certain abstract concepts were also represented by specific gods, e.g., Justice (Dike), Peace (Eirene), and Lawfulness (Eunomia).\r\n\r\nThe Heroes - the most famous being Hercules, Achilles, Jason, Perseus, and Theseus but including a great many more - all have divine parents and therefore bridge the gap between mortals and gods. They pursue fantastic adventures and epitomise ideal qualities such as perseverance e.g., Herculesâ€™ twelve labours, or fidelity e.g., Penelope waiting faithfully for Odysseusâ€™ return. Heroes also added prestige to a city by being credited as its founder, e.g., Theseus for Athens, Perseus for Mycenae, or Kadmus for Thebes. The heroes and events such as the Trojan War also represented a past golden age when men were greater and life was easier. Heroes then were examples to aspire to, and by doing great deeds a certain immortality could be reached, either absolutely (as in the case of Hercules) or through commemoration in myth and tradition.\r\n\r\nIn contrast, many mythological figures represent qualities to be avoided and their sad tales illustrate the dangers of bad behaviour. King Midas, for example, was granted his wish that everything he touched turned to gold, but when he found out that this included food and drink, his avarice almost resulted in his death from starvation and thirst. The myth of Narcissus symbolises the dangers of vanity after the poor youth fell in love with his own reflection and he lost the will to live. Finally, the story of Croesus warns that vast riches cannot guarantee happiness when the fabulously rich King misinterpreted the Delphic oracle and lost his kingdom to Persia. \r\n\r\nNatural phenomena were explained with myth, e.g., earthquakes are created when Poseidon crashes his trident to the ground or the passage of the sun is Helios in his chariot riding across the sky. Myths such as Persephoneâ€™s half year descent to Hades explained the seasons. Time itself had mythological explanations: Heliosâ€™ seven herds of 350 cattle correlate to the days of the year, Seleneâ€™s 50 daughters are the weeks, and Heliosâ€™ twelve daughters the hours.\r\n\r\nGreek mythology also includes a number of monsters and strange creatures such as the one-eyed Cyclops in the Odysseus story, a gigantic boar in the fabled Kalydonian hunt, sphinxes, giant snakes, fire-breathing bulls and more. These creatures may represent chaos and lack of reason, for example, the centaurs - half-man and half-horse. Fierce and fantastic creatures often emphasise the difficulty of the tasks heroes are set, for example, the many-headed Hydra to be killed by Hercules, the gorgon Medusa whose look could turn you into stone and whom Perseus had to behead, or the Chimera - a fire-breathing mix of lion, goat and snake - which Bellerophon killed with the help of his winged-horse Pegasus. Alternatively, they may represent the other-worldliness of certain places, for example the three-headed dog Kerberos which guarded Hades or simply symbolised the exotic wildlife of distant lands visited by Greek travellers. \r\n\r\nPerhaps unfamiliar experiences were also explained in myth, for example, one can imagine that a Greek visiting King Minosâ€™ sophisticated and many-roomed palace at Knossos might have thought it a labyrinth, and the worship there of bulls and the sport of bull-leaping might be the source of the Minotaur - is it coincidence it was killed by the visiting Athenian, Theseus? Could Jasonâ€™s expedition for the Golden Fleece be a reference to the rich gold of the Caucasus and a Greek expedition to plunder this resource? Do the Amazons represent an encounter with another culture where women were treated more equally than in the Greek world? Do the myths of the Sirens and Charybdis warn of the dangers of travel beyond familiar territory?\r\n\r\nSuch questions may well remain unanswered but starting with the discovery of Troy in the 19th century CE, archaeological finds have steadily contributed an ever-growing body of physical evidence which illustrates that the Greek myths had an origin and a purpose they were not previously credited with. \r\n\r\nSource: <a href="http://www.ancient.eu/Greek_Mythology/">Ancient History Encyclopedia</a>', 'greek-mythology', '2017-02-13 19:04:03', '2017-02-13 18:06:30', 'greek mythology', 'publish', '', '', 64, 'open'),
	(3, 'Janissary Music', 'Janissary music, also called Turkish music, in a narrow sense, the music of the Turkish military establishment, particularly of the Janissaries, an elite corps of royal bodyguards (disbanded 1826); in a broad sense, a particular repertory of European music the military aspect of which derives from conscious imitation of the music of the Janissaries.\r\n\r\n<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3b/Mehter_march.jpg/1024px-Mehter_march.jpg" alt="Janissary"/><small>Image source: Wikipedia</small>\r\n\r\nCharacteristic of Janissary music is its use of a great variety of drums and bells and the combination of bass drum, triangle, and cymbals. Janissary music probably appeared in Europe for the first time in 1720, when it was adopted by the army of the Polish ruler ...\r\n\r\nSource: <a href="https://global.britannica.com/topic/Janissary-music">Britannica</a>', 'janissary-music', '2017-02-13 19:19:59', '2017-02-13 18:20:55', 'janissary music', 'publish', '', '', 91, 'closed'),
	(4, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio laboriosam magnam animi asperiores sit eum numquam sapiente ullam veniam ab laudantium eligendi, et laborum nisi impedit. Nisi sapiente, ipsa, quia obcaecati repellat suscipit mollitia, incidunt perferendis at quos tenetur modi pariatur optio natus quasi dolorem! Hic doloribus quos ipsa rerum ut, voluptatem quod tempore officia totam animi. \r\n\r\nDeleniti ipsam assumenda maiores ducimus explicabo consequatur velit, vero quos perferendis blanditiis, odit consectetur autem illum pariatur nulla veniam tenetur, neque accusamus vel a reprehenderit quidem. Quasi sit repellendus perferendis, saepe error deserunt cum aut molestias molestiae beatae accusamus, voluptatibus voluptatum! A, maiores.', 'lorem-ipsum', '2017-02-14 10:52:05', '2017-02-18 18:54:32', 'lorem ipsum, dolor, sit amet', 'publish', '', '', 96, 'closed');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- tablo yapısı dökülüyor blog.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'tr-TR',
  `status` int(1) NOT NULL DEFAULT '0',
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`username`),
  UNIQUE KEY `user_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

-- blog.users: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `username`, `password`, `name`, `surname`, `language`, `status`, `token`) VALUES
	(1, 'admin@sirridemirtas.com', 'srr', '56397d952c6ba7d29e04e3da5625885cd6d24162', 'Sirri Demirtas', 'Demirtaş', 'tr-TR', 0, '8f0c8f0003bf000dea74d8197df8e765');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
