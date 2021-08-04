-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 03-Ago-2021 às 22:57
-- Versão do servidor: 5.7.35-0ubuntu0.18.04.1
-- versão do PHP: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_smart_suport`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_alterar_imagem_perfil` (IN `pid_usuario` INT(11), IN `pfoto` VARCHAR(64))  BEGIN
 
    UPDATE tb_usuarios
    SET
        foto = pfoto
      
	WHERE id_usuario = pid_usuario;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_usuario` (IN `pnome` VARCHAR(64), IN `plogin` VARCHAR(64), IN `psenha` VARCHAR(256), IN `pemail` VARCHAR(128), IN `pinadmin` TINYINT(4), IN `ploja` VARCHAR(64), IN `pcargo` VARCHAR(64), IN `pfoto` INT(64))  BEGIN
   
    INSERT INTO tb_usuarios (nome,login,senha,email,inadmin,loja,cargo,foto)
    
    VALUES(pnome,plogin,psenha,pemail,pinadmin,ploja,pcargo,pfoto);
    
    
  SELECT * FROM tb_usuarios  WHERE id_usuario = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editar_situacao` (IN `pid_chamado` INT(11), IN `psituacao` VARCHAR(20))  BEGIN
 
    UPDATE tb_chamados
    SET
        situacao = psituacao
          
        WHERE id_chamado = pid_chamado;
        
      SELECT * FROM tb_chamados WHERE id_chamado = pid_chamado;  
        
          
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editar_usuario` (IN `pid_usuario` INT(11), IN `pnome` VARCHAR(64), IN `psenha` VARCHAR(256), IN `ploja` VARCHAR(64), IN `pinadmin` TINYINT(4), IN `pcargo` VARCHAR(64))  BEGIN
 
    UPDATE tb_usuarios
    SET
        nome = pnome,
        senha = psenha,
        loja = ploja,
        inadmin = pinadmin,
        cargo = pcargo
        
        WHERE id_usuario = pid_usuario;
        
        
          SELECT * FROM tb_usuarios WHERE id_usuario = pid_usuario;
        
      
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_foto_chamado_add` (IN `pid_chamado` INT(11), IN `pid_usuario` INT(11), IN `pnome_foto` VARCHAR(64))  NO SQL
BEGIN

INSERT INTO tb_chamados_fotos (id_chamado,id_usuario,nome_foto)
    VALUES(pid_chamado,pid_usuario,pnome_foto);
   

 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_chamado` (IN `pid_usuario` INT(11), IN `pproblema` VARCHAR(128), IN `pobservacao` TEXT, IN `psituacao` VARCHAR(20))  NO SQL
BEGIN
   
    INSERT INTO tb_chamados
    (id_usuario,problema,observacao,situacao)
    
    VALUES(pid_usuario,pproblema,pobservacao,psituacao);
    
    
  SELECT * FROM tb_chamados  WHERE id_chamado = LAST_INSERT_ID();
    
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_chamados`
--

CREATE TABLE `tb_chamados` (
  `id_chamado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `problema` varchar(128) NOT NULL,
  `observacao` text,
  `situacao` varchar(20) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_chamados_fotos`
--

CREATE TABLE `tb_chamados_fotos` (
  `id_foto` int(11) NOT NULL,
  `id_chamado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome_foto` varchar(64) DEFAULT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` varchar(64) NOT NULL,
  `login` varchar(64) NOT NULL,
  `senha` varchar(256) NOT NULL,
  `inadmin` tinyint(4) NOT NULL,
  `cargo` varchar(64) NOT NULL,
  `loja` varchar(64) NOT NULL,
  `foto` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `email`, `data_registro`, `nome`, `login`, `senha`, `inadmin`, `cargo`, `loja`, `foto`) VALUES
(41, 'adjair.bezerra@gmail.com', '2021-08-04 01:29:00', 'Adjair Nascimento', 'adjair', '$2y$12$BVwXSgeihDzuxsMZjombue.z.MwQ/H.MwtDspuLX2k72yfAoiRrhy', 0, 'Contabilidade', 'Loja/Empresa 1', '0'),
(42, 'henriquehfa@gmail.com', '2021-08-04 01:30:04', 'Henrique França', 'henrique.frança', '$2y$12$Qh/YZiqCRCvdUjauaN3N5O3qNwja4c6cNQF8hLxAkztNAE5QbhkZa', 0, 'Marketing', 'Loja/Empresa 3', '0'),
(43, 'admin@gmail.com', '2021-08-04 01:33:56', 'Administrador', 'admin', '$2y$12$qaBJj3c6pXYv3Ndu5ODqI.NF9TgLDc5qfAsRFuZld37TGWVdrEuZu', 1, 'Suporte Técnico', 'Loja/Empresa 1', '20210803100816'),
(44, 'rafaxvi@hotmail.com', '2021-08-04 01:34:55', 'Rafael Oliveira', 'rafael.oliveira', '$2y$12$l.5PpaJp4nbC3u84.MGpnOHwh34ZSJGne9nIF0Fr2wCKB09a.e7Ri', 0, 'Financeiro', 'Loja/Empresa 3', '20210803100829');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_chamados`
--
ALTER TABLE `tb_chamados`
  ADD PRIMARY KEY (`id_chamado`),
  ADD KEY `fk_calls_users` (`id_usuario`);

--
-- Índices para tabela `tb_chamados_fotos`
--
ALTER TABLE `tb_chamados_fotos`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `fk_callphotos_calls` (`id_chamado`),
  ADD KEY `fk_callphotos_users` (`id_usuario`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `iduser` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_chamados`
--
ALTER TABLE `tb_chamados`
  MODIFY `id_chamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_chamados_fotos`
--
ALTER TABLE `tb_chamados_fotos`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_chamados`
--
ALTER TABLE `tb_chamados`
  ADD CONSTRAINT `fk_chamados_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_chamados_fotos`
--
ALTER TABLE `tb_chamados_fotos`
  ADD CONSTRAINT `fk_chamados_fotos_chamados` FOREIGN KEY (`id_chamado`) REFERENCES `tb_chamados` (`id_chamado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_chamados_fotos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
