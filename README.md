# Rainforest

## Code structure

- index.php
- page1.php
- page2.php
- ...
- controllers/
- - page1Controller.php
- - page2Controller.php
- - ...
- models/
- - user.php
- - item.php
- - ...
- static/
- - css/
- - - design.css
- - - bootstrap.css
- - js/
- - - main.js

### Example page
```php
<!-- page1.php -->
<html>
...
<?php
require_once("page1Controller.php");

// These methods implemented in page1Controller.php
$users = get_users();
$orders = get_orders();
?>
...
<ul>
<?php
foreach ($users as $user) {
  echo "<li>$user.name</li>";
}
?>
</ul>
...
</html>
```


## Style guidlines

- functions in camelCase: (e.g. `setItemName()`)
- Classes in camelCase with capital: (e.g. `Cart`, `ViewItemController`)
- minor variables in snake_case:   (e.g. `email_address`)
