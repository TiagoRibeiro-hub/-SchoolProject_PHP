-- Criação...
CREATE DATABASE raizes CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
USE raizes

CREATE TABLE admin (
id              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
email           VARCHAR (100) NOT NULL UNIQUE,
pass            VARCHAR (100) NOT NULL UNIQUE,
PRIMARY KEY     (id)
);

CREATE TABLE cliente (
id                  BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
PRIMARY KEY         (id),
primeiro_nome       VARCHAR (100) NOT NULL,
apelido             VARCHAR (100) NOT NULL,
user                VARCHAR (100) NOT NULL UNIQUE,
email               VARCHAR (100) NOT NULL UNIQUE,
pass                VARCHAR (100) NOT NULL UNIQUE,
morada              VARCHAR (100) NOT NULL,
codigo_postal       SMALLINT UNSIGNED NOT NULL,
localidade          VARCHAR (100) NOT NULL,
data_registo        TIMESTAMP CURRENT_TIMESTAMP
);

CREATE TABLE categoria (
id              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
nome            VARCHAR (100) NOT NULL,
descricao       VARCHAR (1000),
parent          SMALLINT UNSIGNED,
PRIMARY KEY     (id),
FOREIGN KEY     (parent) REFERENCES categoria (id)
);

CREATE TABLE produtos (
id                  BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
nome                VARCHAR (100) NOT NULL,
tamanho             VARCHAR (10),
preco               SMALLINT UNSIGNED NOT NULL CHECK (preco > 0),
iva                 SMALLINT UNSIGNED NOT NULL,
descricao           VARCHAR (1000),
categoria_id        INT,
PRIMARY KEY         (id),
FOREIGN KEY         (categoria_id) REFERENCES categoria (id) 
);

CREATE TABLE stock (
produtos_id         BIGINT UNSIGNED NOT NULL,
quantidade          BIGINT UNSIGNED NOT NULL CHECK (quantidade >= 0),
PRIMARY KEY         (produtos_id)
);

CREATE TABLE stock_entradas (
    id                  BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    produtos_id         BIGINT UNSIGNED NOT NULL,
    quantidade          BIGINT UNSIGNED NOT NULL CHECK (quantidade >= 0), 
    data                TIMESTAMP CURRENT_TIMESTAMP
);

CREATE TABLE stock_saidas (
    id                  BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    produtos_id         BIGINT UNSIGNED NOT NULL,
    quantidade          BIGINT UNSIGNED NOT NULL CHECK (quantidade >= 0), 
    data                TIMESTAMP CURRENT_TIMESTAMP
);

CREATE TABLE imagens (
    imagem_id       BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    produtos_id     BIGINT UNSIGNED NOT NULL,
    imagem_nome     VARCHAR (250) NULL,
    PRIMARY KEY     (imagem_id),
    FOREIGN KEY     (produtos_id) REFERENCES produtos (id)
); 


-------------------------
--Categoria Craftwork(1)
-------------------------
INSERT INTO categoria (nome, descricao) VALUES ("Craft Work", "Craft Work….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum? Aperiam aspernatur recusandae, eius consequatur quia, aut eveniet consequuntur accusantium est temporibus et esse dignissimos error ut at in ipsum mollitia tempore, minima quibusdam vero deserunt voluptas quisquam? Consequuntur omnis, inventore magnam tempore incidunt fugit impedit! Voluptates consectetur eveniet reprehenderit recusandae nesciunt sequi ipsum laboriosam, voluptatem iste! Iste, at placeat quas quae sed pariatur cumque perspiciatis voluptatibus iusto neque provident sapiente beatae fuga."
);

----------------------------
--Sub-Categoria Craftwork(2)--Wooden Wonders
----------------------------
INSERT INTO categoria (nome, descricao, parent) VALUES ("Wooden Wonders", "Wooden Wonders….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum? Aperiam aspernatur recusandae, eius consequatur quia, aut eveniet consequuntur accusantium est temporibus et esse dignissimos error ut at in ipsum mollitia tempore, minima quibusdam vero deserunt voluptas quisquam? Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 1
);

--Categoria-produto-Wooden wonders
-----------------------------------
--Holders(3)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Holders", "Holders….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 2
);
------------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Candle-holder", " ", 7.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 3);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 1);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Herb-holder", "S", 10.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 3);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 2);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Herb-holder", "M", 15.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 3);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 3);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Herb-holder", "L", 20.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 3);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 4);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Stick incense", " ", 7.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 3);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 5);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Key-holder", " ", 10.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 3);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 6);
------------------

--Home Decor(4)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Home Decor", "Home Decor ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 2
);
-----------------------------Produtos
INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Shelves", " ", 15.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 4);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 7);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Wooden squares", "S", 10.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 4);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 8);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Wooden squares", "L", 13.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 4);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 9);
----------------------------

----------------------------
--Sub-Categoria Craftwork(5)--Magick Wonders
----------------------------
INSERT INTO categoria (nome, descricao, parent) VALUES ("Magick Wonders", "Magick Wonders….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum? Aperiam aspernatur recusandae, eius consequatur quia, aut eveniet consequuntur accusantium est temporibus et esse dignissimos error ut at in ipsum mollitia tempore, minima quibusdam vero deserunt voluptas quisquam? Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 1
);

--Categoria-produto-Magick wonders
-----------------------------------
--Magick Tools(6)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Magick Tools", "Magick Tools ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 5
);
--------------------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Rune Sets", "S", 15.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 6);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 10);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Rune Sets", "M", 20.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 6);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 11);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Rune Sets", "L", 25.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 6);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 12);
-------------------------

--Altars(7)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Altars", "Altars ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 5
);
------------------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Wooden box", " ", 10.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 7);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 13);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Portable Altars", " ", 20.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 7);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 14);
-----------------------
--Talisman(8)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Talisman", "Talisman ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 5
);
-----------------------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Talisman", "S", 7.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 8);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 15);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Talisman", "M", 13.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 8);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 16);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Talisman", "L", 15.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 8);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 17);
-----------------------------

-----------------------------
--Sub-Categoria Craftwork(9)--Tiny Wonders
-----------------------------
INSERT INTO categoria (nome, descricao, parent) VALUES ("Tiny Wonders", "Tiny Wonder.….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum? Aperiam aspernatur recusandae, eius consequatur quia, aut eveniet consequuntur accusantium est temporibus et esse dignissimos error ut at in ipsum mollitia tempore, minima quibusdam vero deserunt voluptas quisquam? Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!",1
);

--Categoria-produto-Tiny Wonders
------------------------------

--Necklesses(10)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Necklesses", "Necklesses ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 9
);
---------------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Wired", " ", 7.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 10);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 18);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Wooden", " ", 5.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 10);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 19);
--------------------

--Earings(11)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Earings", "Earings ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 9
);
---------------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Earings", "single", 3.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 11);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 20);
--------------------

--Keychains(12)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Keychains", "Keychains ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 9
);
---------------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Keychain", " ", 3.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 12);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 21);
--------------------

--Bottle Openers(13)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Bottle Openers", "Bottle Openers ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 9
);
-------------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Bottle opener", " ", 7.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 13);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 22);
---------------------
------------------------------

------------------------------
--Categoria HerbalProducts(14)
------------------------------
INSERT INTO categoria (nome, descricao) VALUES ("Herbal Products", "Herbal Products ….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum? Aperiam aspernatur recusandae, eius consequatur quia, aut eveniet consequuntur accusantium est temporibus et esse dignissimos error ut at in ipsum mollitia tempore, minima quibusdam vero deserunt voluptas quisquam? Consequuntur omnis, inventore magnam tempore incidunt fugit impedit! Voluptates consectetur eveniet reprehenderit recusandae nesciunt sequi ipsum laboriosam, voluptatem iste! Iste, at placeat quas quae sed pariatur cumque perspiciatis voluptatibus iusto neque provident sapiente beatae fuga."
);

---------------------------------
--Sub-Categoria HerbalProducts(15)--Natural Wonders
---------------------------------
INSERT INTO categoria (nome, descricao, parent) VALUES ("Natural Wonders", "Natural Wonders….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum? Aperiam aspernatur recusandae, eius consequatur quia, aut eveniet consequuntur accusantium est temporibus et esse dignissimos error ut at in ipsum mollitia tempore, minima quibusdam vero deserunt voluptas quisquam? Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 14
);

--Categoria-produto-Natural Wonders
---------------------------------
--Self-care(16)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Self-care", "Self-care….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 15
);
---------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Body Scrub", "L", 17.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 16);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 23);
----------------

--Balms(17)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Balms", "Balms….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 15
);
----------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Balms", "3ml", 2.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 17);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 24);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Balms", "5ml", 3.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 17);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 25);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Balms", "100ml", 10.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 17);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 26);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Balms", "200ml", 15.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 17);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 27);
-------------------

----------------------------------
--Sub-Categoria HerbalProducts(18)--Herbal Incenses
----------------------------------
INSERT INTO categoria (nome, descricao, parent) VALUES ("Herbal Incenses", "Herbal Incenses ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum? Aperiam aspernatur recusandae, eius consequatur quia, aut eveniet consequuntur accusantium est temporibus et esse dignissimos error ut at in ipsum mollitia tempore, minima quibusdam vero deserunt voluptas quisquam? Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 14 
);

--Categoria-produto-Herbal Incenses
--Bundles(19)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Bundles", "Bundles ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 18
);
----------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Bundles", "mini", 1.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 19);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 28);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Bundles", "15cm", 2.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 19);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 29);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Bundles", "20cm", 3.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 19);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 30);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Bundles", "30cm", 4.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 19);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 31);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Bundles", "50cm", 5.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 19);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 32);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Bundles Salvia", "15cm", 6.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 19);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 33);
-----------------------

--Disks(20)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Disks", "Disks ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 18
);
----------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Disks w/charcoal", " ", 2.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 20);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 34);
-----------------------
----------------------------------
--Sub-Categoria HerbalProducts(21)--Candles
----------------------------------
INSERT INTO categoria (nome, descricao, parent) VALUES ("Candles", "Candles….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum? Aperiam aspernatur recusandae, eius consequatur quia, aut eveniet consequuntur accusantium est temporibus et esse dignissimos error ut at in ipsum mollitia tempore, minima quibusdam vero deserunt voluptas quisquam? Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 14
);
--Categoria-produto-Candles
--Candles(22)
INSERT INTO categoria (nome, descricao, parent) VALUES ("Candle", "Candle ….….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?  Consequuntur omnis, inventore magnam tempore incidunt fugit impedit!", 21
);
----------------Produtos

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Handmade candles", " ", 5.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 22);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 35);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Elementa", " ", 7.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 22);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 36);

INSERT INTO produtos (nome, tamanho, preco, iva, descricao, categoria_id) VALUES ("Spells", "5unidade", 10.00, 23, "descriçao….Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim incidunt voluptates ipsam, impedit asperiores animi iure perferendis harum accusamus earum?", 22);
INSERT INTO stock (quantidade, produtos_id) VALUES (15, 37);
---------------------

