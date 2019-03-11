<form class="form"  action="project.php" method="post">
   <div class="form__row">
      <label class="form__label" for="project_name">Название <sup>*</sup></label>

	  <input class="form__input<?php if (isset($errors['name'])) {echo " form__input--error";}?>" type="text" name="name" id="project_name" value="<?php if (isset($field['name'])) {echo $field['name'];} ?>" placeholder="Введите название проекта">
   </div>
		<p class="form__message">
		<?php if (isset($errors['name']) && $errors['name']=='Такой проект уже имеется!') {echo "Такой проект уже имеется!";}?>
		</p>
    <div class="form__row form__row--controls">
       <input class="button" type="submit" name="" value="Добавить">
    </div>
 </form>