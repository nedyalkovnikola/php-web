<?php if (isset($compoundInterest, $currency)) : ?>
    <h3><?= "{$currency} {$compoundInterest}"; ?></h3>
 <?php endif; ?>
<hr>
<form>
    <div>
        <label for="amount">Enter Amount: </label>
        <input id="amount" type="number" step="1" min="0" name="amount" required >
    </div>
    <div>
        <input id="usd" type="radio" name="currency" value="usd" checked>
        <label for="usd">USD</label>
        <input id="eur" type="radio" name="currency" value="eur">
        <label for="eur">EUR</label>
        <input id="bgn" type="radio" name="currency" value="bgn">
        <label for="bgn">BGN</label>
    </div>
    <div>
        <label for="interest">Compound Interest Amount: </label>
        <input id="interest" type="number" step="1" min="0" name="interest" required>
    </div>
    <div>
        <select name="period">
            <option value="6">6 Months</option>
            <option value="12">1 Year</option>
            <option value="24">2 Years</option>
            <option value="60">5 Years</option>
        </select>
    
        <input type="submit" name="submit" value="Calculate" />
    </div>
</form>