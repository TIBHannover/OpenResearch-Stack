This folder contains files for customizing OpenResearch Stack:

## 10-custom-settings.php 
Included in LocalSettings.php before extension registration
```php
<?php
  $wgYourSetting=true;
```

## 90-custom-settings.php
Included in LocalSettings.php after extension registration
```php
<?php
  $wgYourSetting=true;
```

## 90-custom-permissions.php
Included in LocalSettings.php after 90-custom-settings.php
```php
<?php
  $wgYourSetting=true;
```
