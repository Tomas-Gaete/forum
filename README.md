# forum #

Este complemento Forum para Moodle consiste en un primer proyecto para aprender las herramientas que Moodle presenta. Este complemento permite al usuario crear foros y/o responder a ellos enviando los datos a tablas creadas utilizando la API de formularios de Moodle y la API de manipulación de datos para Moodle.

 Con este complemento, los usuarios tienen la capacidad de no solo crear foros, sino también participar activamente publicando respuestas y comentarios perspicaces. El enfoque estructurado para el almacenamiento de datos implica tablas dedicadas creadas a través de la API de formularios de Moodle, lo que garantiza una organización y recuperación eficientes de la información relacionada con el foro. A medida que los usuarios contribuyen a las discusiones, su aporte se registra sistemáticamente, lo que permite una experiencia educativa fluida y enriquecedora. 

Únete a nosotros para aprovechar las capacidades de este complemento de foro de Moodle, mientras continuamos explorando las posibilidades de la tecnología educativa y creamos una comunidad vibrante de estudiantes y educadores. Participa, aprende y crece con las características innovadoras que ofrece este complemento, mientras nos esforzamos por aprovechar al máximo el rico ecosistema de Moodle para el aprendizaje colaborativo.

## Installing via uploaded ZIP file ##

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/local/forum

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

## License ##

2023 Tomás Gaete<togaete@alumnos.uai.cl>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
