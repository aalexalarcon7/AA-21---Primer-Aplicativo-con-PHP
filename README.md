# AA-21---Primer-Aplicativo-con-PHP

#Descripción

El **Perfilador PHP**  crea una tarjeta de presentación dinámica en base a la información ingresada en un formulario.  
El usuario completa su nombre, edad y hobby, y el sistema genera una tarjeta personalizada con un mensaje adaptado a la edad.
---
#Funcionalidades principales

Formulario HTML con tres campos: **Nombre**, **Edad** y **Hobby**.  
Recepción de datos mediante la **superglobal `$_POST`**.  
Impresión dinámica de información con **código PHP embebido en HTML**.  
Lógica condicional (`if/else`) para mostrar mensajes personalizados:
Perfil en Desarrollo (menores de 60 años).  
Perfil Senior (60 años o más).  
Captura de una variable por método GET (ejemplo: `?saludo=Hola`) para mostrar un saludo en la parte superior.  
Prevención básica de ataques XSS mediante el uso de `htmlspecialchars().
---

# Tecnologías utilizadas
- PHP 8.x
- HTML5
- CSS3
- Servidor Apache (XAMPP)
