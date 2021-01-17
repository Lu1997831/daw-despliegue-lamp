
use publications;

-- Crear una tabla
CREATE TABLE classics (
author VARCHAR(128),
title VARCHAR(128),
type VARCHAR(16),
year CHAR(4)) ENGINE MyISAM;


-- Insertar registros en la nueva tabla
INSERT INTO classics(author, title, type, year)
 VALUES('Mark Twain','The Adventures of Tom Sawyer','Fiction','1876');
INSERT INTO classics(author, title, type, year)
 VALUES('Jane Austen','Pride and Prejudice','Fiction','1811');
INSERT INTO classics(author, title, type, year)
 VALUES('Charles Darwin','The Origin of Species','Non-Fiction','1856');
INSERT INTO classics(author, title, type, year)
 VALUES('Charles Dickens','The Old Curiosity Shop','Fiction','1841');
INSERT INTO classics(author, title, type, year)
 VALUES('William Shakespeare','Romeo and Juliet','Play','1594');

 
 commit;
 
 
 -- Añadir un nuevo campo a la tabla
 ALTER TABLE classics ADD isbn CHAR(13) not null;
 
-- Asignar valores al nuevo campo para la tabla creada
 UPDATE classics SET isbn='9781598184891' WHERE year='1876';
UPDATE classics SET isbn='9780582506206' WHERE year='1811';
UPDATE classics SET isbn='9780517123201' WHERE year='1856';
UPDATE classics SET isbn='9780099533474' WHERE year='1841';
UPDATE classics SET isbn='9780192814968' WHERE year='1594';

-- Agregar una clave primaria a la tabla
ALTER TABLE classics ADD PRIMARY KEY(isbn);



commit;

-- Cambiar el tipo de datos de un campo
ALTER TABLE classics CHANGE type category VARCHAR(16);


 
 
 
 

