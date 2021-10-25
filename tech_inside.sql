CREATE TABLE `address` (
  `fk_id_user` int(11) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `compl` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(10) NOT NULL
);

INSERT INTO `address` (`fk_id_user`, `zipcode`, `address`, `number`, `compl`, `city`, `state`) VALUES
(10, '01156050', 'Avenida Doutor Adolpho Pinto', '556', 'Memorial', 'São Paulo', 'SP'),
(11, '01525000', 'Rua Tamandaré', '556', 'Vergueiro', 'São Paulo', 'SP');



CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fb_token` longtext DEFAULT NULL,
  `fb_picture` longtext DEFAULT NULL,
  `timestamp_create` timestamp NOT NULL DEFAULT current_timestamp(),
  `timestamp_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);


INSERT INTO `admin` (`id_admin`, `name`, `email`, `cpf`, `phone`, `fb_token`, `fb_picture`, `timestamp_create`, `timestamp_update`) VALUES
(1, 'Thomas Vinicius de Moraes', 'tho.vini7@gmail.com', '98621618095', '11972173967', NULL, NULL, '2021-10-16 14:11:54', '2021-10-16 14:11:54'),
(7, 'Thomas Moraes', 'tho.vini7@hotmail.com', NULL, NULL, 'EAAGDmViZCGsEBAHZALZAPC9QuNKc4xAScUwZBNtmZCrQfDc7ZCNcYdRN9H7MVEuPvkRY0OcrCEuZADZBfDXtxnaMRvCZBQVsPZCh9aQVEaoLQRVYlA0jWFPP14BorKTkAGbfiG8qlb4oml5T11Y930sZBFDnMIZATMt8dZB7yK11MZBhW5jQjSbgWHZAS3jjiJMZCkk3GDCS093wk8wYYfCtMrBgL3b1', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=4444826442265282&height=50&width=50&ext=1637549885&hash=AeTStd_8d2uucN7Q678', '2021-10-23 02:20:40', '2021-10-23 02:58:33'),
(8, 'Caique Vinicius ', 'cah@gmail.com', '61286984092', '11983734747', NULL, NULL, '2021-10-24 22:13:55', '2021-10-24 22:13:55');


CREATE TABLE `auth` (
  `fk_id_admin` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
);


INSERT INTO `auth` (`fk_id_admin`, `password`) VALUES
(1, '$2y$10$4ieprfcoSEuhgUZ.s9iOIeDDvDDi0BKZmMwXpmLD9Sdj7Ghn5xrlm'),
(8, '$2y$10$BN35Lo0O/sIuhe6UakJhgOZRShu3TqnVQRHL2yFB8VGYQAs5L9rr.');


CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `fk_id_admin` int(11) NOT NULL,
  `message_log` varchar(255) NOT NULL,
  `type_log` varchar(255) NOT NULL,
  `fk_id_user` int(11) DEFAULT NULL,
  `timestamp_create_log` timestamp NOT NULL DEFAULT current_timestamp()
);


CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fk_admin_id` int(11) NOT NULL,
  `timestamp_create` timestamp NOT NULL DEFAULT current_timestamp(),
  `timestamp_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) 

INSERT INTO `user` (`id_user`, `name`, `email`, `cpf`, `phone`, `fk_admin_id`, `timestamp_create`, `timestamp_update`) VALUES
(10, 'Érica Oliveira Lopes da Silva', 'ericalopes@gmail.uni9.prof.com', '98621618095', '11953454353', 1, '2021-10-17 22:27:43', '2021-10-17 22:27:43'),
(11, 'João Vagner Pereira da Silva', 'joaovagner@gmail.uni9.prof.com', '52648753087', '11942220009', 1, '2021-10-17 22:28:58', '2021-10-19 01:07:14');


ALTER TABLE `address`
  ADD KEY `fk_id_user` (`fk_id_user`);


ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);


ALTER TABLE `auth`
  ADD KEY `fk_id_admin` (`fk_id_admin`);


ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `fk_id_admin_log` (`fk_id_admin`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_admin_id` (`fk_admin_id`);

ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;


ALTER TABLE `address`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`fk_id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `auth`
  ADD CONSTRAINT `fk_id_admin` FOREIGN KEY (`fk_id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `log`
  ADD CONSTRAINT `fk_id_admin_log` FOREIGN KEY (`fk_id_admin`) REFERENCES `admin` (`id_admin`);


ALTER TABLE `user`
  ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`fk_admin_id`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
