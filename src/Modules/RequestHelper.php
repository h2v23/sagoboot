<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Modules;


use SagoBoot\RequestHelper as RequestHelperAlias;

/**
 * Class RequestHelper
 * @package SagoBoot\Modules
 */
class RequestHelper extends \SagoBoot\Support\DataObject implements RequestHelperAlias
{
	public function __construct() {
		parent::__construct($this->input());
	}

	/**
     * @var null
     */
    protected $data = null;

    /**
     * Determine if the request contains a given input item key.
     *
     * @param  string|array $key
     *
     * @return bool
     */
    public function exists($key)
    {
        $keys = is_array($key) ? $key : func_get_args();

        $input = $this->input();

        foreach ($keys as $value) {
            if (!array_key_exists($value, $input)) {
                return false;
            }
        }

        return true;
    }



    public function all()
    {
        if (is_null($this->data)) {
            // @codingStandardsIgnoreLine
            $this->data = array_replace_recursive($_POST, $_GET, $_REQUEST);
        }

        return $this->data;
    }

    /**
     * Retrieve an input item from the request.
     *
     * @param  string $key
     * @param  mixed $default
     *
     * @return string|array
     */
    public function input($key = null, $default = null)
    {
        if (is_null($this->data)) {
            // @codingStandardsIgnoreLine
            $this->data = array_replace_recursive($_POST, $_GET, $_REQUEST);
        }
        if (is_null($key)) {
            return $this->data;
        }

        return array_key_exists($key, $this->data) ? $this->data[ $key ] : $default;
    }

	/**
	 * @return bool
	 */
    public function isPost()
    {
    	return (!empty($_POST));
    }

    /**
     * Retrieve an input item from the request.
     *
     * @param  string $key
     * @param  mixed $default
     *
     * @return string|array
     */
    public function inputJson($key = null, $default = null)
    {
        $value = $this->input($key, $default);
        $value = json_decode(rawurldecode($value), true);

        return $value;
    }

    public function isAjax()
    {
	    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}
