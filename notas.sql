ALTER TABLE tareas MODIFY COLUMN fecha_creacion DATETIME;


DELIMITER //

CREATE TRIGGER before_insert_tareas
BEFORE INSERT ON Tareas
FOR EACH ROW
BEGIN
    SET NEW.fecha_creacion = NOW();
END//

DELIMITER ;



