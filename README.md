## About
Fake a system for managing articles.<br>
I developed it with DDD architecture using Laravel, Vue. <br><br>

You can confirm it accessing aws server EC2, http://18.217.62.142/<br>
Please kindly note the following,<br>
 ・you can edit or delete articles in detail page if it is yours.<br>
 ・you need to sign up and log in first before browsing or creating articles.<br>

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
Laravel
Vue 
Bootstrap 4.0.0

## Diagram for tables


## Points to be improved
・UI (padding, margin, showing loading image while fetching data)
・When error occurs, handle errors and rendering view properly
・Add delete function for comments
・Add sort article list function by created or updated or something
