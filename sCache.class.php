<?php
/**
 * sCache Class
 * Documentation: https://github.com/selcodiyebiri/sCache.Class.PHP
 *
 * @author Selçuk Çelik
 * @blog http://www.selcuk.in
 * @mail selcuk@msn.com
 *
 * @date 14.04.2015
 * @version 1.0
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 */

class sCache
{

    /**
     *  Kaydedilecek cache dosyalarına eklenecek isim.
     *
     *  @var string
     */
    static $cache_name = 'default';

    /**
     *  Kaydedilecek cache dosyalarının uzantısı.
     *
     *  @var string
     */
    static $cache_extension = '.scache';

    /**
     *  Kaydedilecek cache dosyalarının klasor ismi.
     *
     *  @var string
     */
    static $cache_path = 'cache';

    /**
     *  Sınıfımızın ayarlar fonksiyonu.
     *
     *  @param string $settings
     *  @return void
     */
    public static function settings($settings = NULL)
    {
        if ( isset($settings) )
        {
            if ( is_array($settings) )
            {
                self::$cache_name = $settings['_name'];
                if ( stripos($settings['_extension'], '.') === FALSE )
                {
                    self::$cache_extension = '.' . $settings['_extension'];
                } else {
                    self::$cache_extension = '.' . str_replace(array('.'), NULL, $settings['_extension']);
                }
                self::$cache_path = $settings['_path'];
            }
        }
    }

    /**
     *  Key cache varlığı kontrolü
     *
     *  @param string $key
     *  @return boolean
     */
    public static function isCached($key)
    {
        $myFile = self::$cache_path . "/" . md5($key) . "." . self::$cache_name . self::$cache_extension;
        return ( file_exists($myFile) ) ? TRUE : FALSE;
    }

    /**
     *  Tüm cache kayıtlarının silinmesi
     *
     *  @return boolean
     */
    static function destroyAllCaches()
    {
        $erase = array_map('unlink', glob(self::$cache_path . "/*." . self::$cache_name . self::$cache_extension));
        return $erase ? TRUE : FALSE;
    }

    /**
     *  Key değerine göre cache silme
     *
     *  @param string $key
     *  @return boolean
     */
    public static function destroyCache($key)
    {
        $myFile = self::$cache_path . "/" . md5($key) . "." . self::$cache_name . self::$cache_extension;
        if ( !file_exists($myFile) )
        {
            throw new Exception("Error: destroyCache() - Silinecek dosya bulunamadı.");
        } else
        if ( !unlink($myFile) )
        {
            throw new Exception("Error: destroyCache() - {$key} değerine ait bir kayıt silinemedi.");
        }
        return TRUE;
    }

    /**
     *  Cache tanımlama fonksiyonu
     *
     *  @param string $key
     *  @param mixed $data
     *  @param boolean [optional] $writing
     *  @return boolean
     */
    public static function setCache($key, $data, $writing = FALSE)
    {
        $myFile = self::$cache_path . "/" . md5($key) . "." . self::$cache_name . self::$cache_extension;
        $content = base64_encode(serialize($data));
        if ( !is_writable(self::$cache_path) )
        {
            throw new Exception("Error: setCache() - Klasör yazılabilir değil.");
        } else
        if ( $writing == FALSE )
        {
            if ( file_exists($myFile) )
            {
                throw new Exception("Error: setCache() - {$key} değerine ait bir kayıt bulunmaktadır.");
            }
        }
        $save = file_put_contents($myFile, "\xEF\xBB\xBF" .  $content);
        return $save ? TRUE : FALSE;
    }

    /**
     *  Cache ulaşma fonksiyonu
     *
     *  @param string $key
     *  @return string
     */
    public static function getCache($key)
    {
        $myFile = self::$cache_path . "/" . md5($key) . "." . self::$cache_name . self::$cache_extension;
        $content = file_get_contents($myFile);
        if ( !$content )
        {
            throw new Exception("Error: getCache() - {$key} değerine ait bir kayıt bulanamadı.");
        }
        return unserialize(base64_decode($content));
    }

    /**
     *  Cache dosyasının klasorüne ulaşma
     *
     *  @param string $key
     *  @return string
     */
    public static function getCacheDir($key)
    {
        $myFile = self::$cache_path . "/" . md5($key) . "." . self::$cache_name . self::$cache_extension;
        if ( !file_exists($myFile) )
        {
            throw new Exception("Error: getCacheDir() - {$key} değerine ait bir kayıt bulunmamaktadır.");
        }
        return $myFile;
    }
}
