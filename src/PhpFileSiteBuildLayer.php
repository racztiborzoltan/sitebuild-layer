<?php
namespace Z\SiteBuildLayer;

class PhpFileSiteBuildLayer extends AbstractSiteBuildLayer
{

    private $_php_file_path = null;

    /**
     * @param string $php_file_path
     * @return self
     */
    public function setPhpFilePath(string $php_file_path)
    {
        $this->_php_file_path = $php_file_path;
        return $this;
    }

    public function getPhpFilePath(): string
    {
        return $this->_php_file_path;
    }

    public function render(): string
    {
        extract($this->getVariables());
        ob_start();
        include $this->getPhpFilePath();
        return ob_get_clean();
    }
}
