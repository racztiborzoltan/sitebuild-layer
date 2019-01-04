<?php
namespace Z\SiteBuildLayer;

class MustacheFileSiteBuildLayer extends AbstractSiteBuildLayer
{

    private $_mustache_file_path = null;

    /**
     * @param string $mustache_file_path
     * @return self
     */
    public function setMustacheFilePath(string $mustache_file_path)
    {
        $this->_mustache_file_path = $mustache_file_path;
        return $this;
    }

    public function getMustacheFilePath(): string
    {
        return $this->_mustache_file_path;
    }

    public function render(): string
    {
        $mustache = new \Mustache_Engine();

        $mustache_file_path = $this->getMustacheFilePath();
        if (empty($mustache_file_path) || !is_file($mustache_file_path)) {
            throw new \LogicException('mustache file path is empty or not exists');
        }

        $mustache_file_content = file_get_contents($mustache_file_path);

        return $mustache->render($mustache_file_content, $this->getVariables());
    }
}
