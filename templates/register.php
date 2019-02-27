		  <form class="form" action="register.php" method="post">
            <div class="form__row">
              <label class="form__label" for="email">E-mail <sup>*</sup></label>

              <input class="form__input<?php if (isset($errors['email'])) {echo " form__input--error";}?>" type="text" name="email" id="email" value="<?php $_POST['email']; ?>" placeholder="Введите e-mail">

              <p class="form__message"><?php if (isset($errors['email'])) {echo "E-mail введён некорректно";}?></p>
            </div>
			
            <div class="form__row">
              <label class="form__label" for="name">Имя <sup>*</sup></label>

              <input class="form__input<?php if (isset($errors['name_user'])) {echo " form__input--error";}?>" type="text" name="name" id="name" value="<?php $_POST['name']; ?>" placeholder="Введите имя">
            </div>
			
            <div class="form__row">
              <label class="form__label" for="password">Пароль <sup>*</sup></label>

              <input class="form__input<?php if (isset($errors['password'])) {echo " form__input--error";}?>" type="password" name="password" id="password" value="<?php $_POST['password']; ?>" placeholder="Введите пароль">
            </div>



            <div class="form__row form__row--controls">
              <p class="error-message"><?php if (isset($errors['password'])||isset($errors['email'])||isset($errors['name_user'])){echo "Пожалуйста, исправьте ошибки в форме";}?></p>

              <input class="button" type="submit" name="" value="Зарегистрироваться">
            </div>
          </form>