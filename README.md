## About
Fake a system for managing articles.<br>
I developed it with DDD architecture using Laravel, Vue. <br><br>

You can confirm it accessing aws server EC2, http://18.217.62.142/<br>
Please kindly note the following,<br>
 ・you can edit or delete articles in detail page if it is yours.<br>
 ・you need to sign up and log in first before browsing or creating articles.<br><br>

You can use this accout for demostoration.<br>
ID: takami.naoki.ca@gmail.com<br>
Password: 11111111

[Login]<br>
http://18.217.62.142/login<br><br>

[Sign up]<br>
http://18.217.62.142/register<br><br>

[Article List]<br>
http://18.217.62.142/articles/list<br><br>

[Article Create]<br>
http://18.217.62.142/articles/createOrEdit<br><br>

[Article Detail]<br>
http://18.217.62.142/articles/detail/214<br><br>

## Languages
Laravel 7.30.4<br>
Vue 2.6.12<br>
Bootstrap 4.0.0<br>

## Diagram for tables
![diagram](https://user-images.githubusercontent.com/2871056/113497030-7ac9c600-94b4-11eb-8d0f-587c1bc253ff.png)

## Points to be improved
・UI (padding, margin, showing loading image while fetching data)<br>
・When error occurs, handle errors and rendering view properly<br>
・Add delete function for comments<br>
・Add sort article list function by created or updated or something
