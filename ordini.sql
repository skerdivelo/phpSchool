CREATE DATABASE IF NOT EXISTS ecommerce;
USE ecommerce;

CREATE TABLE Categoria (
    id INT AUTO_INCREMENT,
    categoria VARCHAR(255),
    PRIMARY KEY(id)
);

CREATE TABLE Prodotti (
    id INT AUTO_INCREMENT,
    name VARCHAR(255),
    price DECIMAL(10,2),
    rating DECIMAL(3,2),
    fkCategoria INT,
    PRIMARY KEY(id),
    FOREIGN KEY (fkCategoria) REFERENCES Categoria(id)
);

CREATE TABLE Utenti (
    id INT AUTO_INCREMENT,
    name VARCHAR(255),
    surname VARCHAR(255),
    indirizzo VARCHAR(255),
    numero_telefono VARCHAR(255),
    PRIMARY KEY(id)
);

CREATE TABLE Ordini (
    id INT AUTO_INCREMENT,
    fkProdotti INT,
    fkUtente INT,
    ora_acquisto TIME,
    data DATE,
    quantità INT,
    prezzo DECIMAL(10,2),
    PRIMARY KEY(id),
    FOREIGN KEY (fkProdotti) REFERENCES Prodotti(id),
    FOREIGN KEY (fkUtente) REFERENCES Utenti(id)
);

-- Insert into Categoria
INSERT INTO Categoria (categoria) VALUES ('Laptops'), ('Orologi'), ('Cuffie'), ('Telefoni'), ('Computer'), ('Tastiere');

-- Insert into Prodotti
INSERT INTO Prodotti (id, name, price, rating, fkCategoria) VALUES 
(1, 'Macbook Pro', 2199.00, 4.7, (SELECT id FROM Categoria WHERE categoria = 'Laptops')),
(2, 'Watch SE', 229.00, 4.8, (SELECT id FROM Categoria WHERE categoria = 'Orologi')),
(3, 'AirPods', 329.00, 4.9, (SELECT id FROM Categoria WHERE categoria = 'Cuffie')),
(4, 'iPhone 15', 1299.00, 4.6, (SELECT id FROM Categoria WHERE categoria = 'Telefoni')),
(5, 'iMac', 1499.00, 4.5, (SELECT id FROM Categoria WHERE categoria = 'Computer')),
(6, 'Galaxy Watch', 599.00, 4.1, (SELECT id FROM Categoria WHERE categoria = 'Orologi')),
(7, 'Apple Watch 6', 599.00, 4.4, (SELECT id FROM Categoria WHERE categoria = 'Orologi')),
(8, 'Galaxy Watch 7', 999.00, 4.8, (SELECT id FROM Categoria WHERE categoria = 'Orologi')),
(9, 'Headphones Big Max', 99.00, 3.8, (SELECT id FROM Categoria WHERE categoria = 'Cuffie')),
(10, 'Big Ear 2', 199.00, 4.5, (SELECT id FROM Categoria WHERE categoria = 'Cuffie')),
(11, 'EarBud 6', 99.00, 4.9, (SELECT id FROM Categoria WHERE categoria = 'Cuffie')),
(12, 'Smooth Cuf', 49.00, 4.2, (SELECT id FROM Categoria WHERE categoria = 'Cuffie')),
(13, 'Blacked Keyboard', 169.00, 5.0, (SELECT id FROM Categoria WHERE categoria = 'Tastiere')),
(14, 'Whitle Keyboard', 79.00, 4.2, (SELECT id FROM Categoria WHERE categoria = 'Tastiere')),
(15, 'LGBT Keyboard', 10.00, 0.1, (SELECT id FROM Categoria WHERE categoria = 'Tastiere')),
(16, 'Coder Keyboard', 229.00, 4.8, (SELECT id FROM Categoria WHERE categoria = 'Tastiere'));
