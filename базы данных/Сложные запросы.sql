-- 1 упражнение

--1)
    SELECT 
        subjects.name AS subject_name, 
        CONCAT(students.firstname, " ", students.lastname) AS full_name, 
        student_marks.mark, 
        student_marks.date 
    FROM 
        students, 
        subjects, 
        student_marks 
    ORDER BY 
        subjects.name;

--2)

    SELECT 
        CONCAT(students.firstname, " ", students.lastname) AS full_name, 
        subjects.name AS subject_name, 
        AVG(student_marks.mark)
    FROM 
        students, 
        subjects, 
        student_marks
    WHERE 
        students.id = student_marks.student_id AND
        subjects.id = student_marks.subject_id
    GROUP BY
        full_name,
        subjects.name
    ORDER BY 
        full_name;

--3)
    SELECT 
        CONCAT(students.firstname, " ", students.lastname) AS full_name, 
        student_marks.mark AS current_mark,
        CONCAT((SELECT 
                    COUNT(student_marks.mark)
                FROM
                    student_marks   
                WHERE 
                    students.id = student_marks.student_id AND
                    subjects.id = student_marks.subject_id AND
                    student_marks.mark = current_mark
        ), " - штук") AS count_mark
    FROM 
        students, 
        subjects, 
        student_marks
    WHERE 
        students.id = student_marks.student_id AND
        subjects.id = student_marks.subject_id
    GROUP BY
        full_name,
        student_marks.mark
    ORDER BY 
        full_name,
        current_mark DESC;

--4)
    SELECT 
        CONCAT(students.firstname, " ", students.lastname) AS full_name,
        (SELECT 
                AVG(student_marks.mark)
            FROM
                student_marks
            WHERE 
                students.id = student_marks.student_id
        ) as avg_mark
    FROM 
    students
    ORDER BY
        avg_mark DESC
    LIMIT 1;

    SELECT 
        CONCAT(students.firstname, " ", students.lastname) AS full_name,
        (SELECT 
                AVG(student_marks.mark)
            FROM
                student_marks
            WHERE 
                students.id = student_marks.student_id
        ) as avg_mark
    FROM 
    students
    ORDER BY
        avg_mark ASC
    LIMIT 1;

--5)
    SELECT 
        subjects.name,
        (SELECT 
                AVG(student_marks.mark)
            FROM
                student_marks
            WHERE 
                subjects.id = student_marks.subject_id
        ) as avg_mark
    FROM 
    subjects
    ORDER BY
        avg_mark DESC
    LIMIT 1;

--6)
    SELECT 
        DAYNAME(subject_schedules.date) as weekday,
        subjects.name as subject_name
    FROM
        subjects,
        subject_schedules
    WHERE
        subjects.id = subject_schedules.subject_id AND
        YEARWEEK(subject_schedules.date) = (SELECT MIN(YEARWEEK(date))+1 FROM subject_schedules LIMIT 1)
    ORDER BY 
        (DAYOFWEEK(subject_schedules.date) + 5) % 7;

--упражнение 2

--1)
    CREATE TABLE student_visits (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        schedule_id int NOT NULL,
        student_id INT NOT NULL,
        visited BOOLEAN DEFAULT false
    )

--2)
        INSERT INTO student_visits (schedule_id, student_id, visited) VALUES
        (1, 1, 1),
        (1, 2, 1),
        (1, 3, 1),
        (1, 4, 1),
        (1, 5, 1),
        ...
        (14, 1, 1),
        (14, 2, 1),
        (14, 3, 1),
        (14, 4, 1),
        (14, 5, 1)

--3)
    SELECT
        subjects.name,
        (SELECT
            COUNT(*)
        FROM
            student_visits,
            subject_schedules
        WHERE
         	student_visits.visited = 1 AND
            student_visits.schedule_id = subject_schedules.id AND
            subject_schedules.subject_id = subjects.id) AS visits
    FROM
        subjects;


    
