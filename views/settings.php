<?php
?>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-3">
			<input type="number" class="form-control" id="count" value="<?=$count?>">

		</div>
	</div>
	<div class="row justify-content-center mt-5">
		<? foreach ($currencies as $currency){?>
		<div class="col-1 form-check">
			<input class="form-check-input currency_checkbox" type="checkbox" value="<?=$currency['id']?>" name="currency[<?=$currency['id']?>]" <?= $currency['value'] ? 'checked' : '' ?>>
			<label class="form-check-label">
				<?=$currency['currency']?>
			</label>
		</div>
		<?}?>
	</div>
</div>
