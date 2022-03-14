<?php if (isset($compoundInterest, $currencySign)) : ?>
    <h3><?= "{$currencySign} {$compoundInterest}"; ?></h3>
 <?php endif; ?>
<hr>
<form>
    <div>
        <label for="amount">Enter Amount: </label>
        <input id="amount" type="number" step="1" min="0" name="amount" value="<?=$amount;?>" required >
    </div>
    <div>
    <?php foreach ($validCurrencies as $currencyKey => $currencySign) : ?>
        <input type="radio" name="currency" <?= ($currency == $currencyKey) ? 'checked' : '';?> value="<?=$currencyKey;?>" required>
        <label><?= $currencyKey;?></label>
    <?php endforeach; ?>
    </div>
    <div>
        <label for="interest">Compound Interest Amount: </label>
        <input id="interest" type="number" step="1" min="0" name="interest" value="<?=$interest; ?>" required>
    </div>
    <div>
        <select name="period">
        <?php foreach ($validPeriods as $validPeriod => $userValue): ?>
            <option value="<?= $validPeriod;?>"><?=$userValue;?></option>
        <?php endforeach; ?>
        </select>
        <input type="submit" name="submit" value="Calculate" />
    </div>
</form>