#Symfony 5

Symfony is a PHP Framework initiated by SensioLabs, a French company.
This is one of the most popular PHP Framework for open source solutions and provides a great documentation.
Symfony components are widely used by other PHP open source projects such as Drupal, Magent, Prestashop, or even Laravel.

##Setup

0. Install Composer and Symfony command line
    - https://symfony.com/doc/current/setup.html
0. Create a new Symfony project
    - `symfony new fromscratch --full`
0. Run your new project
    - `symfony server:serve`
    
##0.0.1

`git checkout 0.0.1` will setup the base Symfony 5 application with only the default configuration and files.

##0.0.2

`git checkout 0.0.2` will add two controllers (Default and Lucky) and a few routes to play with.

- 127.0.0.1:8000/ -> redirect to the lucky number route
- 127.0.0.1:8000/lucky/number -> display a random number
- 127.0.0.1:8000/lucky/string -> display a few random strings, have a look at the twig template for more details

##0.0.3

`git checkout 0.0.3` will provide you a working Article and Tag entities generated with the `make` command.

- Article entity
- Tag entity
- Article has a ManyToOne relation to Tag 

##0.0.4

`git checkout 0.0.4` add a new route to fetch all the articles serialized in JSON.

- 127.0.0.1:8000/articles -> fetch all the articles with the related tag and display them as a JSON object.