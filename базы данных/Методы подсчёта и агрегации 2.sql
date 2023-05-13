
-- 2)
--  a) по каждому дню

    SELECT date, SUM(hits) AS sum_of_hits, SUM(loads) AS sum_of_loads
    FROM stats
    GROUP BY date;

--  б) по каждой стране
    SELECT country, SUM(hits) AS sum_of_hits, SUM(loads) AS sum_of_loads
    FROM stats
    GROUP BY country;

--  в) по каждому дню по каждой стране
    SELECT date, country, SUM(hits) AS sum_of_hits, SUM(loads) AS sum_of_loads
    FROM stats
    GROUP BY date, country;

-- 3)

--  а) по дням
    SELECT date, AVG(hits) AS average_hits_per_day
    FROM stats
    GROUP BY date;

--  б) по странам
    SELECT country, AVG(hits) AS average_hits_per_country
    FROM stats
    GROUP BY country;


-- 4)
--  а) по дням
    SELECT date, AVG(loads) AS average_loads_per_day
    FROM stats
    GROUP BY date;

--  б) по странам 
    SELECT country, AVG(loads) AS average_loads_per_day
    FROM stats
    GROUP BY country;


-- 5)
--  а) по дням
    SELECT date, MAX(loads) AS max_loads_per_day, MIN(loads) AS min_loads_per_day
    FROM stats
    GROUP BY date;

--  б) по странам
    SELECT country, MAX(loads) AS max_loads_per_day, MIN(loads) AS min_loads_per_day
    FROM stats
    GROUP BY country;

-- 6)
    SELECT date, SUM(loads)/SUM(hits) AS conversion
    FROM stats
    GROUP BY date;

-- 7)
    SELECT date, SUM(loads)/SUM(hits) AS conversion_rate
    FROM stats
    GROUP BY date
    ORDER BY conversion_rate DESC
    LIMIT 1;

-- 8)
    SELECT
        country,
        SUM(loads) as total_loads,
        SUM(hits) as total_hits,
        CAST(SUM(loads) AS float) / NULLIF(CAST(SUM(hits) AS float), 0) as conversion
    FROM stats
    GROUP BY country
    ORDER BY conversion DESC
    LIMIT 5;