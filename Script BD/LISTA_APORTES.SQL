SELECT A
	.ID,
	A."TITULO",
	A."DESCRIPCION",
	A.created_at,
	A."HABILITADO",
	A."ID_AREA",
	A."ID_USUARIO" AS "ID_AUTOR",
	(
	SELECT
		users_1.NAME AS autor_co 
	FROM
		users users_1 
	WHERE
	( A."ID_USUARIO" = users_1.ID )) AS "AUTOR_APORTE",
	(
	SELECT COUNT
		( C.ID ) AS COUNT 
	FROM
		"Comentario" C 
	WHERE
		((
				C."ID_APORTE" = A.ID 
				) 
		AND ( C."HABILITADO" = TRUE ))) AS "CANTIDAD_COMENTARIOS" 
FROM
	"Aporte" A