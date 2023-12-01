<?php

return [
    'check_ip' => 'Comprobar si la IP del usuario se ha marcado como spam anteriormente, esta acción marcará el lead como spam y no se enviará por correo, pero si se guardará en la base de datos.',
    'check_html' => 'Si el mensaje del usuario contiene HTML, se le sumará un punto a su puntuación de spam.',
    'check_black_list' => 'Si el mensaje del usuario contiene palabras de la lista negra, se le sumará un punto a su puntuación de spam por cada palabra listada.',
    'check_links' => 'Si el mensaje del usuario contiene enlaces, se le sumará un punto a su puntuación de spam por cada enlace.',
];
