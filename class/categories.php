<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgLinks module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wglinks
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         XOOPS on Wedega - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 * @version        $Id: 1.0 categories.php 13070 Sun 2016-03-20 15:20:14Z XOOPS Development Team $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WglinksCategories
 */
class WglinksCategories extends XoopsObject
{
	/**
	 * @var mixed
	 */
	private $wgCategories = null;

	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->wglinks = WglinksHelper::getInstance();
		$this->initVar('cat_id', XOBJ_DTYPE_INT);
		$this->initVar('cat_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('cat_desc', XOBJ_DTYPE_TXTBOX);
		$this->initVar('cat_weight', XOBJ_DTYPE_INT);
		$this->initVar('cat_logo', XOBJ_DTYPE_TXTBOX);
		$this->initVar('cat_submitter', XOBJ_DTYPE_INT);
		$this->initVar('cat_date_created', XOBJ_DTYPE_INT);
	}

	/**
	 * @static function &getInstance
	 *
	 * @param null
	 */
	public static function &getInstance()
	{
		static $instance = false;
		if(!$instance) {
			$instance = new self();
		}
	}

	/**
	 * The new inserted $Id
	 */
	public function getNewInsertedIdCategories()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

    /**
     * Get form
     *
     * @param mixed $action
     * @return XoopsThemeForm
     */
	public function getFormCategories($action = false)
	{
		if($action === false) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGLINKS_CAT_ADD) : sprintf(_AM_WGLINKS_CAT_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        // Form Text LinkName
		$form->addElement(new XoopsFormText( _AM_WGLINKS_CAT_NAME, 'cat_name', 50, 255, $this->getVar('cat_name') ), true);
        // Form Text LinkUrl
        $cat_desc = $this->isNew() ? '' : $this->getVar('cat_desc');
		$form->addElement(new XoopsFormText( _AM_WGLINKS_CAT_DESC, 'cat_desc', 50, 255, $cat_desc ), false);
        // Form Text LinkWeight
        $linkWeight = $this->isNew() ? '0' : $this->getVar('cat_weight');
		$form->addElement(new XoopsFormText( _AM_WGLINKS_WEIGHT, 'cat_weight', 20, 150, $linkWeight ), true);
/* 		// Form Upload Image
		$getLinkLogo = $this->getVar('cat_logo');
		$linkCategory = $getLinkLogo ? $getLinkLogo : 'blank.gif';
		$imageDirectory = '/uploads/wglinks/images/cats';
		$imageTray = new XoopsFormElementTray(_AM_WGLINKS_CAT_LOGO, '<br />' );
		$imageSelect = new XoopsFormSelect( sprintf(_AM_WGLINKS_FORM_IMAGE_PATH, ".{$imageDirectory}/"), 'cat_logo', $linkCategory, 5);
		$imageArray = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $imageDirectory );
		foreach($imageArray as $image1) {
			$imageSelect->addOption("{$image1}", $image1);
		}
		$imageSelect->setExtra("onchange='showImgSelected(\"image1\", \"cat_logo\", \"".$imageDirectory."\", \"\", \"".XOOPS_URL."\")'");
		$imageTray->addElement($imageSelect, false);
		$imageTray->addElement(new XoopsFormLabel('', "<br /><img src='".XOOPS_URL."/".$imageDirectory."/".$linkCategory."' name='image1' id='image1' alt='' style='max-width:100px' />"));
		// Form File
		$fileSelectTray = new XoopsFormElementTray('', '<br />' );
		$fileSelectTray->addElement(new XoopsFormFile( _AM_WGLINKS_FORM_UPLOAD_IMAGE_LINKS, 'attachedfile', $this->wglinks->getConfig('maxsize') ));
		$fileSelectTray->addElement(new XoopsFormLabel(''));
		$imageTray->addElement($fileSelectTray);
		$form->addElement($imageTray); */
		// Form Select User
        $catSubmitter = $this->isNew() ? $GLOBALS['xoopsUser']->getVar('uid') : $this->getVar('cat_submitter');
		$form->addElement(new XoopsFormSelectUser( _AM_WGLINKS_SUBMITTER, 'cat_submitter', false, $catSubmitter ), true);
		// Form Text Date Select
		$catDate_created = $this->isNew() ? 0 : $this->getVar('cat_date_created');
		$form->addElement(new XoopsFormTextDateSelect( _AM_WGLINKS_DATE_CREATED, 'cat_date_created', '', $catDate_created ), true);
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
		return $form;
	}

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
	public function getValuesCategories($keys = null, $format = null, $maxDepth = null)
	{
		$ret = parent::getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('cat_id');
		$ret['name'] = $this->getVar('cat_name');
		if ( 'http://' !== $this->getVar('cat_desc') && 'https://' !== $this->getVar('cat_desc') ) {
			$ret['url'] = $this->getVar('cat_desc');
		}
		$ret['weight'] = $this->getVar('cat_weight');
		$ret['logo'] = $this->getVar('cat_logo');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('cat_submitter'));
		$ret['date_created'] = formatTimeStamp($this->getVar('cat_date_created'), 's');
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayCategories()
	{
		$ret = array();
		$vars = $this->getVars();
		foreach(array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('{$var}');
		}
		return $ret;
	}
}

/**
 * Class Object Handler WglinksCategories
 */
class WglinksCategoriesHandler extends XoopsPersistableObjectHandler
{
	/**
	 * @var mixed
	 */
	private $wgCategories = null;

	/**
	 * Constructor 
	 *
	 * @param string $db
	 */
	public function __construct($db)
	{
		parent::__construct($db, 'wglinks_categories', 'wglinkscategories', 'cat_id', 'cat_name');
		$this->wgCategories = WgLinksHelper::getInstance();
		$this->db = $db;
	}

	/**
	 * @param bool $isNew
	 *
	 * @return object
	 */
	public function create($isNew = true)
	{
		return parent::create($isNew);
	}

    /**
     * retrieve a field
     *
     * @param int $i field id
     * @param null $fields
     * @return mixed reference to the {@link Get} object
     */
	public function get($i = null, $fields = null)
	{
		return parent::get($i, $fields);
	}

	/**
	 * get inserted id
	 *
	 * @param null
	 * @return integer reference to the {@link Get} object
	 */
	public function getInsertId()
	{
		return $this->db->getInsertId();
	}

    /**
     * Get Count Categories in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
	public function getCountCategories($start = 0, $limit = 0, $sort = 'cat_id ASC, cat_desc', $order = 'ASC')
	{
		$criteriaCountCategories = new CriteriaCompo();
		$criteriaCountCategories = $this->getCategoriesCriteria($criteriaCountCategories, $start, $limit, $sort, $order);
		return parent::getCount($criteriaCountCategories);
	}

    /**
     * Get All Categories in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
	public function getAllCategories($start = 0, $limit = 0, $sort = 'cat_id ASC, cat_desc', $order = 'ASC')
	{
		$criteriaAllCategories = new CriteriaCompo();
		$criteriaAllCategories = $this->getCategoriesCriteria($criteriaAllCategories, $start, $limit, $sort = 'cat_id ASC, cat_desc', $order = 'ASC');
		return parent::getAll($criteriaAllCategories);
	}

    /**
     * Get Criteria Categories
     * @param $criteriaCategories
     * @param $start
     * @param $limit
     * @param $sort
     * @param $order
     * @return mixed
     */
	private function getCategoriesCriteria($criteriaCategories, $start, $limit, $sort, $order)
	{
		$criteriaCategories->setStart( $start );
		$criteriaCategories->setLimit( $limit );
		$criteriaCategories->setSort( $sort );
		$criteriaCategories->setOrder( $order );
		return $criteriaCategories;
	}
}
