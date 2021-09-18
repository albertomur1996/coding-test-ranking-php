# Reto: Servicio para gestión de calidad de los anuncios

Este repositorio contiene un API parcialmente desarrollada para desarrollar un servicio que se encargue de medir la calidad de los anuncios. Tu objetivo será implementar las historias de usuario que se describen más adelante.

Los supuestos están basados en un hipotético *equipo de gestión de calidad de los anuncios*, que demanda una serie de verificaciones automáticas para clasificar los anuncios en base a una serie de características concretas.

## Historias de usuario

* Yo, como encargado del equipo de gestión de calidad de los anuncios quiero asignar una puntuación a un anuncio para que los usuarios de idealista puedan ordenar anuncios de más completos a menos completos. La puntuación del anuncio es un valor entre 0 y 100 que se calcula teniendo encuenta las siguientes reglas:
  * Si el anuncio no tiene ninguna foto se restan 10 puntos. Cada foto que tenga el anuncio proporciona 20 puntos si es una foto de alta resolución (HD) o 10 si no lo es.
  * Que el anuncio tenga un texto descriptivo suma 5 puntos.
  * El tamaño de la descripción también proporciona puntos cuando el anuncio es sobre un piso o sobre un chalet. En el caso de los pisos, la descripción aporta 10 puntos si tiene entre 20 y 49 palabras o 30 puntos si tiene 50 o mas palabras. En el caso de los chalets, si tiene mas de 50 palabras, añade 20 puntos.
  * Que las siguientes palabras aparezcan en la descripción añaden 5 puntos cada una: Luminoso, Nuevo, Céntrico, Reformado, Ático.
  * Que el anuncio esté completo también aporta puntos. Para considerar un anuncio completo este tiene que tener descripción, al menos una foto y los datos particulares de cada tipología, esto es, en el caso de los pisos tiene que tener también tamaño de vivienda, en el de los chalets, tamaño de vivienda y de jardín. Además, excepcionalmente, en los garajes no es necesario que el anuncio tenga descripción. Si el anuncio tiene todos los datos anteriores, proporciona otros 40 puntos.

* Yo como encargado de calidad quiero que los usuarios no vean anuncios irrelevantes para que el usuario siempre vea contenido de calidad en idealista. Un anuncio se considera irrelevante si tiene una puntación inferior a 40 puntos.

* Yo como encargado de calidad quiero poder ver los anuncios irrelevantes y desde que fecha lo son para medir la calidad media del contenido del portal.

* Yo como usuario de idealista quiero poder ver los anuncios ordenados de mejor a peor para encontrar fácilmente mi vivienda.

## Consideraciones importantes

En este proyecto te proporcionamos un pequeño *esqueleto* escrito en PHP 8 usando Symfony Flex.

En dicho *esqueleto* hemos dejado varios Controllers y un Repository en el sistema de ficheros como orientación. Puedes crear las clases y métodos que consideres necesarios.

Podrás ejecutar el proyecto utilizando la configuración de Docker que dejamos en el mismo *esqueleto* e instalando a través de composer los paquetes necesarios.

**La persistencia de datos no forma parte del objetivo del reto**. Si no vas a usar el esqueleto que te proporcionamos, te sugerimos que la simplifiques tanto como puedas (con una base de datos embebida, "persistiendo" los objetos en memoria, usando un fichero...). **El diseño de una interfaz gráfica tampoco** forma parte del alcance del reto, por tanto no es necesario que la implementes.

**Nota:** No estás obligado a usar el proyecto proporcionado. Si lo prefieres, puedes usar cualquier otro lenguaje, framework y/o librería. Incluso puedes prescindir de estos últimos si consideras que no son necesarios. A lo que más importancia damos es a tener un código limpio y de calidad.

### Requisitos mínimos

A continuación se enumeran los requisitos mínimos para ejecutar el proyecto:

* PHP 8
* Symfony Local Web Server o Nginx.

## Criterios de aceptación

* El código debe ser ejecutable y no mostrar ninguna excepción.

* Debes proporcionar 3 endpoints: Uno para calcular la puntuación de todos los anuncios, otro para listar los anuncios para un usuario de idealista y otro para listar los anuncios para el responsable del departamento de gestión de calidad.

# Instrucciones/requisitos de entrega

## Requisitos

* Sistema Operativo: Windows, Linux o MacOS (recomendable Windows o MacOS por la facilidad de instalación de Docker)
* Plataforma de ejecución: Docker. En caso de no tener Docker instalado, el instalador de Windows o MacOS se descarga desde aquí https://www.docker.com/products/docker-desktop. En caso de tener un Sistema Operativo Linux, la página https://docs.docker.com/engine/install/ indica qué hacer en función de la distribución Linux que se tenga
* Navegador Web: Mozilla Firefox (https://www.mozilla.org/en-US/firefox/new/)
* El puerto 8080 debe estar libre, de lo contrario el contenedor Docker no se podrá poner en marcha

## Instrucciones

1. Descargar el proyecto desde el enlace https://github.com/albertomur1996/coding-test-ranking-php
2. Descomprimir el ZIP con cualquier programa de descompresión (si no se dispone de ninguno, usar https://www.7-zip.org/)
3. Mediante la consola del Sistema Operativo que se esté usando, acceder a la carpeta `docker` que hay dentro del proyecto descomprimido en el paso anterior
4. Dentro de la carpeta `docker` ejecutar el comando docker-compose up --build para construir la imagen de Docker y poner en marcha el contenedor
5. Una vez ejecutados los pasos anteriores, los endpoints desarrollados son accesibles desde las siguientes URL:
   1. `localhost:8080/list/customer` para ver el listado de anuncios destinado a los clientes
   2. `localhost:8080/list/quality` para ver el listado de anuncios irrelevantes
   3. `localhost:8080/score/calculate` para ejecutar el cálculo de las puntuaciones de los anuncios

## Comentarios

* Los subapartados del paso 5 se pueden ejecutar en el orden que se desee
* Si se realizan cambios en el servicio de generación de anuncios, el fichero `public/ads.json` (el directorio `public` se encuentra en la raíz del proyecto) deberá ser borrado (en el caso de que exista) si se quieren ver dichos cambios
* En caso de que el fichero `public/ads.json` no exista, si se accede al endpoint para clientes antes de haber accedido al de cálculo de puntuaciones, el endpoint de clientes no mostrará ningún anuncio, ya que todos tienen la puntuación inicializada a 0 por defecto (se puede cambiar en el generador de anuncios)
* A lo largo de todo el proyecto se ha aplicado arquitectura hexagonal para mantener los diferentes métodos/clases lo mejor organizados posibles
* Es muy probable que al leer el código se note que hay cosas que se podrían haber interpretado/hecho de otra manera, como por ejemplo el uso de getters/setters. Las decisiones tomadas han sido siempre pensando en lo que he estimado más adecuado al tipo de proyecto y su extensión
* El proyecto ha sido probado en Ubuntu Mate, Windows 10 y MacOS Mojave para comprobar que el funcionamiento fuera correcto en los 3 tipos de Sistema Operativo
* Cualquier duda o sugerencia será bien recibida, por ejemplo, a través de la creación de issues de GitHub
