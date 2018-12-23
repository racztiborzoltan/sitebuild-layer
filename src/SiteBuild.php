<?php
namespace Z\SiteBuildLayer;

class SiteBuild extends AbstractSiteBuildLayer
{

    use AwarePageTypeTrait;

    private $_sitebuilds = [];

    public function setSiteBuild(string $page_type, AbstractSiteBuildLayer $sitebuild)
    {
        if (!$this->isValidPageType($page_type)) {
            throw new SiteBuildInvalidPageTypeException('invalid page type. Valid page types: ' . implode(', ', $this->getValidPageTypes()));
        }
        $this->_sitebuilds[$page_type] = $sitebuild;
        return $this;
    }

    public function getSiteBuild(string $page_type): ?AbstractSiteBuildLayer
    {
        if (!$this->isValidPageType($page_type)) {
            throw new SiteBuildInvalidPageTypeException('invalid page type. Valid page types: ' . implode(', ', $this->getValidPageTypes()));
        }
        if (!isset($this->_sitebuilds[$page_type])) {
            throw new SiteBuildNotFoundException('sitebuild not found with page type: ' . $page_type);
        }
        return isset($this->_sitebuilds[$page_type]) ? $this->_sitebuilds[$page_type] : null;
    }

    public function render(): string
    {
        $page_type = $this->getPageType();

        /**
         * @var \Z\SiteBuildLayer\AbstractSiteBuildLayer $sitebuild
         */
        $sitebuild = $this->getSiteBuild($page_type);

        return $sitebuild->render();
    }
}
