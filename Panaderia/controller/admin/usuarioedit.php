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
$usuario_edit = new usuario_edit();

// Run the page
$usuario_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fusuarioedit = currentForm = new ew.Form("fusuarioedit", "edit");

// Validate form
fusuarioedit.validate = function() {
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
		<?php if ($usuario_edit->Identificador->Required) { ?>
			elm = this.getElements("x" + infix + "_Identificador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->Identificador->caption(), $usuario->Identificador->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_edit->Contrasena->Required) { ?>
			elm = this.getElements("x" + infix + "_Contrasena");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->Contrasena->caption(), $usuario->Contrasena->RequiredErrorMessage)) ?>");
		<?php } ?>

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
fusuarioedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuarioedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $usuario_edit->showPageHeader(); ?>
<?php
$usuario_edit->showMessage();
?>
<form name="fusuarioedit" id="fusuarioedit" class="<?php echo $usuario_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($usuario->Identificador->Visible) { // Identificador ?>
	<div id="r_Identificador" class="form-group row">
		<label id="elh_usuario_Identificador" for="x_Identificador" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->Identificador->caption() ?><?php echo ($usuario->Identificador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->Identificador->cellAttributes() ?>>
<span id="el_usuario_Identificador">
<span<?php echo $usuario->Identificador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($usuario->Identificador->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_Identificador" name="x_Identificador" id="x_Identificador" value="<?php echo HtmlEncode($usuario->Identificador->CurrentValue) ?>">
<?php echo $usuario->Identificador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->Contrasena->Visible) { // Contrasena ?>
	<div id="r_Contrasena" class="form-group row">
		<label id="elh_usuario_Contrasena" for="x_Contrasena" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->Contrasena->caption() ?><?php echo ($usuario->Contrasena->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->Contrasena->cellAttributes() ?>>
<span id="el_usuario_Contrasena">
<input type="text" data-table="usuario" data-field="x_Contrasena" name="x_Contrasena" id="x_Contrasena" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($usuario->Contrasena->getPlaceHolder()) ?>" value="<?php echo $usuario->Contrasena->EditValue ?>"<?php echo $usuario->Contrasena->editAttributes() ?>>
</span>
<?php echo $usuario->Contrasena->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuario_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuario_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuario_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuario_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$usuario_edit->terminate();
?>