What is phpCan?
--------

phpCan is an opensource php5 framework created to the development of any kind of website in an easy way.

Its philosophy is opened, avoiding to adhere to restrictive code rules. It is easy to learn, very intuitive and extremely configurable and adaptable to the developer needles.

Its main characteristics are:

* It is builded in php 5.3, using the last features of php in POO.
* It is designed not only for php programmers, but it has also tools for designers and html/css developers.
* It has a complete database abstraction layer, builded over a new data concept: formats.
* It has tools to manipulate files dinamically, not only html pages.
* It has installable modules, that allows make specific functions over your website (for example a CMS or administration tools).
* It can manages differents websites or scenes in just one installation.
* It is multilingual and uses UTF-8. Not other character codification is allowed.
* It generates clean urls.
* It uses PDO to MySQL connection.
* It is free, with GNU AFFERO licence, so you want make warever you want with it.

Documentation
--------

You can find all classes and functions of phpcan core explained with examples in http://idc.anavallasuiza.com/project/phpcan/documentation/

In Starting with phpCan you can learn the basics of this framework: how to install and how it works. In Classes you can find a complete reference to all classes of phpCan. Basic functions contains a complete reference to all independent functions available and Formats explains all data formats and its functions.

Installation
--------

You can download full project with git commands:

    $ git clone git://github.com/eusonlito/PHPCan.git phpcan
    $ cd phpcan
    $ git submodule init
    $ git submodule foreach git pull origin master

Now you can start to use PHPCan from your local URL http://localhost/phpcan/

You will need set some folders writables to web server user:

- phpcan/cache : store db/api/data/default/custom files
- phpcan/logs : store the db/errors/custom log files generated by Debug object
- web/uploads : store the files uploaded in Db inserts and updates (file and image formats)
- web/cache : store the post-processed static images/css/js files

Enjoy!