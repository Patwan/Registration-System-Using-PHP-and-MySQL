# Registration-System-Using-PHP-and-MySQL
A Simple registration system build using PHP and MySQL

This simple repo shows how to build a Registration System using PHP and MySQLi. Basically, a new user registers by filling in Username, password and uploading an avatar,the data is stored in MySQL database. Next, h/she is redirected to another page whereby the avatar uploaded is displayed, h/she can also see other registered users and their avatars displayed.

<img src="https://raw.githubusercontent.com/fethica/PHP-Login/master/login/images/screenshot1.png" alt="Login Form Validation Screenshot" />

## Installation 

1. Edit configuration information on line 7 of index.php file (like your hostname, username and database password etc).

2. Upload the entire 'source' folder  to your web site. 
    
2. For novice PHP programmers, please read the comments in the script to get a good grasp of the cocept.


### Creating the MySQL Database

Create database "accounts" and create tables "users" on your localhost or live server:

```sql
CREATE TABLE `user` (
  `id` char(23) NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `avatar` varchar(150) NOT NULL DEFAULT ''
  PRIMARY KEY (`id`)
) 

ENGINE=InnoDB DEFAULT CHARSET=utf8;

```
	
## License
This program is free software published under the terms of the GNU [Lesser General Public License](http://www.gnu.org/copyleft/lesser.html).
You can freely use it on commercial or non-commercial websites. 
