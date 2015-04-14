# Hakkında #

Bana ufak çaplı bir file cache sistemi gerekiyordu. Bende yarım kilo meyveli yoğurt eşliğinde başlangıç olarak bu sınıfı oluşturdum. İleriye dönük daha da geliştirmeler yapacağım.

# Kullanımı #
## Cache Ayarları (Opsiyonel) ##
```php
<?php
/*  settings();

    sCache::settings(array(
        '_path' => 'cache',
        '_name' => 'default',
        '_extension' => 'scache'
    ));

 */
 
// Örnek
sCache::settings(array(
    '_path' => 'cache',
    '_name' => 'cache',
    '_extension' => '.selco'
));
?>
```

## Cache Tanımlama ##
```php
<?php
/*  setCache();

    sCache::setCache($key, $data, $writing = FALSE);
    NOT: Daha önce tanımlanmış bir cache üstüne yazmak için $writing değeri TRUE yapınız.

 */
 
// Örnek
try {

    $boolean = sCache::setCache('test', 'test içerik');
    echo ($boolean) ? 'cache tanımlandı.' : 'cache tanımlanamadı.';

} catch (Exception $e )
{
    echo $e->getMessage(); // Hata oluşursa ekrana yaz.
}
?>
```

## Tanımlanan Cache Ulaşma ##
```php
<?php
/*  getCache();

    sCache::getCache($key);

 */
try {

    $string = sCache::getCache('test');
    echo $string;

} catch (Exception $e )
{
    echo $e->getMessage(); // Hata oluşursa ekrana yaz.
}
?>
```

## Cache Yoluna Ulaşma ##
```php
<?php
/*  getCacheDir();

    sCache::getCacheDir($key);

 */
 
 // Örnek
 try {

    $string = sCache::getCacheDir('test');
    echo $string;

} catch (Exception $e )
{
    echo $e->getMessage(); // Hata oluşursa ekrana yaz.
}
?>
```

## Cache Kontrol ##
```php
<?php
/*  Kullanımı

    sCache::isCached($key);

 */
 
// Örnek
try {

    $boolean = sCache::isCached('test');
    echo ($boolean) ? 'Cache var' : 'Cache yok';

} catch (Exception $e )
{
    echo $e->getMessage(); // Hata oluşursa ekrana yaz.
}
?>
```

## Cache Silme ##
```php
<?php
/*  destroyCache();

    sCache::destroyCache($key);

 */

// Örnek
try {

    $boolean = sCache::destroyCache('test');
    echo ($boolean) ? 'Cache silindi' : 'Cache silinemedi.';

} catch (Exception $e )
{
    echo $e->getMessage(); // Hata oluşursa ekrana yaz.
}
?>
```

## Tüm Cache Dosyalarının Silinmesi ##
```php
<?php
/*  destroyAllCaches();

    sCache::destroyAllCaches();

 */
 
 // Örnek
 try {

    $boolean = sCache::destroyAllCaches();
    echo ($boolean) ? 'Tüm kayıtlar silindi.' : 'Kayıtlar silinemedi.';

} catch (Exception $e )
{
    echo $e->getMessage(); // Hata oluşursa ekrana yaz.
}
?>
```
