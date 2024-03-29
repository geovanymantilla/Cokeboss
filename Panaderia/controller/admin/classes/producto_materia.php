<?php
namespace PHPMaker2019\project1;

/**
 * Table class for producto_materia
 */
class producto_materia extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id_materia_prima;
	public $id_producto;
	public $id_inventario;
	public $fecha_inventario;
	public $peso_producto_materia;
	public $cantidad_producto_materia;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'producto_materia';
		$this->TableName = 'producto_materia';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`producto_materia`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id_materia_prima
		$this->id_materia_prima = new DbField('producto_materia', 'producto_materia', 'x_id_materia_prima', 'id_materia_prima', '`id_materia_prima`', '`id_materia_prima`', 200, -1, FALSE, '`id_materia_prima`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_materia_prima->IsPrimaryKey = TRUE; // Primary key field
		$this->id_materia_prima->Nullable = FALSE; // NOT NULL field
		$this->id_materia_prima->Required = TRUE; // Required field
		$this->id_materia_prima->Sortable = TRUE; // Allow sort
		$this->fields['id_materia_prima'] = &$this->id_materia_prima;

		// id_producto
		$this->id_producto = new DbField('producto_materia', 'producto_materia', 'x_id_producto', 'id_producto', '`id_producto`', '`id_producto`', 200, -1, FALSE, '`id_producto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_producto->IsPrimaryKey = TRUE; // Primary key field
		$this->id_producto->Nullable = FALSE; // NOT NULL field
		$this->id_producto->Required = TRUE; // Required field
		$this->id_producto->Sortable = TRUE; // Allow sort
		$this->fields['id_producto'] = &$this->id_producto;

		// id_inventario
		$this->id_inventario = new DbField('producto_materia', 'producto_materia', 'x_id_inventario', 'id_inventario', '`id_inventario`', '`id_inventario`', 200, -1, FALSE, '`id_inventario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_inventario->Sortable = TRUE; // Allow sort
		$this->fields['id_inventario'] = &$this->id_inventario;

		// fecha_inventario
		$this->fecha_inventario = new DbField('producto_materia', 'producto_materia', 'x_fecha_inventario', 'fecha_inventario', '`fecha_inventario`', CastDateFieldForLike('`fecha_inventario`', 0, "DB"), 133, 0, FALSE, '`fecha_inventario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_inventario->Sortable = TRUE; // Allow sort
		$this->fecha_inventario->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['fecha_inventario'] = &$this->fecha_inventario;

		// peso_producto_materia
		$this->peso_producto_materia = new DbField('producto_materia', 'producto_materia', 'x_peso_producto_materia', 'peso_producto_materia', '`peso_producto_materia`', '`peso_producto_materia`', 4, -1, FALSE, '`peso_producto_materia`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->peso_producto_materia->Sortable = TRUE; // Allow sort
		$this->peso_producto_materia->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['peso_producto_materia'] = &$this->peso_producto_materia;

		// cantidad_producto_materia
		$this->cantidad_producto_materia = new DbField('producto_materia', 'producto_materia', 'x_cantidad_producto_materia', 'cantidad_producto_materia', '`cantidad_producto_materia`', '`cantidad_producto_materia`', 3, -1, FALSE, '`cantidad_producto_materia`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cantidad_producto_materia->Sortable = TRUE; // Allow sort
		$this->cantidad_producto_materia->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['cantidad_producto_materia'] = &$this->cantidad_producto_materia;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`producto_materia`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id_materia_prima', $rs))
				AddFilter($where, QuotedName('id_materia_prima', $this->Dbid) . '=' . QuotedValue($rs['id_materia_prima'], $this->id_materia_prima->DataType, $this->Dbid));
			if (array_key_exists('id_producto', $rs))
				AddFilter($where, QuotedName('id_producto', $this->Dbid) . '=' . QuotedValue($rs['id_producto'], $this->id_producto->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id_materia_prima->DbValue = $row['id_materia_prima'];
		$this->id_producto->DbValue = $row['id_producto'];
		$this->id_inventario->DbValue = $row['id_inventario'];
		$this->fecha_inventario->DbValue = $row['fecha_inventario'];
		$this->peso_producto_materia->DbValue = $row['peso_producto_materia'];
		$this->cantidad_producto_materia->DbValue = $row['cantidad_producto_materia'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_materia_prima` = '@id_materia_prima@' AND `id_producto` = '@id_producto@'";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('id_materia_prima', $row) ? $row['id_materia_prima'] : NULL) : $this->id_materia_prima->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_materia_prima@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		$val = is_array($row) ? (array_key_exists('id_producto', $row) ? $row['id_producto'] : NULL) : $this->id_producto->CurrentValue;
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_producto@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "producto_materialist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "producto_materiaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "producto_materiaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "producto_materiaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "producto_materialist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("producto_materiaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("producto_materiaview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "producto_materiaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "producto_materiaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("producto_materiaedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("producto_materiaadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("producto_materiadelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_materia_prima:" . JsonEncode($this->id_materia_prima->CurrentValue, "string");
		$json .= ",id_producto:" . JsonEncode($this->id_producto->CurrentValue, "string");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->id_materia_prima->CurrentValue != NULL) {
			$url .= "id_materia_prima=" . urlencode($this->id_materia_prima->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->id_producto->CurrentValue != NULL) {
			$url .= "&id_producto=" . urlencode($this->id_producto->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} else {
			if (Param("id_materia_prima") !== NULL)
				$arKey[] = Param("id_materia_prima");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("id_producto") !== NULL)
				$arKey[] = Param("id_producto");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) <> 2)
					continue; // Just skip so other keys will still work
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->id_materia_prima->CurrentValue = $key[0];
			$this->id_producto->CurrentValue = $key[1];
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id_materia_prima->setDbValue($rs->fields('id_materia_prima'));
		$this->id_producto->setDbValue($rs->fields('id_producto'));
		$this->id_inventario->setDbValue($rs->fields('id_inventario'));
		$this->fecha_inventario->setDbValue($rs->fields('fecha_inventario'));
		$this->peso_producto_materia->setDbValue($rs->fields('peso_producto_materia'));
		$this->cantidad_producto_materia->setDbValue($rs->fields('cantidad_producto_materia'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_materia_prima
		// id_producto
		// id_inventario
		// fecha_inventario
		// peso_producto_materia
		// cantidad_producto_materia
		// id_materia_prima

		$this->id_materia_prima->ViewValue = $this->id_materia_prima->CurrentValue;
		$this->id_materia_prima->ViewCustomAttributes = "";

		// id_producto
		$this->id_producto->ViewValue = $this->id_producto->CurrentValue;
		$this->id_producto->ViewCustomAttributes = "";

		// id_inventario
		$this->id_inventario->ViewValue = $this->id_inventario->CurrentValue;
		$this->id_inventario->ViewCustomAttributes = "";

		// fecha_inventario
		$this->fecha_inventario->ViewValue = $this->fecha_inventario->CurrentValue;
		$this->fecha_inventario->ViewValue = FormatDateTime($this->fecha_inventario->ViewValue, 0);
		$this->fecha_inventario->ViewCustomAttributes = "";

		// peso_producto_materia
		$this->peso_producto_materia->ViewValue = $this->peso_producto_materia->CurrentValue;
		$this->peso_producto_materia->ViewValue = FormatNumber($this->peso_producto_materia->ViewValue, 2, -2, -2, -2);
		$this->peso_producto_materia->ViewCustomAttributes = "";

		// cantidad_producto_materia
		$this->cantidad_producto_materia->ViewValue = $this->cantidad_producto_materia->CurrentValue;
		$this->cantidad_producto_materia->ViewValue = FormatNumber($this->cantidad_producto_materia->ViewValue, 0, -2, -2, -2);
		$this->cantidad_producto_materia->ViewCustomAttributes = "";

		// id_materia_prima
		$this->id_materia_prima->LinkCustomAttributes = "";
		$this->id_materia_prima->HrefValue = "";
		$this->id_materia_prima->TooltipValue = "";

		// id_producto
		$this->id_producto->LinkCustomAttributes = "";
		$this->id_producto->HrefValue = "";
		$this->id_producto->TooltipValue = "";

		// id_inventario
		$this->id_inventario->LinkCustomAttributes = "";
		$this->id_inventario->HrefValue = "";
		$this->id_inventario->TooltipValue = "";

		// fecha_inventario
		$this->fecha_inventario->LinkCustomAttributes = "";
		$this->fecha_inventario->HrefValue = "";
		$this->fecha_inventario->TooltipValue = "";

		// peso_producto_materia
		$this->peso_producto_materia->LinkCustomAttributes = "";
		$this->peso_producto_materia->HrefValue = "";
		$this->peso_producto_materia->TooltipValue = "";

		// cantidad_producto_materia
		$this->cantidad_producto_materia->LinkCustomAttributes = "";
		$this->cantidad_producto_materia->HrefValue = "";
		$this->cantidad_producto_materia->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id_materia_prima
		$this->id_materia_prima->EditAttrs["class"] = "form-control";
		$this->id_materia_prima->EditCustomAttributes = "";
		$this->id_materia_prima->EditValue = $this->id_materia_prima->CurrentValue;
		$this->id_materia_prima->ViewCustomAttributes = "";

		// id_producto
		$this->id_producto->EditAttrs["class"] = "form-control";
		$this->id_producto->EditCustomAttributes = "";
		$this->id_producto->EditValue = $this->id_producto->CurrentValue;
		$this->id_producto->ViewCustomAttributes = "";

		// id_inventario
		$this->id_inventario->EditAttrs["class"] = "form-control";
		$this->id_inventario->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->id_inventario->CurrentValue = HtmlDecode($this->id_inventario->CurrentValue);
		$this->id_inventario->EditValue = $this->id_inventario->CurrentValue;
		$this->id_inventario->PlaceHolder = RemoveHtml($this->id_inventario->caption());

		// fecha_inventario
		$this->fecha_inventario->EditAttrs["class"] = "form-control";
		$this->fecha_inventario->EditCustomAttributes = "";
		$this->fecha_inventario->EditValue = FormatDateTime($this->fecha_inventario->CurrentValue, 8);
		$this->fecha_inventario->PlaceHolder = RemoveHtml($this->fecha_inventario->caption());

		// peso_producto_materia
		$this->peso_producto_materia->EditAttrs["class"] = "form-control";
		$this->peso_producto_materia->EditCustomAttributes = "";
		$this->peso_producto_materia->EditValue = $this->peso_producto_materia->CurrentValue;
		$this->peso_producto_materia->PlaceHolder = RemoveHtml($this->peso_producto_materia->caption());
		if (strval($this->peso_producto_materia->EditValue) <> "" && is_numeric($this->peso_producto_materia->EditValue))
			$this->peso_producto_materia->EditValue = FormatNumber($this->peso_producto_materia->EditValue, -2, -2, -2, -2);

		// cantidad_producto_materia
		$this->cantidad_producto_materia->EditAttrs["class"] = "form-control";
		$this->cantidad_producto_materia->EditCustomAttributes = "";
		$this->cantidad_producto_materia->EditValue = $this->cantidad_producto_materia->CurrentValue;
		$this->cantidad_producto_materia->PlaceHolder = RemoveHtml($this->cantidad_producto_materia->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id_materia_prima);
					$doc->exportCaption($this->id_producto);
					$doc->exportCaption($this->id_inventario);
					$doc->exportCaption($this->fecha_inventario);
					$doc->exportCaption($this->peso_producto_materia);
					$doc->exportCaption($this->cantidad_producto_materia);
				} else {
					$doc->exportCaption($this->id_materia_prima);
					$doc->exportCaption($this->id_producto);
					$doc->exportCaption($this->id_inventario);
					$doc->exportCaption($this->fecha_inventario);
					$doc->exportCaption($this->peso_producto_materia);
					$doc->exportCaption($this->cantidad_producto_materia);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id_materia_prima);
						$doc->exportField($this->id_producto);
						$doc->exportField($this->id_inventario);
						$doc->exportField($this->fecha_inventario);
						$doc->exportField($this->peso_producto_materia);
						$doc->exportField($this->cantidad_producto_materia);
					} else {
						$doc->exportField($this->id_materia_prima);
						$doc->exportField($this->id_producto);
						$doc->exportField($this->id_inventario);
						$doc->exportField($this->fecha_inventario);
						$doc->exportField($this->peso_producto_materia);
						$doc->exportField($this->cantidad_producto_materia);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>