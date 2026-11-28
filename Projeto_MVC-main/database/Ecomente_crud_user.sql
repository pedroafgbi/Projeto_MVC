-- Atualiza a tabela users que você JÁ TEM (sem apagar dados).
-- phpMyAdmin: clique no banco do projeto -> aba SQL -> cole e execute.

-- 1) SÓ se a chave primária da sua tabela ainda se chamar "id" (descomente a linha):
-- ALTER TABLE users CHANGE id id_user INT NOT NULL AUTO_INCREMENT;

-- 2) Coluna da senha (hash) e coluna de ativo/inativo:
ALTER TABLE users
  ADD COLUMN password VARCHAR(255) NOT NULL DEFAULT '' AFTER birth_date,
  ADD COLUMN active   TINYINT(1)   NOT NULL DEFAULT 1  AFTER password;
