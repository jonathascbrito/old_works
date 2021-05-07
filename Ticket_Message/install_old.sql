SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `attachments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `attachments` ;

CREATE  TABLE IF NOT EXISTS `attachments` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(500) NOT NULL ,
  `path` VARCHAR(500) NOT NULL ,
  `mime` VARCHAR(100) NOT NULL ,
  `size` INT(11) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(256) NOT NULL ,
  `email` VARCHAR(256) NOT NULL ,
  `username` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(50) NOT NULL ,
  `active` TINYINT(1) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username` (`username` ASC) ,
  UNIQUE INDEX `email` (`email` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `chats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chats` ;

CREATE  TABLE IF NOT EXISTS `chats` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `to` INT(11) NOT NULL ,
  `from` INT(11) NOT NULL ,
  `content` VARCHAR(2000) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `chats_from_idx` (`from` ASC) ,
  INDEX `chats_to_idx` (`to` ASC) ,
  CONSTRAINT `chats_from`
    FOREIGN KEY (`from` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `chats_to`
    FOREIGN KEY (`to` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `messages` ;

CREATE  TABLE IF NOT EXISTS `messages` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `message_id` BIGINT(20) NULL DEFAULT NULL ,
  `to` INT(11) NOT NULL ,
  `from` INT(11) NOT NULL ,
  `subject` VARCHAR(100) NULL DEFAULT NULL ,
  `content` VARCHAR(2000) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `messages_messages_idx` (`message_id` ASC) ,
  INDEX `messages_to_idx` (`to` ASC) ,
  INDEX `messages_from_idx` (`from` ASC) ,
  CONSTRAINT `messages_from`
    FOREIGN KEY (`from` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `messages_messages`
    FOREIGN KEY (`message_id` )
    REFERENCES `messages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `messages_to`
    FOREIGN KEY (`to` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `messages_attachments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `messages_attachments` ;

CREATE  TABLE IF NOT EXISTS `messages_attachments` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `message_id` BIGINT(20) NOT NULL ,
  `attachment_id` BIGINT(20) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `messages_attachments_messages_idx` (`message_id` ASC) ,
  INDEX `messages_attachments_attachments_idx` (`attachment_id` ASC) ,
  CONSTRAINT `messages_attachments_attachments`
    FOREIGN KEY (`attachment_id` )
    REFERENCES `attachments` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `messages_attachments_messages`
    FOREIGN KEY (`message_id` )
    REFERENCES `messages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `permissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `permissions` ;

CREATE  TABLE IF NOT EXISTS `permissions` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT ,
  `action` VARCHAR(50) NOT NULL ,
  `group` VARCHAR(50) NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  `description` VARCHAR(500) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_id_UNIQUE` (`action` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `protocols`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `protocols` ;

CREATE  TABLE IF NOT EXISTS `protocols` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `code_number` VARCHAR(15) NOT NULL ,
  `code_year` VARCHAR(5) NOT NULL ,
  `type` VARCHAR(10) NOT NULL ,
  `priority` CHAR(1) NOT NULL ,
  `status` VARCHAR(20) NOT NULL ,
  `from` INT(11) NULL DEFAULT NULL ,
  `to` INT(11) NULL DEFAULT NULL ,
  `logistic` INT(11) NULL DEFAULT NULL ,
  `description` VARCHAR(2000) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `protocols_from_idx` (`from` ASC) ,
  INDEX `protocols_to_idx` (`to` ASC) ,
  INDEX `protocols_logistics_idx` (`logistic` ASC) ,
  CONSTRAINT `protocols_from`
    FOREIGN KEY (`from` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `protocols_logistic`
    FOREIGN KEY (`logistic` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `protocols_to`
    FOREIGN KEY (`to` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `protocols_attachments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `protocols_attachments` ;

CREATE  TABLE IF NOT EXISTS `protocols_attachments` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `protocol_id` BIGINT(20) NOT NULL ,
  `attachment_id` BIGINT(20) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `protocols_attachments_protocols_idx` (`protocol_id` ASC) ,
  INDEX `protocols_attachments_attachments_idx` (`attachment_id` ASC) ,
  CONSTRAINT `protocols_attachments_attachments`
    FOREIGN KEY (`attachment_id` )
    REFERENCES `attachments` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `protocols_attachments_protocols`
    FOREIGN KEY (`protocol_id` )
    REFERENCES `protocols` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles` ;

CREATE  TABLE IF NOT EXISTS `roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `description` VARCHAR(500) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roles_permissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles_permissions` ;

CREATE  TABLE IF NOT EXISTS `roles_permissions` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `role_id` INT(11) NOT NULL ,
  `permission_id` SMALLINT(6) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `roles_permissions_roles_idx` (`role_id` ASC) ,
  INDEX `roles_permissions_permissions_idx` (`permission_id` ASC) ,
  CONSTRAINT `roles_permissions_permissions`
    FOREIGN KEY (`permission_id` )
    REFERENCES `permissions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `roles_permissions_roles`
    FOREIGN KEY (`role_id` )
    REFERENCES `roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sessions` ;

CREATE  TABLE IF NOT EXISTS `sessions` (
  `id` VARCHAR(255) NOT NULL DEFAULT '' ,
  `user_id` INT(11) NULL DEFAULT NULL ,
  `data` TEXT NULL DEFAULT NULL ,
  `expires` INT(11) NULL DEFAULT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `updated` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `sessions_users_idx` (`user_id` ASC) ,
  CONSTRAINT `sessions_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tickets_devices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tickets_devices` ;

CREATE  TABLE IF NOT EXISTS `tickets_devices` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(100) NOT NULL ,
  `code` VARCHAR(100) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tickets_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tickets_types` ;

CREATE  TABLE IF NOT EXISTS `tickets_types` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `description` VARCHAR(500) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `updated` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tickets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tickets` ;

CREATE  TABLE IF NOT EXISTS `tickets` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `code_number` VARCHAR(15) NOT NULL ,
  `code_year` VARCHAR(5) NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  `ticket_type_id` SMALLINT(6) NOT NULL ,
  `ticket_device_id` SMALLINT(6) NOT NULL ,
  `priority` CHAR(1) NOT NULL ,
  `status` VARCHAR(20) NOT NULL ,
  `description` VARCHAR(2000) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `tickets_tickets_types_idx` (`ticket_type_id` ASC) ,
  INDEX `tickets_tickets_devices_idx` (`ticket_device_id` ASC) ,
  INDEX `tickets_users_idx` (`user_id` ASC) ,
  CONSTRAINT `tickets_tickets_devices`
    FOREIGN KEY (`ticket_device_id` )
    REFERENCES `tickets_devices` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tickets_tickets_types`
    FOREIGN KEY (`ticket_type_id` )
    REFERENCES `tickets_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tickets_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tickets_devices_params`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tickets_devices_params` ;

CREATE  TABLE IF NOT EXISTS `tickets_devices_params` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `ticket_device_id` SMALLINT(6) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `value` VARCHAR(500) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `tickets_devices_params_tickets_devices_idx` (`ticket_device_id` ASC) ,
  CONSTRAINT `tickets_devices_params_tickets_devices`
    FOREIGN KEY (`ticket_device_id` )
    REFERENCES `tickets_devices` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `users_roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users_roles` ;

CREATE  TABLE IF NOT EXISTS `users_roles` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `role_id` INT(11) NOT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `users_roles_users_idx` (`user_id` ASC) ,
  INDEX `users_roles_roles_idx` (`role_id` ASC) ,
  CONSTRAINT `users_roles_roles`
    FOREIGN KEY (`role_id` )
    REFERENCES `roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `users_roles_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `settings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `settings` ;

CREATE  TABLE IF NOT EXISTS `settings` (
  `id` TINYINT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(20) NOT NULL ,
  `type` VARCHAR(20) NOT NULL ,
  `mask` VARCHAR(100) NULL ,
  `options` VARCHAR(100) NULL ,
  `description` VARCHAR(100) NOT NULL ,
  `helpblock` VARCHAR(500) NULL ,
  `value` VARCHAR(500) NULL ,
  `replaceable` TINYINT(1) NOT NULL ,
  `owner` INT NULL ,
  `created` TIMESTAMP NULL ,
  `modified` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banks_accounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banks_accounts` ;

CREATE  TABLE IF NOT EXISTS `banks_accounts` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `bank` VARCHAR(5) NOT NULL ,
  `agency` VARCHAR(10) NOT NULL ,
  `account` VARCHAR(10) NOT NULL ,
  `initial_value` DECIMAL(10,2) NOT NULL DEFAULT 0.00 ,
  `owner` INT NULL ,
  `created` TIMESTAMP NULL ,
  `modified` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `budgets_accounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `budgets_accounts` ;

CREATE  TABLE IF NOT EXISTS `budgets_accounts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(50) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `owner` INT NULL ,
  `created` TIMESTAMP NULL ,
  `modified` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `code_UNIQUE` (`code` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `results_centers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `results_centers` ;

CREATE  TABLE IF NOT EXISTS `results_centers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(50) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `owner` INT NULL ,
  `created` TIMESTAMP NULL ,
  `modified` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `code_UNIQUE` (`code` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users_settings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users_settings` ;

CREATE  TABLE IF NOT EXISTS `users_settings` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `setting_id` TINYINT NOT NULL ,
  `value` VARCHAR(500) NULL ,
  `owner` INT NULL ,
  `created` TIMESTAMP NULL ,
  `modified` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `users_settings_users_idx` (`user_id` ASC) ,
  INDEX `users_settings_settings_idx` (`setting_id` ASC) ,
  CONSTRAINT `users_settings_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `users_settings_settings`
    FOREIGN KEY (`setting_id` )
    REFERENCES `settings` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `organizational_structure`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `organizational_structure` ;

CREATE  TABLE IF NOT EXISTS `organizational_structure` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(50) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `owner` INT NULL ,
  `created` TIMESTAMP NULL ,
  `modified` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `entities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entities` ;

CREATE  TABLE IF NOT EXISTS `entities` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `entity_id` INT NULL ,
  `organizational_structure_id` INT NULL ,
  `type` VARCHAR(2) NOT NULL ,
  `name` VARCHAR(256) NOT NULL ,
  `number` VARCHAR(256) NOT NULL ,
  `email` VARCHAR(256) NULL ,
  `contact` VARCHAR(256) NULL ,
  `phone` VARCHAR(20) NULL ,
  `cellphone` VARCHAR(20) NULL ,
  `fax` VARCHAR(20) NULL ,
  `birthday` VARCHAR(10) NULL ,
  `address` VARCHAR(500) NULL ,
  `owner` INT NULL ,
  `created` TIMESTAMP NULL ,
  `modified` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `entities_entities_idx` (`entity_id` ASC) ,
  INDEX `entities_organizational_structure_idx` (`organizational_structure_id` ASC) ,
  CONSTRAINT `entities_entities`
    FOREIGN KEY (`entity_id` )
    REFERENCES `entities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `entities_organizational_structure`
    FOREIGN KEY (`organizational_structure_id` )
    REFERENCES `organizational_structure` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contracts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contracts` ;

CREATE  TABLE IF NOT EXISTS `contracts` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `code_number` VARCHAR(15) NOT NULL ,
  `code_year` VARCHAR(5) NOT NULL ,
  `type` VARCHAR(10) NOT NULL ,
  `entity_id` INT NOT NULL ,
  `result_center_id` INT NOT NULL ,
  `budget_account_id` INT NOT NULL ,
  `object` VARCHAR(500) NOT NULL ,
  `start` VARCHAR(10) NULL DEFAULT NULL ,
  `end` VARCHAR(10) NULL DEFAULT NULL ,
  `value` DECIMAL(10,2) NOT NULL,
  `exito_base` DECIMAL(10,2) NULL DEFAULT NULL ,
  `exito_value` DECIMAL(10,2) NULL DEFAULT NULL ,
  `bill_date` VARCHAR(10) NULL DEFAULT NULL ,
  `pay_date` VARCHAR(10) NULL DEFAULT NULL ,
  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `contracts_entitiy_id_idx` (`entity_id` ASC) ,
  INDEX `contracts_result_center_id_idx` (`result_center_id` ASC) ,
  INDEX `contracts_budget_account_id_idx` (`budget_account_id` ASC) ,
  CONSTRAINT `contracts_entity_id`
    FOREIGN KEY (`entity_id` )
    REFERENCES `entities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `contracts_result_center_id`
    FOREIGN KEY (`result_center_id` )
    REFERENCES `results_centers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `contracts_budget_account_id`
    FOREIGN KEY (`budget_account_id` )
    REFERENCES `budgets_accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Table `document_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `document_types` ;

CREATE  TABLE IF NOT EXISTS `document_types` (
  `id` smallint NOT NULL AUTO_INCREMENT ,
  `name` varchar(100) NOT NULL ,

  PRIMARY KEY (`id`)
)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `transactions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transactions` ;

CREATE  TABLE IF NOT EXISTS `transactions` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(500) NOT NULL ,
  `type` VARCHAR(10) NOT NULL ,
  `entity_id` INT NOT NULL ,
  `budget_account_id` INT NOT NULL ,

  `bill_date` VARCHAR(10) NOT NULL ,
  `pay_date` VARCHAR(10) NOT NULL ,
  `value` DECIMAL(10,2) NOT NULL ,

  `baixa_date` VARCHAR(10) NULL DEFAULT NULL,
  `baixa_value` DECIMAL(10,2) NULL DEFAULT NULL,
  `baixa_document_type_id` smallint NULL DEFAULT NULL,
  `baixa_document` VARCHAR(500) NULL DEFAULT NULL,
  `bank_account_id` SMALLINT NULL DEFAULT NULL,

  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `transactions_entitiy_id_idx` (`entity_id` ASC) ,
  INDEX `transactions_budget_account_id_idx` (`budget_account_id` ASC) ,
  INDEX `transactions_bank_account_id_idx` (`bank_account_id` ASC) ,
  INDEX `transactions_baixa_document_type_id_idx` (`baixa_document_type_id` ASC) ,
  CONSTRAINT `transactions_entity_id`
    FOREIGN KEY (`entity_id` )
    REFERENCES `entities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `transactions_budget_account_id`
    FOREIGN KEY (`budget_account_id` )
    REFERENCES `budgets_accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `transactions_bank_account_id`
    FOREIGN KEY (`bank_account_id` )
    REFERENCES `banks_accounts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `transactions_baixa_document_type_id`
    FOREIGN KEY (`baixa_document_type_id` )
    REFERENCES `document_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `transactions_results_centers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transactions_results_centers` ;

CREATE  TABLE IF NOT EXISTS `transactions_results_centers` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `transaction_id` BIGINT NOT NULL ,
  `result_center_id` INT NOT NULL ,

  `part` DECIMAL(10,0) NOT NULL ,

  `owner` INT(11) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `modified` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `transactions_results_centers_transaction_id_idx` (`transaction_id` ASC) ,
  INDEX `transactions_results_centers_result_center_id_idx` (`result_center_id` ASC),
  CONSTRAINT `transactions_results_centers_transaction_id`
    FOREIGN KEY (`transaction_id` )
    REFERENCES `transactions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `transactions_results_centers_result_center_id`
    FOREIGN KEY (`result_center_id` )
    REFERENCES `results_centers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `contract_billings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contract_billings` ;

CREATE  TABLE IF NOT EXISTS `contract_billings` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `contract_id` BIGINT NOT NULL,
  `value` DECIMAL(10,2) NOT NULL ,
  `description` VARCHAR(1000) NOT NULL,
  `state` VARCHAR(50) NOT NULL ,
  `number` VARCHAR(50) NOT NULL ,
  `date` VARCHAR(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `contract_billing_contract_id_idx` (`contract_id` ASC) ,
  CONSTRAINT `contract_billing_contract_id`
    FOREIGN KEY (`contract_id` )
    REFERENCES `contracts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Data for table `users`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `active`, `owner`, `created`, `modified`) VALUES (1, 'Administrador', '-', 'root', 'a6f8f5f726ce330f01e14f7194266df476d38e8d', 1, NULL, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `settings`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `settings` (`id`, `name`, `type`, `mask`, `options`, `description`, `helpblock`, `value`, `replaceable`, `owner`, `created`, `modified`) VALUES (1, 'timezone', 'text', '+99:99', '', 'Fuso Horário', 'Define o fuso horário padrão do sistema. (+xx:xx ou -xx:xx)', '+00:00', 1, NULL, NULL, NULL);
INSERT INTO `settings` (`id`, `name`, `type`, `mask`, `options`, `description`, `helpblock`, `value`, `replaceable`, `owner`, `created`, `modified`) VALUES (2, 'notify_by_email', 'radio', NULL, '{\"0\": \"Não\", \"1\": \"Sim\"}', 'Notificar por E-mail', 'Define se os usuários receberão notificações por e-mail sobre alertas do sistema', '0', 1, NULL, NULL, NULL);

COMMIT;
