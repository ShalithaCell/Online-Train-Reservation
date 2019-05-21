# Online-Train-Reservation

Designed a Railway ticket booking, reservation and cancellation system. Technologies used: HTML, PHP, jquery, ajax, MySQL database.Created for best practice php and jquery.

---

# Purpose

The purpose of this project is for best practice php and jquery.This is SLIIT | Sri Lanka Institute of Information Technology First Year Semester 2  Web Project.

---

# Development setup

### 1. Retrieve our project (if you haven't done so already)

```git
 $ git clone git@github.com:ShalithaCell/Online-Train-Reservation.git
```
### 2. Move project folder to htdocs folder

   if you cannot find the htdocs folder please follow the below links,

  * [Where to find htdocs in XAMPP Mac](https://stackoverflow.com/questions/45518021/where-to-find-htdocs-in-xampp-mac)
  * [Find htdocs path, no matter where file is stored](https://stackoverflow.com/questions/5536730/find-htdocs-path-no-matter-where-file-is-stored)
  * [htdocs path in linux](https://stackoverflow.com/questions/1582851/htdocs-path-in-linux)
  * [https://stackoverflow.com/questions/1582851/htdocs-path-in-linux](https://stackoverflow.com/questions/44989243/unable-to-find-htdocs-on-xampp)

### 3. Restore database

   * Goto phpMyAdmin and select Import.
   * Find 'File to import:' section and choose the file 'TRS SQL.ZIP' which is located under project folder/associated files/DB_Scripts.
   * Then open SP.sql file and copy all queries and paste down to the phpMyAdmin SQL tab and hit GO.
   
### 4.Setup configurations

  * Goto project folder -> source code -> Config -> config.php.
    * setup your configuratons related to MySQL.
  * project folder -> source code -> Config -> settings.php.
    * changed the 'siteurl' and 'sitehomepage' value with your port number.
  * project folder -> source code -> Config -> credential.php.
    * add your email credentials in here. make sure you should enable Enable less secure apps in gmail account.
      * [How to enable less secure apps](https://support.google.com/a/answer/6260879?hl=en)
 
 ### 5. Start server
  * start the server and run;
    * http://localhost:8888/Online-Train-Reservation/source%20code/View/login.php (replace the port number 8888 to your port).
  * login using following credentials,
    * username - admin@bookit
    * password - adminadmin
    
 # Libraries
  * [jQuery](https://jquery.com/)
  * [Bootstrap](https://getbootstrap.com/)
  * [Bootstrap DateTimePicker](https://eonasdan.github.io/bootstrap-datetimepicker/)
  * [javascript toast notifications](https://github.com/CodeSeven/toastr)
  * [Material Design for Bootstrap 4 ](https://mdbootstrap.com/)
  * [jQuery DataTables](https://datatables.net/)
  * [jQuery Redirect Plugin](https://github.com/mgalante/jquery.redirect)
  * [jquery-confirm.js](https://craftpip.github.io/jquery-confirm/)
  
# Screenshots
  * <img width="500" alt="Login" src="https://user-images.githubusercontent.com/43614338/58093913-27666b80-7bed-11e9-9875-ae117941ac53.png">

 * <img width="500" alt="Registration mail send" src="https://user-images.githubusercontent.com/43614338/58093957-36e5b480-7bed-11e9-94ec-864373d09db3.png">
 
 * <img width="500" alt="Registration" src="https://user-images.githubusercontent.com/43614338/58093995-46fd9400-7bed-11e9-8e78-a67aa3b84b88.png">
 
 * <img width="500" src="https://user-images.githubusercontent.com/43614338/58094016-52e95600-7bed-11e9-9917-ef41b5691bc0.png">
 
  * <img width="500" src="https://user-images.githubusercontent.com/43614338/58094033-5da3eb00-7bed-11e9-908c-be09a447102d.png">
  
  * <img width="500" src="https://user-images.githubusercontent.com/43614338/58094047-65fc2600-7bed-11e9-870c-d3808c17caa5.png">
  
 # Contribute

The best way to contribute is by spreading the word about the library:

* Blog it
* Comment it
* Fork it
* Star it
* Share it

A **HUGE THANKS** for your help.
