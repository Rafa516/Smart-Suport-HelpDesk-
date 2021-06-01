-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 01/06/2021 às 16:37
-- Versão do servidor: 5.7.34-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.24-0ubuntu0.18.04.7

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editar_usuario` (IN `pid_usuario` INT(11), IN `pnome` VARCHAR(64), IN `ploja` VARCHAR(64), IN `pinadmin` TINYINT(4), IN `pcargo` VARCHAR(64))  BEGIN
 
    UPDATE tb_usuarios
    SET
        nome = pnome,
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
-- Estrutura para tabela `tb_chamados`
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
-- Estrutura para tabela `tb_chamados_fotos`
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
-- Estrutura para tabela `tb_usuarios`
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
-- Despejando dados para a tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `email`, `data_registro`, `nome`, `login`, `senha`, `inadmin`, `cargo`, `loja`, `foto`) VALUES
(28, 'rafaxvi@hotmail.com', '2021-01-12 21:36:59', 'Admin', 'suporte', '$2y$12$hKaYkmysAUxuw4gYLdTL3eyB7eVzwt4.mK4gGCQUYMD0X/YNzINrG', 1, 'Suporte Técnico', 'Loja/Empresa 2', '0'),
(40, 'roliveirarso516@gmail.com', '2021-05-26 01:30:54', 'Rafael Oliveira', 'rafael.oliveira', '$2y$12$/sUx05g9lx4Jz0VhptkYcuE.s9TwrV0Cbmie3YGrs8B2cVQ/9Lkj2', 0, 'Gerente', 'Loja/Empresa 2', '20210601040626');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_chamados`
--
ALTER TABLE `tb_chamados`
  ADD PRIMARY KEY (`id_chamado`),
  ADD KEY `fk_calls_users` (`id_usuario`);

--
-- Índices de tabela `tb_chamados_fotos`
--
ALTER TABLE `tb_chamados_fotos`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `fk_callphotos_calls` (`id_chamado`),
  ADD KEY `fk_callphotos_users` (`id_usuario`);

--
-- Índices de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `iduser` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_chamados`
--
ALTER TABLE `tb_chamados`
  MODIFY `id_chamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_chamados_fotos`
--
ALTER TABLE `tb_chamados_fotos`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_chamados`
--
ALTER TABLE `tb_chamados`
  ADD CONSTRAINT `fk_chamados_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_chamados_fotos`
--
ALTER TABLE `tb_chamados_fotos`
  ADD CONSTRAINT `fk_chamados_fotos_chamados` FOREIGN KEY (`id_chamado`) REFERENCES `tb_chamados` (`id_chamado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_chamados_fotos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
