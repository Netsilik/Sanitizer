Sanitizer
=========

String sanitization library.

---

European Union Public Licence, v. 1.1

Unless required by applicable law or agreed to in writing, software
distributed under the Licence is distributed on an "AS IS" basis,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.

Contact: info@netsilik.nl  
Latest version available at: https://gitlab.com/Netsilik/Sanitizer

---

Example of usage

```php
// Some associative array with non-trusted values
$_TEST['userId'] = 10;
$_TEST['textField'] = 'hallo';
$_TEST['array'][0] = 'foo';
$_TEST['array'][1] = 'bar';
$_TEST['array'][2] = 'foo';


// Object creation
$_SANITIZED = null; // define your result array
$sanitizer = new Sanitizer($_SANITIZED); // Instantiate sanitizer object with a reference to our result array as construction argument

// Variable sanitization:
$sanitizer->int($_TEST, 'userId');
$sanitizer->utf8($_TEST, 'textField', '', true, 1000);
$sanitizer->ascii($_TEST, 'array', 0);

var_dump( Sanitizer::int('TEST') );

var_dump( $_SANITIZED );
```
