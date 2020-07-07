<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot;

/**
 * Interface DataObject
 * @package SagoBoot
 */
interface DataObject extends \ArrayAccess
{
    /**
     * Add data to the object.
     *
     * Retains previous data in the object.
     *
     * @param array $arr
     * @return \SagoBoot\Support\DataObject
     */
    public function addData(array $arr);

    /**
     * Overwrite data in the object.
     *
     * The $key parameter can be string or array.
     * If $key is string, the attribute value will be overwritten by $value
     *
     * If $key is an array, it will overwrite all the data in the object.
     *
     * @param string|array $key
     * @param mixed $value
     * @return \SagoBoot\Support\DataObject
     */
    public function setData($key, $value = null);


    /**
     * Object data getter
     *
     * If $key is not defined will return all the data as an array.
     * Otherwise it will return value of the element specified by $key.
     * It is possible to use keys like a/b/c for access nested array data
     *
     * If $index is specified it will assume that attribute data is an array
     * and retrieve corresponding member. If data is the string - it will be explode
     * by new line character and converted to array.
     *
     * @param string $key
     * @param string|int $index
     * @return mixed
     */
    public function getData($key = '', $index = null);

    /**
     * Unset data from the object.
     *
     * @param null|string|array $key
     * @return $this
     */
    public function unsetData($key = null);

    /**
     * Get object data by path
     *
     * Method consider the path as chain of keys: a/b/c => ['a']['b']['c']
     *
     * @param string $path
     * @return mixed
     */
    public function getDataByPath($path);

    /**
     * Get object data by particular key
     *
     * @param string $key
     * @return mixed
     */
    public function getDataByKey($key);

    /**
     * If $key is empty, checks whether there's any data in the object
     *
     * Otherwise checks if the specified attribute is set.
     *
     * @param string $key
     * @return bool
     */
    public function hasData($key = '');

    /**
     * Convert array of object data with to array with keys requested in $keys array
     *
     * @param array $keys array of required keys
     * @return array
     */
    public function toArray(array $keys = []);

    /**
     * Convert object data into string with predefined format
     *
     * Will use $format as an template and substitute {{key}} for attributes
     *
     * @param string $format
     * @return string
     */
    public function toString($format = '');

    /**
     * Checks whether the object is empty
     *
     * @return bool
     */
    public function isEmpty();

    /**
     * Convert object data into string with defined keys and values.
     *
     * Example: key1="value1" key2="value2" ...
     *
     * @return  string
     */
    public function serialize();
}