<form class="form"  action="project.php" method="post">
   <div class="form__row">
      <label class="form__label" for="project_name">Название <sup>*</sup></label>

	  <input class="form__input<?php if (isset($errors['name'])) {echo " form__input--error";}?>" type="text" name="name" id="project_name" value="<?php $_POST['name']; ?>" placeholder="Введите название проекта">
   </div>

    <div class="form__row form__row--controls">
       <input class="button" type="submit" name="" value="Добавить">
    </div>
 </form>