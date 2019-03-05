<form class="form" action="auth.php" method="post">
    <div class="form__row">
            <label class="form__label" for="email">E-mail <sup>*</sup></label>

            <input class="form__input<?php if (isset($auth['email'])) {echo " form__input--error";}?>" type="text" name="email" id="email" value="<?php $_POST['email']; ?>" placeholder="Введите e-mail">

            <p class="form__message"><?php if (isset($auth['email'])) {echo "E-mail введён некорректно";}?></p>
    </div>

    <div class="form__row">
            <label class="form__label" for="password">Пароль <sup>*</sup></label>

            <input class="form__input" type="password" name="password" id="password" value="<?php $_POST['password']; ?>" placeholder="Введите пароль">
    </div>

    <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Войти">
    </div>
</form>