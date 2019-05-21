# Online-Train-Reservation

Designed a Railway ticket booking, reservation and cancellation system. Technologies used: HTML, PHP, jquery, ajax, MySQL database.Created for best practice php and jquery.

---

# Purpose

The purpose of this project is for best practice php and jquery.

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
  
# Screenshots
 
