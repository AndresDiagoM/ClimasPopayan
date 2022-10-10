# ClimasPopayan
Proyecto de IoT, donde se mide las condiciones del clima, mediante una tarjeta ESP32 y los sensores necesario. Estos datos se envían a una página web, donde se tiene gráficas y analisis de los datos.

La base de datos MySQL se puede crear importando el archivo 'u483173002_practica1b.sql'.

El programa .ino para la tarjeta ESP32 es 'sensorV2.ino'.


REQUERIMIENTO:
Se requiere un Sistema que permita a los ciudadanos acceder (a través de Internet) a la información de la medición de clima, de diferentes puntos de la ciudad.
Los dispositivos de medición deben poder registrarse en el sistema por parte de un usuario administrador, indicando la ubicación en un mapa. Cada dispositivo (el sistema debe tener al menos 3 en diferentes puntos de la ciudad) debe tener los sensores necesarios para hacer las mediciones requeridas (temperatura, humedad, lluvia, ubicación).
El usuario de consulta y el administrador deben tener acceso a la información actual e histórica. El usuario administrador tendrá información privilegiada sobre los datos medidos por el sistema.

Los dispositivos de medición deben poder registrarse en el sistema por parte de un usuario administrador, indicando la ubicación en un mapa.

![plot](img.png)
