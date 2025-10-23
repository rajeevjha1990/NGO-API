<style>
    .input-group-text {
        height: 46px;
        margin-top: 10px;
    }
</style>
<div class="content">
    <h2>Price Convertor</h2>
    <?php if (!empty($errors)) { ?>
        <div style="color:red; margin-bottom:15px;">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php } ?>

    <?php if (!empty($success)){ ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php } ?>

    <form method="post" action="index.php?action=convertPrice">
        <div class="row g-3">

            <!-- Currency Select -->
            <div class="col-md-6">
                <label for="currency">Select Currency</label>
                <select name="currency" id="currency" class="form-select">
                    <?php foreach ($currencies as $cur) { ?>
                        <option value="<?php echo $cur['currency_code']; ?>"
                          data-symbol="<?php echo $cur['currency_symbol']; ?>"
                          data-rate="<?php echo $cur['currency_exchange_rate']; ?>">
                          <?php echo $cur['currency_name'] . " (" . $cur['currency_code'] . ")"; ?>
                      </option>
                    <?php }
                    ?>
                </select>
            </div>

            <!-- Exchange Rate -->
            <div class="col-md-6">
                <label>Exchange Rate</label>
                <div class="input-group">
                    <span class="input-group-text" id="exchange-left">1 USD =</span>
                    <input type="number" step="0.01" name="exchange_rate" id="exchange_rate" class="form-control">
                    <span class="input-group-text">₹</span>
                </div>
            </div>


            <!-- Minimum Amount -->
            <div class="col-md-6">
                <label>Minimum Amount</label>
                <div class="input-group">
                    <input readonly value="100" type="number" name="min_amount" id="min_amount" class="form-control">
                    <span class="input-group-text" id="min-amount-currency">USD</span>
                </div>
            </div>

            <!-- Fixed Charge -->
            <div class="col-md-6">
                <label>Fixed Charge</label>
                <div class="input-group">
                    <input type="number" name="fixed_charge" id="fixed_charge" class="form-control">
                    <span class="input-group-text" id="fixed-charge-currency">₹</span>
                </div>
            </div>

            <!-- Maximum Amount -->
            <div class="col-md-6">
                <label>Maximum Amount</label>
                <div class="input-group">
                    <input readonly value="1000000" type="number" name="max_amount" id="max_amount"
                        class="form-control">
                    <span class="input-group-text" id="max-amount-currency">USD</span>
                </div>
            </div>

            <!-- Percentage Charge -->
            <div class="col-md-6">
                <label>Percentage Charge</label>
                <div class="input-group">
                    <input type="number" step="0.01" name="percentage_charge" id="percentage_charge"
                        class="form-control">
                    <span class="input-group-text" id="percentage-currency">%</span>
                </div>
            </div>

            <!-- Deposit Instruction -->
            <div class="col-md-12">
                <label>Deposit Instruction</label>
                <textarea name="deposit_instruction" id="deposit_instruction" class="form-control"></textarea>
            </div>
            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-primary w-100">Save</button>
            </div>
        </div>
    </form>
</div>

<script>
    const exchangesData = <?php echo json_encode($exchangesvalues); ?>;
    const currencySelect = document.getElementById('currency');
    const exchangeLeft = document.getElementById('exchange-left');
    const exchangeRateInput = document.getElementById('exchange_rate');
    const fixedChargeInput = document.getElementById('fixed_charge');
    const percentageChargeInput = document.getElementById('percentage_charge');
    const minAmountInput = document.getElementById('min_amount');
    const maxAmountInput = document.getElementById('max_amount');
    const depositInstruction = document.getElementById('deposit_instruction');

    const fixedChargeCurrency = document.getElementById('fixed-charge-currency');
    const minAmountCurrency = document.getElementById('min-amount-currency');
    const maxAmountCurrency = document.getElementById('max-amount-currency');

    function updateCurrencyFields() {
        const selectedCode = currencySelect.value;
        const selectedSymbol = currencySelect.options[currencySelect.selectedIndex].getAttribute('data-symbol');

        // Find exchange record for selected currency
        const record = exchangesData.find(item => item.cv_currency === selectedCode);

        if (record) {
            // if record is present
            exchangeRateInput.value = record.cv_rate;
            minAmountInput.value = record.cv_minimum;
            maxAmountInput.value = record.cv_maximum;
            fixedChargeInput.value = record.cv_fixed_charge;
            percentageChargeInput.value = record.cv_percent_charge;
            depositInstruction.value = record.cv_description;
        } else {
            // if record is not available
            exchangeRateInput.value = '';
            minAmountInput.value = '';
            maxAmountInput.value = '';
            fixedChargeInput.value = '';
            percentageChargeInput.value = '';
            depositInstruction.value = '';
        }

        // Update labels
        exchangeLeft.textContent = `1 ${selectedCode} =`;
        fixedChargeCurrency.textContent = selectedSymbol;
        minAmountCurrency.textContent = selectedCode;
        maxAmountCurrency.textContent = selectedCode;
    }

    // this call after change the currency
    currencySelect.addEventListener('change', updateCurrencyFields);

    // this is call when page is load
    document.addEventListener('DOMContentLoaded', updateCurrencyFields);
</script>
