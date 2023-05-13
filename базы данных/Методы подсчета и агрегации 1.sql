-- 1)
--  a)
        SELECT COUNT(*) FROM clients;
--  б)
        SELECT name, lastname, dbirth FROM clients WHERE YEAR(dbirth) >= 1990 ORDER BY dbirth;
--  в)
        SELECT
	        (SELECT COUNT(*) FROM clients WHERE name = 'Thomas') AS thomas_count,
                (SELECT COUNT(*) FROM clients WHERE name = 'Barbara') AS barbara_count,
                (SELECT COUNT(*) FROM clients WHERE name = 'Willie ') AS willie_count;


-- 2)
--  a)
        SELECT  YEAR(dbirth) AS birth_year, COUNT(*) AS num_clients
        FROM clients
        GROUP BY birth_year;
--  б)
        SELECT  
                YEAR(dbirth) AS birth_year, 
                gender,
                COUNT(*) AS count
        FROM clients
        GROUP BY birth_year, gender
        ORDER BY birth_year;         


-- 3)
        SELECT  MONTH(dbirth) AS birth_month, COUNT(*) AS count
        FROM clients
        GROUP BY birth_month
        ORDER BY birth_month ASC;


-- 4)
--  а)
        SELECT  AVG(DATEDIFF(CURDATE(), dbirth)/365) as average_age FROM clients;
--  б)
        SELECT  MIN(DATEDIFF(CURDATE(), dbirth)/365) as min_age FROM clients;
--  в)
        SELECT  MAX(DATEDIFF(CURDATE(), dbirth)/365) as max_age FROM clients;


-- 5)
--  1960-1969)
        SELECT DISTINCT  name  FROM clients
        WHERE dbirth BETWEEN  '1960-01-01'  AND  '1969-12-31';
--  1970-1979)
        SELECT DISTINCT  name  FROM clients
        WHERE dbirth BETWEEN  '1980-01-01'  AND  '1989-12-31';
--  1980-1989)
        SELECT DISTINCT  name  FROM clients
        WHERE dbirth BETWEEN  '1990-01-01'  AND  '1999-12-31';
--  1990-1999)


-- 6)
--  1940-1949)
        SELECT gender, COUNT(*) AS count FROM clients
        WHERE dbirth BETWEEN  '1940-01-01'  AND  '1949-12-31'
        GROUP BY gender;
--  1950-1959)
        SELECT gender, COUNT(*) AS count FROM clients
        WHERE dbirth BETWEEN  '1950-01-01'  AND  '1959-12-31'
        GROUP BY gender;
--  1960-1969)
        SELECT gender, COUNT(*) AS count FROM clients
        WHERE dbirth BETWEEN  '1960-01-01'  AND  '1969-12-31'
        GROUP BY gender;
--  1970-1979)
        SELECT gender, COUNT(*) AS count FROM clients
        WHERE dbirth BETWEEN  '1970-01-01'  AND  '1979-12-31'
        GROUP BY gender;