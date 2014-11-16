CREATE TABLE blokace (id BIGINT AUTO_INCREMENT, datum DATE, castka DOUBLE(18, 2), karta VARCHAR(255), mena VARCHAR(255), obchod VARCHAR(100), typ VARCHAR(255), misto VARCHAR(50), realizovano TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE email_texts_translation (id BIGINT, body LONGTEXT, subject VARCHAR(100), lang CHAR(2), PRIMARY KEY(id, lang)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE email_texts (id BIGINT AUTO_INCREMENT, type_of_mail VARCHAR(255) DEFAULT 'registrace', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE kurz (id BIGINT AUTO_INCREMENT, mena VARCHAR(255) UNIQUE, kurz DOUBLE(18, 2), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE notallowed (id BIGINT AUTO_INCREMENT, word VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE pocatek (id BIGINT AUTO_INCREMENT, typ_uctu VARCHAR(255), mena VARCHAR(255), stav DOUBLE(18, 2), urok DOUBLE(18, 2), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX name_index_idx (typ_uctu, mena), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE pohyby (id BIGINT AUTO_INCREMENT, typ_uctu VARCHAR(255), mena VARCHAR(255), typ VARCHAR(255), karta VARCHAR(255), kod_transakce VARCHAR(15), datum DATE, cas TIME, z_uctu VARCHAR(30), v_mene VARCHAR(255), na_ucet VARCHAR(30), kod_banky VARCHAR(4), castku DOUBLE(18, 2), meny VARCHAR(255), kurz DOUBLE(18, 2) DEFAULT 1, poplatek DOUBLE(18, 2) DEFAULT 0, zprava DOUBLE(18, 2) DEFAULT 0, variabilni_symbol VARCHAR(20), konstantni_symbol VARCHAR(20), specificky_symbol VARCHAR(20), prevest_dne DATE, ukonceni_platnosti DATE, zprava_pro_prijemce VARCHAR(150), zprava_pro_mne VARCHAR(150), umoznit_castecnou_realizaci TINYINT(1), realizovano TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE registration (id BIGINT AUTO_INCREMENT, name VARCHAR(50) NOT NULL UNIQUE, domain VARCHAR(50) NOT NULL UNIQUE, email VARCHAR(150) NOT NULL, checked TINYINT(1) DEFAULT '1', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE registration_check (id BIGINT AUTO_INCREMENT, reg_id BIGINT, hesh VARCHAR(32) NOT NULL UNIQUE, in_process TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX reg_id_idx (reg_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE registration_complet (id BIGINT AUTO_INCREMENT, reg_id BIGINT, password VARCHAR(32) NOT NULL, gen_password VARCHAR(100), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX reg_id_idx (reg_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE reserved (id BIGINT AUTO_INCREMENT, word VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sended_email (id BIGINT AUTO_INCREMENT, reg_id BIGINT, hesh VARCHAR(32), mail_id BIGINT, sended_od DATE, send_success TINYINT(1), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX mail_id_idx (mail_id), INDEX reg_id_idx (reg_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sms (id BIGINT AUTO_INCREMENT, kdo VARCHAR(20), kod VARCHAR(20), obsah TEXT, odeslano TINYINT(1) DEFAULT '0', overeno TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE texty_translation (id BIGINT, text LONGTEXT, lang CHAR(2), PRIMARY KEY(id, lang)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE texty (id BIGINT AUTO_INCREMENT, typ VARCHAR(255) UNIQUE, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE zpravy (id BIGINT AUTO_INCREMENT, typ_uctu VARCHAR(255), mena VARCHAR(255), datum DATE, popis VARCHAR(200), text LONGTEXT, precteno TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ENGINE = INNODB;
ALTER TABLE email_texts_translation ADD CONSTRAINT email_texts_translation_id_email_texts_id FOREIGN KEY (id) REFERENCES email_texts(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE registration_check ADD CONSTRAINT registration_check_reg_id_registration_id FOREIGN KEY (reg_id) REFERENCES registration(id);
ALTER TABLE registration_complet ADD CONSTRAINT registration_complet_reg_id_registration_id FOREIGN KEY (reg_id) REFERENCES registration(id);
ALTER TABLE sended_email ADD CONSTRAINT sended_email_reg_id_registration_id FOREIGN KEY (reg_id) REFERENCES registration(id);
ALTER TABLE sended_email ADD CONSTRAINT sended_email_mail_id_email_texts_id FOREIGN KEY (mail_id) REFERENCES email_texts(id);
ALTER TABLE texty_translation ADD CONSTRAINT texty_translation_id_texty_id FOREIGN KEY (id) REFERENCES texty(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;