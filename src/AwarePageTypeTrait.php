<?php
namespace Z\SiteBuildLayer;

trait AwarePageTypeTrait
{

    private $_valid_page_types = [];

    private $_page_type = null;

    public function setValidPageTypes(array $valid_page_types)
    {
        $this->_valid_page_types = $valid_page_types;
        return $this;
    }

    public function getValidPageTypes(): array
    {
        return $this->_valid_page_types;
    }

    public function isValidPageType(string $page_type)
    {
        return in_array($page_type, $this->_valid_page_types);
    }

    /**
     * @param string $php_file_path
     * @return self
     */
    public function setPageType(string $page_type)
    {
        if (!$this->isValidPageType($page_type)) {
            throw new SiteBuildInvalidPageTypeException('invalid page type. Valid page types: ' . implode(', ', $this->getValidPageTypes()));
        }
        $this->_page_type = $page_type;
        return $this;
    }

    public function getPageType(): string
    {
        if (empty($this->_page_type)) {
            throw new SiteBuildInvalidPageTypeException('page type is empty. Use before the following method: ->setPageType()');
        }
        return $this->_page_type;
    }
}
