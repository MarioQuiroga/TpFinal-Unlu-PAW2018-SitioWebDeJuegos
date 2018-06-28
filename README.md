# Sitio Web de Juegos

Este sitio de juegos se desarrollará como trabajo final para la materia Programación en ambiente web, de la lic. en Sistemas de Información, de la Universidad Nacional de Luján (Arg).

## ¿Cómo subir un juego?
Primero debes tener un usuario.
Luego debes enviarnos tu juego con la organización de carpetas establecidas por el formato en un zip, junto con alguna descipción a nuestro correo: < email@email.rz >

### Formato del juego
El juego debe respetar el formato propuesto en la carpeta /GameTemplate.

#### Css
* No se debe valer de librerias externas.
* Los selectores css deben utilizar una especificidad de clase o mayor.
* Las clases deben arrancar todas con un guión bajo ' _ '.
``` 
div._miDiv { ... }   
```
#### js
* No se debe valer de librerias externas a excepción de jquery.
* No debe estar mimificado, debe ser código leible y comentado, nosotros luego nos encargaremos de mimificarlo.
* No debe interferir con elementos fuera del alcance de su juego.

#### HTML
* Atenerse a un div principal similar al del template.

### Publicar puntaje
Simplemente debe imitar el comportamiento del js del template cada vez que considere oportuno en el contexto de su juego, actualizar el puntaje del jugador.

Cualquier otra cosa o consideración que nos facilite la revisión del juego , escríbala en el correo.