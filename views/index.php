<?php
?>
<div class="container mt-5">
  <form class="row g-3 justify-content-center" id="exchange_from">
    <h2 class="text-center">Converter</h2>
    <div class="col-8">
      <div class="col-12">
        <label for="amount" class="form-label">Exchange</label>
        <input type="text" class="form-control" id="amount" name="amount">
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="select_from" class="form-label">from</label>
          <select id="select_from" class="form-select" name="from_currency">
            <?php foreach ($currencies as $currency){?>
                <option value="<?=$currency['currency']?>"><?=$currency['currency']?></option>
            <?}?>
          </select>
        </div>
        <div class="col-md-6">
          <label for="select_to" class="form-label">to</label>
          <select id="select_to" class="form-select" name="to_currency">
						<?php foreach ($currencies as $currency){?>
              <option value="<?=$currency['currency']?>"><?=$currency['currency']?></option>
						<?}?>
          </select>
        </div>
      </div>
      <div class="col-12 text-center mt-2">
        <h1 id="result"></h1>
      </div>
      <div class="col-12 text-center mt-2">
        <button type="submit" class="btn btn-primary">Exchange</button>
      </div>
    </div>
  </form>
</div>
