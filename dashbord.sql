-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 11 juil. 2021 à 10:26
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dashbord`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartement`
--

DROP TABLE IF EXISTS `appartement`;
CREATE TABLE IF NOT EXISTS `appartement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) DEFAULT NULL,
  `quatier` varchar(200) DEFAULT NULL,
  `prix` varchar(255) DEFAULT NULL,
  `chambre` varchar(255) DEFAULT NULL,
  `douche` varchar(255) DEFAULT NULL,
  `dimension` varchar(255) DEFAULT NULL,
  `salon` varchar(255) DEFAULT NULL,
  `adresse` text,
  `image` varchar(200) DEFAULT NULL,
  `emplacement` varchar(200) DEFAULT NULL,
  `etat` varchar(255) DEFAULT NULL,
  `caution` varchar(255) DEFAULT NULL,
  `probleme` varchar(255) DEFAULT NULL,
  `video` text,
  `plan` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `appartement`
--

INSERT INTO `appartement` (`id`, `nom`, `quatier`, `prix`, `chambre`, `douche`, `dimension`, `salon`, `adresse`, `image`, `emplacement`, `etat`, `caution`, `probleme`, `video`, `plan`, `description`) VALUES
(32, 'Appartement 1', 'VDN grand Yoff', '260.000 Fcfa', '15', '5', '1000 m²', '3', 'Quatier tchinvié', 'IMG-60c1f79e76ee63.36263594.jpg', 'Sénégal/ Dakar', 'nouvelle construction', '1.000.000', 'Néant', 'test', 'PLAN-60c1f79e7e98f5.51892820.jpg', '<p>1000 m&sup2;</p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `passe` varchar(60) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `email`, `passe`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`) VALUES
(2, 'abibouislam@yahoo.fr', '$2y$10$1pEa5.gCU0Rm3zpBhowxceZx205cUUpOcYlAw89fxPRzVVkynq/7S', NULL, '2021-05-08 19:15:35', 'HtaUfTU0h037S7VQqzzwZQaxq2UEffsxsFy6q61saQxkizQKPQPH0APnsFF8', '2021-06-04 20:22:30'),
(3, 'abibouislam@yahoo.frg', '$2y$10$3ypksWNeC4TlcDeATrbPEuaG6jK2xoRtgrPJmzLOW7AhOT/U5Rdxa', 'm6LpgckcEJdXyNH44mGTot5acr4axGh2sKomMXdSILno9zAJO6YQXLKKAteh', NULL, NULL, NULL),
(4, 'islamabibou8282@gmail.com', '$2y$10$3.JcxL5Ynl2cl3m74zGgwOmPKmkvHZtPUgPtSHO0M8xPtNhUNZ1S2', 'fYr9v9BuW05DtnIkVWQ52sHGDlTmxuYeA7Jz4nlgip6VANMGBfcfheH7Imuj', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

DROP TABLE IF EXISTS `emplois`;
CREATE TABLE IF NOT EXISTS `emplois` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `lien` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emplois`
--

INSERT INTO `emplois` (`id`, `nom`, `lieu`, `lien`, `etat`, `couleur`) VALUES
(3, 'islam', '<p>fini</p>\r\n', 'c\'est un chemin d\'or', 'Indisponible', 'Rouge'),
(4, 'bod', '<p><strong>momentan&eacute;ment </strong><em>occup&eacute; <strong>tyfytftyfyt</strong></em></p>\r\n', 'fvcgtvfgt', 'Disponible', 'Vert');

-- --------------------------------------------------------

--
-- Structure de la table `plaintes`
--

DROP TABLE IF EXISTS `plaintes`;
CREATE TABLE IF NOT EXISTS `plaintes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `plaintes`
--

INSERT INTO `plaintes` (`id`, `nom`, `email`, `objet`, `message`, `id_user`) VALUES
(2, 'islam islam', 'abibouislam@yahoo.fr', 'DolÃ©ance', 'vvhjhjjhjh', 0),
(4, 'islam', 'islamabibou8282@gmail.com', 'salako', '<p>lui 2</p>\r\n', 2);

-- --------------------------------------------------------

--
-- Structure de la table `rapidappart`
--

DROP TABLE IF EXISTS `rapidappart`;
CREATE TABLE IF NOT EXISTS `rapidappart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rapidappart`
--

INSERT INTO `rapidappart` (`id`, `nom`, `email`, `objet`, `message`) VALUES
(12, 'islam islam', 'abibouislam@yahoo.fr', 'vas chier', '<?php\r\nsession_start();\r\n  if(!empty($_POST)){\r\n\r\n        $pdo = new PDO (\'mysql:host=localhost;dbname=dashbord\', \'root\', \'\');\r\n        $req = $pdo->prepare(\"INSERT INTO rapidappart SET nom=?, email=?, objet=?, message = ?\");\r\n        $req ->execute([$_POST[\'name\'], $_POST [\'mail\'], $_POST [\'subject\'], $_POST [\'comment\']]);\r\n\r\n        // if(isset($_POST[\'mail\'])){\r\n        //     $entete  = \'MIME-Version: 1.0\' . \"\\r\\n\";\r\n        //     $entete .= \'Content-type: text/html; charset=utf-8\' . \"\\r\\n\";\r\n        //     $entete .= \'From: \' . $_POST[\'mail\'] . \"\\r\\n\";\r\n    \r\n        //     $message = \'<h1>Demande de crÃ©dit</h1>\r\n        //     <p><b>Nom : </b>\' . $_POST[\'name\'] . \'<br>\r\n        //     <b>Email : </b>\' . $_POST[\'mail\'] . \'<br>\r\n        //     <b>Montant : </b>\' . $_POST[\'subject\'] . \'<br>\r\n        //     <b>Message : </b>\' . $_POST[\'comment\'] .\'</p>\';\r\n    \r\n        //     $retour = mail(\'contact@gmail.com\', \'Demande de crÃ©dit\', $message, $entete);\r\n        // }\r\n        $_SESSION[\'flash\'][\'success\'] = \"Message reÃ§u avec succes. Nous prennons en compte votre requÃªte et nous promettons de revenir vers vous trÃ¨s prochainement!\";\r\n        header(\'Location: contact.php\');\r\n      exit();\r\n    }\r\n\r\n      $title = \'RapidAppart | contact\';\r\n      require \'inc/header.php\';\r\n  ?>\r\n\r\n  <main id=\"main\">\r\n\r\n    <!-- ======= Intro Single ======= -->\r\n    <section class=\"intro-single\">\r\n      <div class=\"container\">\r\n        <div class=\"row\">\r\n          <div class=\"col-md-12 col-lg-8\">\r\n            <div class=\"title-single-box\">\r\n              <h1 class=\"title-single\">Entrez en contact avec nous maintenant</h1>\r\n              <span class=\"color-text-a\">Aut voluptas consequatur unde sed omnis ex placeat quis eos. Aut natus officia corrupti qui autem fugit consectetur quo. Et ipsum eveniet laboriosam voluptas beatae possimus qui ducimus. Et voluptatem deleniti. Voluptatum voluptatibus amet. Et esse sed omnis inventore hic culpa.</span>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </section><!-- End Intro Single-->\r\n\r\n    <!-- ======= Contact Single ======= -->\r\n    <section class=\"contact\">\r\n      <div class=\"container\">\r\n        <div class=\"row\">\r\n          <div class=\"col-sm-12 section-t8\">\r\n            <div class=\"row\">\r\n              <div class=\"col-md-7\">\r\n    \r\n            <!------------ msg flash --------->\r\n            <?php if(isset($_SESSION[\'flash\'])): ?>\r\n                <?php foreach($_SESSION[\'flash\'] as $type => $message): ?>\r\n                    <div class=\"alert alert-<?= $type; ?>\">\r\n                        <?= $message ?>\r\n                    </div>\r\n                <?php endforeach; ?>\r\n            \r\n                <?php unset($_SESSION[\'flash\']); ?>\r\n            <?php endif; ?>\r\n            <!------------ fin flash --------->\r\n\r\n                <form action=\"\" method=\"post\" role=\"form\" class=\"php-email-form\">\r\n                  <div class=\"row\">\r\n                    <div class=\"col-md-6 mb-3\">\r\n                      <div class=\"form-group\">\r\n                        <input type=\"text\" name=\"name\" class=\"form-control form-control-lg form-control-a\" placeholder=\"Entrer votre prÃ©nom\" required>\r\n                      </div>\r\n                    </div>\r\n                    <div class=\"col-md-6 mb-3\">\r\n                      <div class=\"form-group\">\r\n                        <input type=\"email\" name=\"mail\" class=\"form-control form-control-lg form-control-a\" placeholder=\"Entrer votre adresse email\" required>\r\n                      </div>\r\n                    </div>\r\n                    <div class=\"col-md-12 mb-3\">\r\n                      <div class=\"form-group\">\r\n                        <input type=\"text\" name=\"subject\" class=\"form-control form-control-lg form-control-a\" placeholder=\"Entrer votre l\'objet de votre message ici!\">\r\n                      </div>\r\n                    </div>\r\n                    <div class=\"col-md-12\">\r\n                      <div class=\"form-group\">\r\n                        <textarea type=\"message\" name=\"comment\" class=\"form-control\" cols=\"45\" rows=\"8\" placeholder=\"Ecrivez votre message ici!\" required></textarea>\r\n                      </div>\r\n                    </div>\r\n\r\n                    <div class=\"col-md-12 text-center\">\r\n                      <button type=\"submit\" class=\"btn btn-a\">Envoyer</button>\r\n                    </div>\r\n                  </div>\r\n                </form>\r\n              </div>\r\n              <div class=\"col-md-5 section-md-t3\">\r\n                <div class=\"icon-box section-b2\">\r\n                  <div class=\"icon-box-icon\">\r\n                    <span class=\"bi bi-envelope\"></span>\r\n                  </div>\r\n                  <div class=\"icon-box-content table-cell\">\r\n                    <div class=\"icon-box-title\">\r\n                      <h4 class=\"icon-title\">Contacts</h4>\r\n                    </div>\r\n                    <div class=\"icon-box-content\">\r\n                      <p class=\"mb-1\">Email.\r\n                        <span class=\"color-a\">contact@example.com</span>\r\n                      </p>\r\n                      <p class=\"mb-1\">Appel.\r\n                        <span class=\"color-a\">+54 356 945234</span>\r\n                      </p>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <div class=\"icon-box section-b2\">\r\n                  <div class=\"icon-box-icon\">\r\n                    <span class=\"bi bi-geo-alt\"></span>\r\n                  </div>\r\n                  <div class=\"icon-box-content table-cell\">\r\n                    <div class=\"icon-box-title\">\r\n                      <h4 class=\"icon-title\">Notre emplacement</h4>\r\n                    </div>\r\n                    <div class=\"icon-box-content\">\r\n                      <p class=\"mb-1\">\r\n                        Manhattan, Nueva York 10036,\r\n                        <br> EE. UU.\r\n                      </p>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <div class=\"icon-box\">\r\n                  <div class=\"icon-box-icon\">\r\n                    <span class=\"bi bi-share\"></span>\r\n                  </div>\r\n                  <div class=\"icon-box-content table-cell\">\r\n                    <div class=\"icon-box-title\">\r\n                      <h4 class=\"icon-title\">Nos rÃ©seaux sociaux</h4>\r\n                    </div>\r\n                    <div class=\"icon-box-content\">\r\n                      <div class=\"socials-footer\">\r\n                        <ul class=\"list-inline\">\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-facebook\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-twitter\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-instagram\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-linkedin\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                        </ul>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div class=\"col-sm-12\">\r\n            <div class=\"contact-map box\">\r\n              <div id=\"map\" class=\"contact-map\">\r\n                <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </section><!-- End Contact Single-->\r\n\r\n  </main><!-- End #main -->\r\n\r\n<?php\r\n    require \'inc/footer.php\';\r\n?>\r\n\r\n  <div id=\"preloader\"></div>\r\n  <a href=\"#\" class=\"back-to-top d-flex align-items-center justify-content-center\"><i class=\"bi bi-arrow-up-short\"></i></a>\r\n\r\n  <!-- Vendor JS Files -->\r\n  <script src=\"assets/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>\r\n  <script src=\"assets/vendor/swiper/swiper-bundle.min.js\"></script>\r\n\r\n  <!-- Template Main JS File -->\r\n  <script src=\"assets/js/main.js\"></script>\r\n\r\n</body>\r\n\r\n</html>'),
(11, 'islam islam', 'abibouislam@yahoo.fr', 'DolÃ©ance', 'jbhjju'),
(13, 'islam islam', 'abibouislam@yahoo.fr', 'salako', '<?php\r\nsession_start();\r\n  if(!empty($_POST)){\r\n\r\n        $pdo = new PDO (\'mysql:host=localhost;dbname=dashbord\', \'root\', \'\');\r\n        $req = $pdo->prepare(\"INSERT INTO rapidappart SET nom=?, email=?, objet=?, message = ?\");\r\n        $req ->execute([$_POST[\'name\'], $_POST [\'mail\'], $_POST [\'subject\'], $_POST [\'comment\']]);\r\n\r\n        // if(isset($_POST[\'mail\'])){\r\n        //     $entete  = \'MIME-Version: 1.0\' . \"\\r\\n\";\r\n        //     $entete .= \'Content-type: text/html; charset=utf-8\' . \"\\r\\n\";\r\n        //     $entete .= \'From: \' . $_POST[\'mail\'] . \"\\r\\n\";\r\n    \r\n        //     $message = \'<h1>Demande de crÃ©dit</h1>\r\n        //     <p><b>Nom : </b>\' . $_POST[\'name\'] . \'<br>\r\n        //     <b>Email : </b>\' . $_POST[\'mail\'] . \'<br>\r\n        //     <b>Montant : </b>\' . $_POST[\'subject\'] . \'<br>\r\n        //     <b>Message : </b>\' . $_POST[\'comment\'] .\'</p>\';\r\n    \r\n        //     $retour = mail(\'contact@gmail.com\', \'Demande de crÃ©dit\', $message, $entete);\r\n        // }\r\n        $_SESSION[\'flash\'][\'success\'] = \"Message reÃ§u avec succes. Nous prennons en compte votre requÃªte et nous promettons de revenir vers vous trÃ¨s prochainement!\";\r\n        header(\'Location: contact.php\');\r\n      exit();\r\n    }\r\n\r\n      $title = \'RapidAppart | contact\';\r\n      require \'inc/header.php\';\r\n  ?>\r\n\r\n  <main id=\"main\">\r\n\r\n    <!-- ======= Intro Single ======= -->\r\n    <section class=\"intro-single\">\r\n      <div class=\"container\">\r\n        <div class=\"row\">\r\n          <div class=\"col-md-12 col-lg-8\">\r\n            <div class=\"title-single-box\">\r\n              <h1 class=\"title-single\">Entrez en contact avec nous maintenant</h1>\r\n              <span class=\"color-text-a\">Aut voluptas consequatur unde sed omnis ex placeat quis eos. Aut natus officia corrupti qui autem fugit consectetur quo. Et ipsum eveniet laboriosam voluptas beatae possimus qui ducimus. Et voluptatem deleniti. Voluptatum voluptatibus amet. Et esse sed omnis inventore hic culpa.</span>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </section><!-- End Intro Single-->\r\n\r\n    <!-- ======= Contact Single ======= -->\r\n    <section class=\"contact\">\r\n      <div class=\"container\">\r\n        <div class=\"row\">\r\n          <div class=\"col-sm-12 section-t8\">\r\n            <div class=\"row\">\r\n              <div class=\"col-md-7\">\r\n    \r\n            <!------------ msg flash --------->\r\n            <?php if(isset($_SESSION[\'flash\'])): ?>\r\n                <?php foreach($_SESSION[\'flash\'] as $type => $message): ?>\r\n                    <div class=\"alert alert-<?= $type; ?>\">\r\n                        <?= $message ?>\r\n                    </div>\r\n                <?php endforeach; ?>\r\n            \r\n                <?php unset($_SESSION[\'flash\']); ?>\r\n            <?php endif; ?>\r\n            <!------------ fin flash --------->\r\n\r\n                <form action=\"\" method=\"post\" role=\"form\" class=\"php-email-form\">\r\n                  <div class=\"row\">\r\n                    <div class=\"col-md-6 mb-3\">\r\n                      <div class=\"form-group\">\r\n                        <input type=\"text\" name=\"name\" class=\"form-control form-control-lg form-control-a\" placeholder=\"Entrer votre prÃ©nom\" required>\r\n                      </div>\r\n                    </div>\r\n                    <div class=\"col-md-6 mb-3\">\r\n                      <div class=\"form-group\">\r\n                        <input type=\"email\" name=\"mail\" class=\"form-control form-control-lg form-control-a\" placeholder=\"Entrer votre adresse email\" required>\r\n                      </div>\r\n                    </div>\r\n                    <div class=\"col-md-12 mb-3\">\r\n                      <div class=\"form-group\">\r\n                        <input type=\"text\" name=\"subject\" class=\"form-control form-control-lg form-control-a\" placeholder=\"Entrer votre l\'objet de votre message ici!\">\r\n                      </div>\r\n                    </div>\r\n                    <div class=\"col-md-12\">\r\n                      <div class=\"form-group\">\r\n                        <textarea type=\"message\" name=\"comment\" class=\"form-control\" cols=\"45\" rows=\"8\" placeholder=\"Ecrivez votre message ici!\" required></textarea>\r\n                      </div>\r\n                    </div>\r\n\r\n                    <div class=\"col-md-12 text-center\">\r\n                      <button type=\"submit\" class=\"btn btn-a\">Envoyer</button>\r\n                    </div>\r\n                  </div>\r\n                </form>\r\n              </div>\r\n              <div class=\"col-md-5 section-md-t3\">\r\n                <div class=\"icon-box section-b2\">\r\n                  <div class=\"icon-box-icon\">\r\n                    <span class=\"bi bi-envelope\"></span>\r\n                  </div>\r\n                  <div class=\"icon-box-content table-cell\">\r\n                    <div class=\"icon-box-title\">\r\n                      <h4 class=\"icon-title\">Contacts</h4>\r\n                    </div>\r\n                    <div class=\"icon-box-content\">\r\n                      <p class=\"mb-1\">Email.\r\n                        <span class=\"color-a\">contact@example.com</span>\r\n                      </p>\r\n                      <p class=\"mb-1\">Appel.\r\n                        <span class=\"color-a\">+54 356 945234</span>\r\n                      </p>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <div class=\"icon-box section-b2\">\r\n                  <div class=\"icon-box-icon\">\r\n                    <span class=\"bi bi-geo-alt\"></span>\r\n                  </div>\r\n                  <div class=\"icon-box-content table-cell\">\r\n                    <div class=\"icon-box-title\">\r\n                      <h4 class=\"icon-title\">Notre emplacement</h4>\r\n                    </div>\r\n                    <div class=\"icon-box-content\">\r\n                      <p class=\"mb-1\">\r\n                        Manhattan, Nueva York 10036,\r\n                        <br> EE. UU.\r\n                      </p>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <div class=\"icon-box\">\r\n                  <div class=\"icon-box-icon\">\r\n                    <span class=\"bi bi-share\"></span>\r\n                  </div>\r\n                  <div class=\"icon-box-content table-cell\">\r\n                    <div class=\"icon-box-title\">\r\n                      <h4 class=\"icon-title\">Nos rÃ©seaux sociaux</h4>\r\n                    </div>\r\n                    <div class=\"icon-box-content\">\r\n                      <div class=\"socials-footer\">\r\n                        <ul class=\"list-inline\">\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-facebook\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-twitter\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-instagram\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-linkedin\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                        </ul>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div class=\"col-sm-12\">\r\n            <div class=\"contact-map box\">\r\n              <div id=\"map\" class=\"contact-map\">\r\n                <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </section><!-- End Contact Single-->\r\n\r\n  </main><!-- End #main -->\r\n\r\n<?php\r\n    require \'inc/footer.php\';\r\n?>\r\n\r\n  <div id=\"preloader\"></div>\r\n  <a href=\"#\" class=\"back-to-top d-flex align-items-center justify-content-center\"><i class=\"bi bi-arrow-up-short\"></i></a>\r\n\r\n  <!-- Vendor JS Files -->\r\n  <script src=\"assets/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>\r\n  <script src=\"assets/vendor/swiper/swiper-bundle.min.js\"></script>\r\n\r\n  <!-- Template Main JS File -->\r\n  <script src=\"assets/js/main.js\"></script>\r\n\r\n</body>\r\n\r\n</html>'),
(14, 'islam islam', 'abibouislam@yahoo.fr', 'salako2', '<?php\r\nsession_start();\r\n  if(!empty($_POST)){\r\n\r\n        $pdo = new PDO (\'mysql:host=localhost;dbname=dashbord\', \'root\', \'\');\r\n        $req = $pdo->prepare(\"INSERT INTO rapidappart SET nom=?, email=?, objet=?, message = ?\");\r\n        $req ->execute([$_POST[\'name\'], $_POST [\'mail\'], $_POST [\'subject\'], $_POST [\'comment\']]);\r\n\r\n        // if(isset($_POST[\'mail\'])){\r\n        //     $entete  = \'MIME-Version: 1.0\' . \"\\r\\n\";\r\n        //     $entete .= \'Content-type: text/html; charset=utf-8\' . \"\\r\\n\";\r\n        //     $entete .= \'From: \' . $_POST[\'mail\'] . \"\\r\\n\";\r\n    \r\n        //     $message = \'<h1>Demande de crÃ©dit</h1>\r\n        //     <p><b>Nom : </b>\' . $_POST[\'name\'] . \'<br>\r\n        //     <b>Email : </b>\' . $_POST[\'mail\'] . \'<br>\r\n        //     <b>Montant : </b>\' . $_POST[\'subject\'] . \'<br>\r\n        //     <b>Message : </b>\' . $_POST[\'comment\'] .\'</p>\';\r\n    \r\n        //     $retour = mail(\'contact@gmail.com\', \'Demande de crÃ©dit\', $message, $entete);\r\n        // }\r\n        $_SESSION[\'flash\'][\'success\'] = \"Message reÃ§u avec succes. Nous prennons en compte votre requÃªte et nous promettons de revenir vers vous trÃ¨s prochainement!\";\r\n        header(\'Location: contact.php\');\r\n      exit();\r\n    }\r\n\r\n      $title = \'RapidAppart | contact\';\r\n      require \'inc/header.php\';\r\n  ?>\r\n\r\n  <main id=\"main\">\r\n\r\n    <!-- ======= Intro Single ======= -->\r\n    <section class=\"intro-single\">\r\n      <div class=\"container\">\r\n        <div class=\"row\">\r\n          <div class=\"col-md-12 col-lg-8\">\r\n            <div class=\"title-single-box\">\r\n              <h1 class=\"title-single\">Entrez en contact avec nous maintenant</h1>\r\n              <span class=\"color-text-a\">Aut voluptas consequatur unde sed omnis ex placeat quis eos. Aut natus officia corrupti qui autem fugit consectetur quo. Et ipsum eveniet laboriosam voluptas beatae possimus qui ducimus. Et voluptatem deleniti. Voluptatum voluptatibus amet. Et esse sed omnis inventore hic culpa.</span>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </section><!-- End Intro Single-->\r\n\r\n    <!-- ======= Contact Single ======= -->\r\n    <section class=\"contact\">\r\n      <div class=\"container\">\r\n        <div class=\"row\">\r\n          <div class=\"col-sm-12 section-t8\">\r\n            <div class=\"row\">\r\n              <div class=\"col-md-7\">\r\n    \r\n            <!------------ msg flash --------->\r\n            <?php if(isset($_SESSION[\'flash\'])): ?>\r\n                <?php foreach($_SESSION[\'flash\'] as $type => $message): ?>\r\n                    <div class=\"alert alert-<?= $type; ?>\">\r\n                        <?= $message ?>\r\n                    </div>\r\n                <?php endforeach; ?>\r\n            \r\n                <?php unset($_SESSION[\'flash\']); ?>\r\n            <?php endif; ?>\r\n            <!------------ fin flash --------->\r\n\r\n                <form action=\"\" method=\"post\" role=\"form\" class=\"php-email-form\">\r\n                  <div class=\"row\">\r\n                    <div class=\"col-md-6 mb-3\">\r\n                      <div class=\"form-group\">\r\n                        <input type=\"text\" name=\"name\" class=\"form-control form-control-lg form-control-a\" placeholder=\"Entrer votre prÃ©nom\" required>\r\n                      </div>\r\n                    </div>\r\n                    <div class=\"col-md-6 mb-3\">\r\n                      <div class=\"form-group\">\r\n                        <input type=\"email\" name=\"mail\" class=\"form-control form-control-lg form-control-a\" placeholder=\"Entrer votre adresse email\" required>\r\n                      </div>\r\n                    </div>\r\n                    <div class=\"col-md-12 mb-3\">\r\n                      <div class=\"form-group\">\r\n                        <input type=\"text\" name=\"subject\" class=\"form-control form-control-lg form-control-a\" placeholder=\"Entrer votre l\'objet de votre message ici!\">\r\n                      </div>\r\n                    </div>\r\n                    <div class=\"col-md-12\">\r\n                      <div class=\"form-group\">\r\n                        <textarea type=\"message\" name=\"comment\" class=\"form-control\" cols=\"45\" rows=\"8\" placeholder=\"Ecrivez votre message ici!\" required></textarea>\r\n                      </div>\r\n                    </div>\r\n\r\n                    <div class=\"col-md-12 text-center\">\r\n                      <button type=\"submit\" class=\"btn btn-a\">Envoyer</button>\r\n                    </div>\r\n                  </div>\r\n                </form>\r\n              </div>\r\n              <div class=\"col-md-5 section-md-t3\">\r\n                <div class=\"icon-box section-b2\">\r\n                  <div class=\"icon-box-icon\">\r\n                    <span class=\"bi bi-envelope\"></span>\r\n                  </div>\r\n                  <div class=\"icon-box-content table-cell\">\r\n                    <div class=\"icon-box-title\">\r\n                      <h4 class=\"icon-title\">Contacts</h4>\r\n                    </div>\r\n                    <div class=\"icon-box-content\">\r\n                      <p class=\"mb-1\">Email.\r\n                        <span class=\"color-a\">contact@example.com</span>\r\n                      </p>\r\n                      <p class=\"mb-1\">Appel.\r\n                        <span class=\"color-a\">+54 356 945234</span>\r\n                      </p>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <div class=\"icon-box section-b2\">\r\n                  <div class=\"icon-box-icon\">\r\n                    <span class=\"bi bi-geo-alt\"></span>\r\n                  </div>\r\n                  <div class=\"icon-box-content table-cell\">\r\n                    <div class=\"icon-box-title\">\r\n                      <h4 class=\"icon-title\">Notre emplacement</h4>\r\n                    </div>\r\n                    <div class=\"icon-box-content\">\r\n                      <p class=\"mb-1\">\r\n                        Manhattan, Nueva York 10036,\r\n                        <br> EE. UU.\r\n                      </p>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <div class=\"icon-box\">\r\n                  <div class=\"icon-box-icon\">\r\n                    <span class=\"bi bi-share\"></span>\r\n                  </div>\r\n                  <div class=\"icon-box-content table-cell\">\r\n                    <div class=\"icon-box-title\">\r\n                      <h4 class=\"icon-title\">Nos rÃ©seaux sociaux</h4>\r\n                    </div>\r\n                    <div class=\"icon-box-content\">\r\n                      <div class=\"socials-footer\">\r\n                        <ul class=\"list-inline\">\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-facebook\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-twitter\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-instagram\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                          <li class=\"list-inline-item\">\r\n                            <a href=\"#\" class=\"link-one\">\r\n                              <i class=\"bi bi-linkedin\" aria-hidden=\"true\"></i>\r\n                            </a>\r\n                          </li>\r\n                        </ul>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div class=\"col-sm-12\">\r\n            <div class=\"contact-map box\">\r\n              <div id=\"map\" class=\"contact-map\">\r\n                <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </section><!-- End Contact Single-->\r\n\r\n  </main><!-- End #main -->\r\n\r\n<?php\r\n    require \'inc/footer.php\';\r\n?>\r\n\r\n  <div id=\"preloader\"></div>\r\n  <a href=\"#\" class=\"back-to-top d-flex align-items-center justify-content-center\"><i class=\"bi bi-arrow-up-short\"></i></a>\r\n\r\n  <!-- Vendor JS Files -->\r\n  <script src=\"assets/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>\r\n  <script src=\"assets/vendor/swiper/swiper-bundle.min.js\"></script>\r\n\r\n  <!-- Template Main JS File -->\r\n  <script src=\"assets/js/main.js\"></script>\r\n\r\n</body>\r\n\r\n</html>');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `caution` varchar(255) NOT NULL,
  `emplacement` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `utilisateur` varchar(255) DEFAULT NULL,
  `resoud` text,
  `id_user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `nom`, `prix`, `caution`, `emplacement`, `message`, `utilisateur`, `resoud`, `id_user`) VALUES
(14, 'Appartement 1', '260.000 Fcfa', '1.000.000', 'SÃ©nÃ©gal/ Dakar', '<p>1000 m&sup2;</p>\r\n', 'super', '<i class=\'fas fa-check text-success\'></i>', '3');

-- --------------------------------------------------------

--
-- Structure de la table `souhait`
--

DROP TABLE IF EXISTS `souhait`;
CREATE TABLE IF NOT EXISTS `souhait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prix` varchar(200) NOT NULL,
  `caution` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `passe` varchar(60) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `email`, `passe`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`) VALUES
(3, 'abibouislam@yahoo.fr', '$2y$10$jEDgVPYRudUbxsN1qE67..V0SRmyvTr6uvMVMvu/AYwoNkVLb7Vpy', NULL, '2021-07-08 11:19:27', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
