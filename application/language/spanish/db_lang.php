<?php

$lang['db_invalid_connection_str'] = 'No se ha podido determinar la configuración de la base de datos basándose en la cadena proporcionada.';
$lang['db_unable_to_connect'] = 'No se ha podido conectar al servidor de base de datos usando la configuración suministrada.';
$lang['db_unable_to_select'] = 'No se ha podido seleccionar la base de datos especificada: %s';
$lang['db_unable_to_create'] = 'No se ha podido crear la base de datos especificada: %s';
$lang['db_invalid_query'] = 'La consulta enviada no es válida.';
$lang['db_must_set_table'] = 'Debe especificar la tabla que será usada en su consulta.';
$lang['db_must_use_set'] = 'Debe usar el método "set" para actualizar una entrada.';
$lang['db_must_use_index'] = 'Debe especificar un índice para que coincida con las actualizaciones por lotes.';
$lang['db_batch_missing_index'] = 'Una o más filas enviadas al proceso por lotes de actualización no se encuentra el índice especificado.';
$lang['db_must_use_where'] = 'Las actualizaciones no están permitidas a menos que contengan una cláusula "where".';
$lang['db_del_must_use_where'] = 'Las eliminaciones no están permitidas a menos que contengan una cláusula "where" o "like".';
$lang['db_field_param_missing'] = 'Para obtener campos se requiere el nombre de la tabla como parámetro.';
$lang['db_unsupported_function'] = 'Esta función no está disponible para la base de datos que está usando.';
$lang['db_transaction_failure'] = 'Fallo en la transacción: Se ha realizado un Rollback.';
$lang['db_unable_to_drop'] = 'No se ha podido eliminar la base de datos especificada.';
$lang['db_unsupported_feature'] = 'Característica no soportada por la plataforma de base de datos que está usando.';
$lang['db_unsupported_compression'] = 'El formato de compresión de ficheros que ha seleccionado no está soportado por su servidor.';
$lang['db_filepath_error'] = 'No se pueden escribir los datos en el fichero que ha enviado.';
$lang['db_invalid_cache_path'] = 'El directorio para escribir los datos de la cache no posee permisos de escritura.';
$lang['db_table_name_required'] = 'Un nombre de tabla es necesario para esa operación.';
$lang['db_column_name_required'] = 'Un nombre de columna es necesario para esa operación.';
$lang['db_column_definition_required'] = 'Una definición de columna es necesaria para esa operación.';
$lang['db_unable_to_set_charset'] = 'Imposible establecer el juego de caracteres de conexión del cliente: %s';
$lang['db_error_heading'] = 'Ocurrió un error en la base de datos';

/* End of file db_lang.php */
/* Location: ./application/language/spanish/db_lang.php */