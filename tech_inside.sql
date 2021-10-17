
--
-- Banco de dados: `tech_inside`
--

CREATE DATABASE `tech_inside`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `address`
--

CREATE TABLE `address` (
  `fk_id_user` int(11) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `compl` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(10) NOT NULL
) 

--
-- Despejando dados para a tabela `address`
--

INSERT INTO `address` (`fk_id_user`, `zipcode`, `address`, `number`, `compl`, `city`, `state`) VALUES
(6, '06695410', 'Rua Santa Tereza', '216', 'Tem boi na frente', 'Itapevi', 'SP');

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `timestamp_create` timestamp NOT NULL DEFAULT current_timestamp(),
  `timestamp_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) 

--
-- Despejando dados para a tabela `admin`
--

INSERT INTO `admin` (`id_admin`, `name`, `email`, `cpf`, `phone`, `timestamp_create`, `timestamp_update`) VALUES
(1, 'Thomas Vinicius de Moraes', 'tho.vini7@gmail.com', '47423647837', '11972173967', '2021-10-16 14:11:54', '2021-10-16 14:11:54');

-- --------------------------------------------------------

--
-- Estrutura para tabela `auth`
--

CREATE TABLE `auth` (
  `fk_id_admin` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `auth`
--

INSERT INTO `auth` (`fk_id_admin`, `password`) VALUES
(1, '$2y$10$4ieprfcoSEuhgUZ.s9iOIeDDvDDi0BKZmMwXpmLD9Sdj7Ghn5xrlm');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `timestamp_create` timestamp NOT NULL DEFAULT current_timestamp(),
  `timestamp_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) 

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `cpf`, `phone`, `timestamp_create`, `timestamp_update`) VALUES
(6, 'Joice Silva Mota', 'joimota5@gmail.com', '48591553861', '11966396882', '2021-10-16 20:50:43', '2021-10-16 20:50:43');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `address`
--
ALTER TABLE `address`
  ADD KEY `fk_id_user` (`fk_id_user`);

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices de tabela `auth`
--
ALTER TABLE `auth`
  ADD KEY `fk_id_admin` (`fk_id_admin`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`fk_id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `fk_id_admin` FOREIGN KEY (`fk_id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
