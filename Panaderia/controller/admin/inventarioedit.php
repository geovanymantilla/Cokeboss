<?php
namespace PHPMaker2019\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data
	if(!isset($_SESSION['Usuario']))
	header("Location: index.php");

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$inventario_edit = new inventario_edit();

// Run the page
$inventario_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var finventarioedit = currentForm = new ew.Form("finventarioedit", "edit");

// Validate form
finventarioedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($inventario_edit->id_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_id_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario->id_inventario->caption(), $inventario->id_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inventario_edit->fecha_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario->fecha_inventario->caption(), $inventario->fecha_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha_inventario");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($inventario->fecha_inventario->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
finventarioedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventarioedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inventario_edit->showPageHeader(); ?>
<?php
$inventario_edit->showMessage();
?>
<form name="finventarioedit" id="finventarioedit" class="<?php echo $inventario_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$inventario_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($inventario->id_inventario->Visible) { // id_inventario ?>
	<div id="r_id_inventario" class="form-group row">
		<label id="elh_inventario_id_inventario" for="x_id_inventario" class="<?php echo $inventario_edit->LeftColumnClass ?>"><?php echo $inventario->id_inventario->caption() ?><?php echo ($inventario->id_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_edit->RightColumnClass ?>"><div<?php echo $inventario->id_inventario->cellAttributes() ?>>
<span id="el_inventario_id_inventario">
<span<?php echo $inventario->id_inventario->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($inventario->id_inventario->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="inventario" data-field="x_id_inventario" name="x_id_inventario" id="x_id_inventario" value="<?php echo HtmlEncode($inventario->id_inventario->CurrentValue) ?>">
<?php echo $inventario->id_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario->fecha_inventario->Visible) { // fecha_inventario ?>
	<div id="r_fecha_inventario" class="form-group row">
		<label id="elh_inventario_fecha_inventario" for="x_fecha_inventario" class="<?php echo $inventario_edit->LeftColumnClass ?>"><?php echo $inventario->fecha_inventario->caption() ?><?php echo ($inventario->fecha_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_edit->RightColumnClass ?>"><div<?php echo $inventario->fecha_inventario->cellAttributes() ?>>
<span id="el_inventario_fecha_inventario">
<span<?php echo $inventario->fecha_inventario->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($inventario->fecha_inventario->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="inventario" data-field="x_fecha_inventario" name="x_fecha_inventario" id="x_fecha_inventario" value="<?php echo HtmlEncode($inventario->fecha_inventario->CurrentValue) ?>">
<?php echo $inventario->fecha_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inventario_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $inventario_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inventario_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$inventario_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inventario_edit->terminate();
?>