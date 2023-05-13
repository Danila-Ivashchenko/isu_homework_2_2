-- 1)
--  а)
    SELECT UPPER(id), UPPER(name) FROM clients;

--  б) к нижнему регистру
    SELECT LOWER(id), LOWER(name) FROM clients;


-- 2)
    SELECT
        CONCAT(name, ' ', lastname) AS full_name, 
        CONCAT(LEFT(phone, 3), REPEAT('*', LENGTH(phone)-4), RIGHT(phone, 1)) AS phone_number
    FROM clients;


-- 3)
    SELECT 
        CONCAT(LEFT(name, 1), '.', ' ', lastname) AS full_name 
    FROM clients 
    WHERE 
        lastname LIKE '%tt%' OR lastname LIKE '%ss%' OR lastname LIKE '%ll%';


-- 4)
--  а) начинаются на 586
    SELECT * FROM clients WHERE phone LIKE '586%';

--  б) содержат 657
    SELECT * FROM clients WHERE phone LIKE '%657%';

--  в) заканчиваются на 707
    SELECT * FROM clients WHERE phone LIKE '%707';