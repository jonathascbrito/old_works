SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

insert into tickets_types(`name`, `description`) values ('Serviços básicos de cabeamento', '');
insert into tickets_types(`name`, `description`) values ('Habilitação/desabilitação de ponto de rede', '');
insert into tickets_types(`name`, `description`) values ('Instalação remota de software', '');
insert into tickets_types(`name`, `description`) values ('Instalação no local de software', '');
insert into tickets_types(`name`, `description`) values ('Formatação, baixa de imagem', '');
insert into tickets_types(`name`, `description`) values ('Instalação física de equipamento', '');
insert into tickets_types(`name`, `description`) values ('Intervenção em hardware para substituição, acréscimo ou retirada de periféricos', '');
insert into tickets_types(`name`, `description`) values ('Atualização e varredura sob demanda em caso de infecção - antivirus', '');
insert into tickets_types(`name`, `description`) values ('Recuperação lógica de dados excluídos acidentalmente pelo usuário', '');
insert into tickets_types(`name`, `description`) values ('Recuperação de e-mails', '');
insert into tickets_types(`name`, `description`) values ('Fornecimento e fixação de etiqueta e atualização da base de dados', '');
insert into tickets_types(`name`, `description`) values ('Vistoria técnica', '');
insert into tickets_types(`name`, `description`) values ('Visita técnica para diagnostico de problemas', '');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;