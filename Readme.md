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

$sanitizer = new Sanitizer(); // Instantiate sanitizer object

// Call signature
// $sanitizer->type(scalar $data, scalar $defaultValue, int $maxLength, bool $silent);


// Example:
$a = $sanitizer->int('123');
$b = $sanitizer->utf8('hello, world');
$c = $sanitizer->bool(-1);
$d = $sanitizer->ascii(null, 'someDefault');
$e = $sanitizer->utf8('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '', 26);

var_dump($a); // int(123)
var_dump($b); // string(12) "hello, world"
var_dump($c); // bool(false)
var_dump($d); // string(11) "someDefault"
var_dump($e); // string(26) "Lorem ipsum dolor sit amet"
```
