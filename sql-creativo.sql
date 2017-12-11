

////////////////////////////////////////////////////
///////////////////////////////////////////////////

// notas faltantes individual por estudiante para un periodo del año

SELECT concat(D.nombres, " ",D.apellidos) Docente,  D.grado,  D.materia, concat(E.nombres," ",E.apellidos) Estudiante
FROM (SELECT d.nombres, d.apellidos, g.grado, m.materia, concat ( md.year, m.id,'m', md.id_g,'g') p
FROM `matricula_docente` md 
INNER JOIN docentes d ON d.id = md.id_d
INNER JOIN grados g ON g.id = md.id_g
INNER JOIN materia m ON m.id = md.id_m
WHERE md.year = 2017) D 
INNER JOIN
(SELECT a.nombres, a.apellidos, c.nota, c.id_materia, c.id_docente, g.grado, mt.materia, concat(c.year,c.id_materia,'m', g.id,'g') p
FROM (((`calificaciones` c 
INNER JOIN alumnos a ON c.id_alumno = a.id )
INNER JOIN materia mt ON mt.id =  c.id_materia)
INNER JOIN matricula m ON c.id_alumno = m.id_alumno)
INNER JOIN grados g ON g.id = m.grado
WHERE c.year = 2017 AND c.periodo = 2 AND  c.id_logro = 0 AND c.id_docente = 0 AND c.nota = 0 AND m.year =2017
ORDER BY nombres ASC, c.id_materia) E
ON D.p = E.p
ORDER BY Docente ASC, grado ASC, materia, Estudiante

// notas faltantes compilado por docente para un periodo del año

SELECT concat(D.nombres, " ",D.apellidos) Docente, COUNT(*) cantidad
FROM (SELECT d.nombres, d.apellidos, g.grado, m.materia, concat ( md.year, m.id, md.id_g) p
FROM `matricula_docente` md 
INNER JOIN docentes d ON d.id = md.id_d
INNER JOIN grados g ON g.id = md.id_g
INNER JOIN materia m ON m.id = md.id_m
WHERE md.year = 2017) D 
INNER JOIN
(SELECT a.nombres, a.apellidos, c.nota, c.id_materia, c.id_docente, g.grado, mt.materia, concat(c.year,c.id_materia, g.id) p
FROM `calificaciones` c 
INNER JOIN alumnos a ON c.id_alumno = a.id 
INNER JOIN materia mt ON mt.id =  c.id_materia
INNER JOIN matricula m ON c.id_alumno = m.id_alumno
INNER JOIN grados g ON g.id = m.grado
WHERE c.year = 2017 AND c.periodo = 2 AND  c.id_logro = 0 AND c.id_docente = 0 AND c.nota = 0 and m.year = 2017
ORDER BY c.id_alumno, c.id_materia) E
ON D.p = E.p
GROUP BY Docente
ORDER BY cantidad DESC
