-- 1)
--  a)
        SELECT COUNT(*) FROM clients;
--  б)
        SELECT name, lastname, dbirth FROM clients WHERE YEAR(dbirth) >= 1990 ORDER BY dbirth;
--  в)

        SELECT
	    (SELECT COUNT(*) FROM clients WHERE name = 'Thomas') AS Thomas_count,
        (SELECT COUNT(*) FROM clients WHERE name = 'Barbara') AS Barbara_count,
        (SELECT COUNT(*) FROM clients WHERE name = 'Willie ') AS Willie_count;

