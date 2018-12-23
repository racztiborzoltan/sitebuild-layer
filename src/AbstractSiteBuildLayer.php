<?php
namespace Z\SiteBuildLayer;


abstract class AbstractSiteBuildLayer
{

    private static $_global_variables = [];

    private $_variables = [];

    /**
     * Set an variable in sitebuild layer
     *
     * @param string $name
     * @param mixed $value
     * @param bool $global
     * @return self
     */
    public function setVariable(string $name, $value, bool $global = false)
    {
        if ($global) {
            self::$_global_variables[$name] = $value;
        } else {
            $this->_variables[$name] = $value;
        }
        return $this;
    }

    /**
     * Returns named variable or default value if not exists
     *
     * @param string $name
     * @param mixed $default_value
     * @return mixed
     */
    public function getVariable(string $name, $default_value = null)
    {
        $variables = $this->getVariables();
        return isset($variables[$name]) ? $variables[$name] : $default_value;
    }

    /**
     * Remove variable
     *
     * @return array
     */
    public function unsetVariable($name, bool $global = false)
    {
        if ($global) {
            unset(self::$_global_variables[$name]);
        } else {
            unset($this->_variables[$name]);
        }
        return $this;
    }

    /**
     * Returns all variables
     *
     * @return array
     */
    public function getVariables(): array
    {
        return array_merge(self::$_global_variables, $this->_variables);
    }

    /**
     * Rendering
     *
     * @return string
     */
    abstract protected function render(): string;

    public function __toString()
    {
        try {
            return $this->render();
            return (string)$this->render()->getBody();
        } catch (\Throwable $e) {
            return (string)$e;
        }
    }
}